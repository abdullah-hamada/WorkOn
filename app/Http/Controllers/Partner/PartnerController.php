<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partner\UpdatePartnerInfoRequest;
use App\Models\Country;
use App\Models\PartnerBranch;
use App\Models\PartnerCategory;
use App\Models\PartnerOrder;
use App\Models\PartnerService;
use App\Models\ServiceOrder;
use Inertia\Inertia;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:partner');
    }

    public function show()
    {
        $partner_order = PartnerOrder::with(['category', 'country', 'services', 'branches'])->where('user_id', auth()->user()->id)->first();
        if (!$partner_order) {
            abort(404);
        }
        if ($partner_order->status == 4) {
            return redirect('/')->with('error', 'تم الغاء طلب الشراكة ');
        }
        return Inertia::render('views/partner/Show', [
            'partner_order' => $partner_order
        ]);
    }


    public function edit_order_info()
    {
        $partner_order = PartnerOrder::with(['category', 'country', 'services', 'branches'])->where('user_id', auth()->user()->id)->first();
        if (!$partner_order || $partner_order->status != 1) {
            abort(404);
        }
        return Inertia::render('views/partner/Edit', [
            'partner_order' => $partner_order,
            'countries' => Country::all(),
            'partner_categories' => PartnerCategory::all()
        ]);

    }

    public function update_order_info(UpdatePartnerInfoRequest $request)
    {
        $partner_order = PartnerOrder::with(['category', 'country', 'services', 'branches'])->where('user_id', auth()->user()->id)->first();
        if (!$partner_order || $partner_order->status != 1) {
            abort(404);
        }


        $data = [
            'email' => $request->email,
            'whatsapp_number' => $request->whatsapp_number,
            'country_id' => $request->country_id,
            'city' => $request->city,
            'category_id' => $request->category_id,
            'partner_category_id' => $request->partner_category_id,
            'company_name' => $request->company_name,
            'employment_filed' => $request->employment_filed,
            'company_info' => $request->company_info,
            'website_url' => $request->website_url,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
            'instagram_url' => $request->instagram_url,
            'linked_in_url' => $request->linked_in_url,
            'slugn' => $request->slugn,
            'communication_officer' => $request->communication_officer,
            'address' => $request->address,
        ];
        if (isset($request->logo) && !empty($request->logo) && $request->logo != null) {
            deletePreviousImage('partner_logo', $partner_order->logo);
            uploadImage('partner_logo', $request->logo);

            $data['logo'] = $request->logo->hashName();
        }
        $partner_order->update($data);

        auth()->user()->update([
            'name' => $request->company_name,
            'email' => $request->email,
            'whatsapp_number' => $request->whatsapp_number,
            'country_id' => $request->country_id,
        ]);


        PartnerBranch::query()->whereIn('id', collect($partner_order->branches)->pluck('id')->diff(collect($request->branches)->pluck('id')))->delete();
        if (isset($request->branches) && count($request->branches) > 0) {
            foreach ($request->branches as $branch) {
                if (isset($branch['type']) && $branch['type'] == 'new') {
                    PartnerBranch::query()->create([
                        'name' => $branch['name'],
                        'address' => $branch['address'],
                        'location' => $branch['location'],
                        'partner_order_id' => $partner_order->id,
                    ]);
                } else {
                    $branch = PartnerBranch::find($branch['id']);
                    $branch->update([
                        'name' => $branch['name'],
                        'address' => $branch['address'],
                        'location' => $branch['location'],
                    ]);
                }
            }
        }


        PartnerService::query()->whereIn('id', collect($partner_order->services)->pluck('id')->diff(collect($request->services)->pluck('id')))->delete();
        if (isset($request->services) && count($request->services) > 0) {
            foreach ($request->services as $service) {
                if (isset($service['type']) && $service['type'] == 'new') {
                    PartnerService::query()->create([
                        'price' => $service['price'],
                        'discount' => $service['discount'],
                        'name' => $service['name'],
                        'final_price' => ($service['price'] - ($service['price'] * ($service['discount'] / 100))),
                        'partner_order_id' => $partner_order->id,
                    ]);
                } else {
                    $service = PartnerService::find($service['id']);
                    $service->update([
                        'price' => $service['price'],
                        'discount' => $service['discount'],
                        'name' => $service['name'],
                        'final_price' => ($service['price'] - ($service['price'] * ($service['discount'] / 100))),
                    ]);
                }
            }
        }


        return redirect('/dashboard/partner')->with('success', 'تم التحديث بنجاح');


    }

    public function service_orders()
    {
        $partner_order = PartnerOrder::where('user_id', auth()->user()->id)->first();

        if ($partner_order->status == 4 && $partner_order->cancel_order_request == 1) {
            return redirect('/')->with('error', 'تم الغاء طلب الشراكة ');
        }


        $service_orders = ServiceOrder::with(['service:id,partner_order_id,name', 'partner:id,company_name', 'user:id,name,email,whatsapp_number'])
            ->where('partner_order_id', PartnerOrder::query()->where('user_id', auth()->user()->id)->first()->id)->get();
        return Inertia::render('views/partner/ServiceOrder/Index', [
            'service_orders' => $service_orders,
            'time_zone' => getTimeZone()
        ]);
    }


    public function service_order_change_status($id, $status)
    {

        $partner_order = PartnerOrder::where('user_id', auth()->user()->id)->first();

        if ($partner_order->status == 4 && $partner_order->cancel_order_request == 1) {
            return redirect()->back()->with('error', 'تم الغاء طلب الشراكة ');
        }

        $service_order = ServiceOrder::where('id', $id)->where('status', 3)->first();
        if (!$service_order) {
            abort(404);
        }
        $result = $service_order->update([
            'status' => $status
        ]);
        if ($result) {
            return redirect()->back()->with('success', 'تم تغيير الحالة بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }


    public function cancel_order_request()
    {
        $partner_order = PartnerOrder::where('user_id', auth()->user()->id)->whereNull('cancel_order_request')->first();
        if (!$partner_order || $partner_order->status != 1) {
            return redirect()->back()->with('error', 'تم ارسال الطلب من قبل ');
        }

        $result = $partner_order->update([
            'cancel_order_request' => 1
        ]);
        if ($result) {
            return redirect()->back()->with('success', 'تم   ارسال الطلب  بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }

    }
}
