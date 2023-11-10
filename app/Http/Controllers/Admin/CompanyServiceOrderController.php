<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\PartnerOrder\GeneralNotification\SendAcceptPartnerToUsersNotification;
use App\Mail\PartnerOrder\SendAcceptCancelPartnerOrderMail;
use App\Mail\PartnerOrder\SendAcceptPartnerOrderMail;
use App\Mail\PartnerOrder\SendRejectCancelPartnerOrderMail;
use App\Mail\PartnerOrder\SendRejectPartnerOrderMail;
use App\Models\CompanyServiceOrder;
use App\Models\PartnerOrder;
use App\Models\ServiceOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Matrix\Exception;

class CompanyServiceOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return Inertia::render('views/admin/CompanyServiceOrder/Index', [
            'company_service_orders' => CompanyServiceOrder::with('country')->orderBy('id', 'desc')->get()
        ]);
    }


    public function show($id)
    {
        $company_service_order = CompanyServiceOrder::with(['country'])->where('id', $id)->first();
        if (!$company_service_order) {
            abort(404);
        }
        return Inertia::render('views/admin/CompanyServiceOrder/Show', [
            'company_service_order' => $company_service_order
        ]);
    }

    public function change_status($id, $status)
    {

        try {
            DB::beginTransaction();

            if (!in_array($status, [1, 2])) {
                abort(404);
            }
            $partner_order = PartnerOrder::find($id);
            if (!$partner_order || $partner_order->status != 3) {
                abort(404);
            }
            $result = $partner_order->update([
                'status' => $status
            ]);


            if ($partner_order->status == 1) {
                $password = Str::random(9);
                $user = User::create([
                    'name' => $partner_order->company_name,
                    'email' => $partner_order->email,
                    'password' => Hash::make($password),
                    'whatsapp_number' => $partner_order->whatsapp_number,
                    'timezone' => getTimeZone(),
                    'country_id' => $partner_order->country_id,
                    'email_verified_at' => Carbon::now(),
                ]);
                $partner_order->update([
                    'user_id' => $user->id
                ]);
                $user->assignRole('partner');

                Mail::to($partner_order->email)->send(new SendAcceptPartnerOrderMail([
                    'name' => $partner_order->company_name,
                    'password' => $password,
                    'email' => $partner_order->email,
                    'link' => config('app.url') . 'login'
                ]));

                $this->dispatch(new SendAcceptPartnerToUsersNotification($partner_order));

            } else {
                Mail::to($partner_order->email)->send(new SendRejectPartnerOrderMail([
                    'name' => $partner_order->company_name,
                    'link' => config('app.url') . 'partners'
                ]));
            }

            DB::commit();
            return redirect('/admin/partners_order')->with('success', 'تم تحديث الحالة   بنجاح');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'حدث خطا  ما');

        }
    }

    public function service_orders()
    {
        $service_orders = ServiceOrder::with(['service:id,partner_order_id,name', 'partner:id,company_name', 'user:id,name,email,whatsapp_number'])->get();

        return Inertia::render('views/admin/PartnerOrder/ServiceOrder/Index', [
            'service_orders' => $service_orders,
            'time_zone' => getTimeZone()
        ]);
    }


    public function cancel_order_requests()
    {
        $cancel_order_requests = PartnerOrder::with(['category', 'country', 'services', 'branches'])->whereIN('cancel_order_request', [0, 1])->get();

        return Inertia::render('views/admin/PartnerOrder/CancelRequests', [
            'cancel_order_requests' => $cancel_order_requests
        ]);
    }


    public function cancel_partner_order($id, $status)
    {

        if (!in_array($status, [1, 2])) {
            abort(404);
        }

        $partner_order = PartnerOrder::find($id);

        if (!$partner_order || $partner_order->cancel_order_request != 1) {
            abort(404);
        }

        if ($status == 1) {
            $result = $partner_order->update([
                'status' => 4
            ]);
            Mail::to($partner_order->email)->send(new SendAcceptCancelPartnerOrderMail());

        } elseif ($status == 2) {
            $result = $partner_order->update([
                'cancel_order_request' => 0
            ]);
            Mail::to($partner_order->email)->send(new SendRejectCancelPartnerOrderMail());
        }

        if ($result) {
            return redirect()->back()->with('success', 'تم تحديث الحالة   بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا  ما');
        }
    }

}
