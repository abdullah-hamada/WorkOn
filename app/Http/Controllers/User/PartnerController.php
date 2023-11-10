<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Jobs\ServiceOrder\SendServiceOrderRequestNotification;
use App\Models\PartnerOrder;
use App\Models\PartnerService;
use App\Models\ServiceOrder;
use App\Models\User;
use Inertia\Inertia;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:user');
    }

    public function partners()
    {
        $partners_order = PartnerOrder::with(['category', 'country', 'services', 'branches'])->where('status', 1)->get();

        return Inertia::render('views/user/Partners/Index', [
            'partners_order' => $partners_order
        ]);
    }

    public function show_partner($id)
    {
        $partner_order = PartnerOrder::with(['category', 'country', 'services', 'branches'])->where('id', $id)->first();
        if (!$partner_order || ($partner_order->status == 4 && $partner_order->cancel_order_request == 1)) {
            abort(404);
        }
        return Inertia::render('views/user/Partners/Show', [
            'partner_order' => $partner_order
        ]);
    }

    public function request_service_order($service_id)
    {

        $service = PartnerService::find($service_id);

        if (!$service) {
            abort(404);
        }


        $partner_order = PartnerOrder::where('id', $service->partner_order_id)->first();

        if ($partner_order->status == 4 && $partner_order->cancel_order_request == 1) {
            return redirect()->back()->with('error', 'تم الغاء طلب الشراكة ');
        }

        if (ServiceOrder::query()->where('user_id', auth()->user()->id)
            ->where('service_id', $service->id)
            ->where('status', 3)->first()
        ) {
            return redirect()->back()->with('error', 'الرجاء الانتظار الى حين قبول الطلب السابق');
        }
        $status = ServiceOrder::create([
            'user_id' => auth()->user()->id,
            'service_id' => $service->id,
            'partner_order_id' => $service->partner_order_id,
            'status' => 3
        ]);
        if ($status) {
            $partner = User::where('id', PartnerOrder::query()->where('id', $service->partner_order_id)->first()->user_id)->first();
            $data = [
                'user' => auth()->user(),
                'partner' => $partner,
                'service_name' => $service->name,
                'link' => config('app.url') . 'admin/partners_order'
            ];
            $this->dispatch(new SendServiceOrderRequestNotification($data));

            return redirect('/dashboard/user/service_orders')->with('success', 'تم طلب الخدمة بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا  ما');
        }
    }

    public function service_orders()
    {
        $service_orders = ServiceOrder::with(['service:id,partner_order_id,name', 'partner:id,company_name'])
            ->where('user_id', auth()->user()->id)->get();


        return Inertia::render('views/user/ServiceOrder/Index', [
            'service_orders' => $service_orders,
            'time_zone' => getTimeZone()
        ]);
    }


}
