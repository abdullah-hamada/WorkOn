<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\CompanyServiceOrderRequest;
use App\Http\Requests\Website\ContactUsRequest;
use App\Http\Requests\Website\PartnerOrderRequest;
use App\Http\Requests\Website\SubscribeNewsRequest;
use App\Mail\Admin\SendNewPartnerOrderMail;
use App\Mail\PartnerOrder\SendPartnerOrderRegisterGreetingMail;
use App\Models\CompanyServiceOrder;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\Course;
use App\Models\PartnerBranch;
use App\Models\PartnerCategory;
use App\Models\PartnerOrder;
use App\Models\PartnerService;
use App\Models\Service;
use App\Models\Trainer;
use App\Models\User;
use App\Models\UserSubscribeNew;
use App\Models\WebsiteControl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Matrix\Exception;

class HomeController extends Controller
{


    public function index()
    {
        return Inertia::render('views/website/Pages/Home', [
            'header_items' => WebsiteControl::query()->whereTag('header')->wherePage('main_page')->select('id', 'title', 'order', 'url')->orderBy('order', 'asc')->get(),

            'section_one_item' => WebsiteControl::query()->whereTag('section_one')->wherePage('main_page')->select('id', 'title', 'paragraph', 'button_text', 'button_url', 'image')->first(),
            'section_two_item' => WebsiteControl::query()->whereTag('section_two')->wherePage('main_page')->select('id', 'title', 'paragraph', 'image', 'button_url')->first(),
            'section_three_items' => WebsiteControl::query()->whereTag('section_three_items')->wherePage('main_page')->select('id', 'title', 'sub_title', 'image')->get(),
            'section_three_item' => WebsiteControl::query()->whereTag('section_three_item')->wherePage('main_page')->select('id', 'title')->first(),
            'section_four_item' => WebsiteControl::query()->whereTag('section_four')->wherePage('main_page')->select('id', 'title', 'paragraph', 'button_text', 'button_url', 'image')->first(),
            'section_five_items' => WebsiteControl::query()->whereTag('section_five_items')->wherePage('main_page')->select('id', 'title', 'sub_title', 'image')->get(),
            'section_five_item' => WebsiteControl::query()->whereTag('section_five_item')->wherePage('main_page')->select('id', 'title', 'paragraph')->first(),
            'section_six_items' => WebsiteControl::query()->whereTag('section_six_items')->wherePage('main_page')->select('id', 'title', 'image', 'sub_title', 'button_url')->get(),
            'section_six_item' => WebsiteControl::query()->whereTag('section_six_item')->wherePage('main_page')->select('id', 'title')->first(),
            'section_seven_items' => WebsiteControl::query()->whereTag('section_seven_items')->wherePage('main_page')->select('id', 'title', 'sub_title', 'image')->get(),
            'section_seven_item' => WebsiteControl::query()->whereTag('section_seven_item')->wherePage('main_page')->select('id', 'title')->first(),
            'section_nine_item' => WebsiteControl::query()->whereTag('section_nine')->wherePage('main_page')->select('id', 'title', 'image', 'paragraph', 'button_url', 'button_text')->first(),
            'section_ten_items' => WebsiteControl::query()->whereTag('section_ten_items')->wherePage('main_page')
                ->select('id', 'title', 'sub_title', 'image', 'linked_in_url', 'facebook_url', 'instagram_url', 'twitter_url')->get(),
            'section_ten_item' => WebsiteControl::query()->whereTag('section_ten_item')->wherePage('main_page')->select('id', 'title', 'paragraph')->first(),
            'section_eleven_item' => WebsiteControl::query()->whereTag('section_eleven')->wherePage('main_page')->select('id', 'title', 'paragraph', 'button_text', 'button_url', 'image')->first(),
            'section_twelve_items' => WebsiteControl::query()->whereTag('section_twelve_items')->wherePage('main_page')->select('id', 'title', 'sub_title', 'image', 'paragraph')->get(),
            'section_twelve_item' => WebsiteControl::query()->whereTag('section_twelve_item')->wherePage('main_page')->select('id', 'title')->first(),
            'latest_courses' => Course::with('service:id,name', 'trainer:id,name')->whereActive()->orderByDesc('id')->get()->take(3),
            'free_courses' => Course::with('service:id,name', 'trainer:id,name')->whereActive()->where('price_type', 2)->orderByDesc('id')->get()->take(3),
            'pay_courses' => Course::with('service:id,name', 'trainer:id,name')->whereActive()->where('price_type', 1)->orderByDesc('id')->get()->take(3),

            'trainers' => Trainer::orderByDesc('id')->whereActive()->get(),
            'services' => Service::withCount('courses')->whereActive()->orderByDesc('id')->get(),
            'slider_items' => WebsiteControl::query()->whereTag('slider')->wherePage('main_page')->select('id', 'title', 'paragraph', 'button_text', 'button_url', 'image')->get(),
            'partner_items' => WebsiteControl::query()->whereTag('partner_items')->wherePage('main_page')->select('id', 'button_url', 'image')->get(),

        ]);
    }


    public function courses()
    {
        return Inertia::render('views/website/Pages/Courses', [
        ]);
    }

    public function get_all_courses()
    {

        if (request()->type == 'latest_courses') {
            return response()->json([
                'latest_courses' => Course::with('service:id,name', 'trainer:id,name')->whereActive()->orderByDesc('id')->paginate(10),
            ]);
        } elseif (request()->type == 'free_courses') {
            return response()->json([
                'free_courses' => Course::with('service:id,name', 'trainer:id,name')->whereActive()->where('price_type', 2)->orderByDesc('id')->paginate(10)
            ]);
        } elseif (request()->type == 'pay_courses') {
            return response()->json([
                'pay_courses' => Course::with('service:id,name', 'trainer:id,name')->whereActive()->where('price_type', 1)->orderByDesc('id')->paginate(10),
            ]);
        } else {
            return response()->json([
                'latest_courses' => Course::with('service:id,name', 'trainer:id,name')->whereActive()->orderByDesc('id')->paginate(10),
                'free_courses' => Course::with('service:id,name', 'trainer:id,name')->whereActive()->where('price_type', 2)->orderByDesc('id')->paginate(10),
                'pay_courses' => Course::with('service:id,name', 'trainer:id,name')->whereActive()->where('price_type', 1)->orderByDesc('id')->paginate(10),

            ]);
        }

    }

    public function subscribe_user_in_news(SubscribeNewsRequest $request)
    {
        $status = UserSubscribeNew::query()->create([
            'email' => $request->email
        ]);
        if ($status) {
            return redirect()->back()->with('success', 'تم الإشتراك بالقائمة البريدية  بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }

    public function save_contact_us(ContactUsRequest $request)
    {
        $status = ContactUs::query()->create([
            'email' => $request->email,
            'name' => $request->name,
            'description' => $request->description,

        ]);
        if ($status) {
            return redirect()->back()->with('success', 'تم إرسال الإستفسار  بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }

    public function partners()
    {
        return Inertia::render('views/website/Pages/Partner', [
            'countries' => Country::all(),
            'partner_categories' => PartnerCategory::all()

        ]);
    }


    public function partner_order(PartnerOrderRequest $request)
    {
        try {
            DB::beginTransaction();
            if (isset($request->logo) && !empty($request->logo) && $request->logo != null) {
                uploadImage('partner_logo', $request->logo);
            }
            $partner_order = PartnerOrder::query()->create([
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
                'logo' => $request->logo->hashName(),
                'slugn' => $request->slugn,
                'communication_officer' => $request->communication_officer,
                'address' => $request->address,
                'status' => 3
            ]);
            if (isset($request->branches) && count($request->branches) > 0) {
                foreach ($request->branches as $branch) {
                    PartnerBranch::query()->create([
                        'name' => $branch['name'],
                        'address' => $branch['address'],
                        'location' => $branch['location'],
                        'partner_order_id' => $partner_order->id,
                    ]);
                }
            }
            if (isset($request->services) && count($request->services) > 0) {
                foreach ($request->services as $service) {
                    PartnerService::query()->create([
                        'price' => $service['price'],
                        'discount' => $service['discount'],
                        'name' => $service['name'],
                        'final_price' => ($service['price'] - ($service['price'] * ($service['discount'] / 100))),
                        'partner_order_id' => $partner_order->id,
                    ]);
                }
            }
            Mail::to($partner_order->email)->send(new SendPartnerOrderRegisterGreetingMail());

            $admin = User::query()->where('email', 'abdulrahman.alhanafi@gopal.business')->first();
            if ($admin) {
                Mail::to($admin->email)->send(new SendNewPartnerOrderMail([
                    'company_name' => $partner_order->company_name,
                    'link' => config('app.url') . 'admin/partners_order',
                    'user_name' => $admin->name
                ]));

            }


//            $this->dispatch(new NewPartnerOrderNotification($data));
            DB::commit();
            return redirect()->back()->with('success', 'تم ارسال الطلب
             يقوم فريقنا بدراسة طلبك وسنقوم بالرد عليك في أقرب فرصة شاكرين لكم تعاونكم');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', '');
        }
    }

    public function company_service_order()
    {
        return Inertia::render('views/website/Pages/ServiceOrder', [
            'countries' => Country::all(),

        ]);
    }

    public function save_company_service_order(CompanyServiceOrderRequest $request)
    {
        try {
            DB::beginTransaction();
            if (isset($request->logo) && !empty($request->logo) && $request->logo != null) {
                uploadImage('company_service_order_logo', $request->logo);
            }
            CompanyServiceOrder::query()->create([
                'email' => $request->email,
                'whatsapp_number' => $request->whatsapp_number,
                'country_id' => $request->country_id,
                'city' => $request->city,
                'company_name' => $request->company_name,
                'employment_filed' => $request->employment_filed,
                'company_info' => $request->company_info,
                'website_url' => $request->website_url,
                'facebook_url' => $request->facebook_url,
                'twitter_url' => $request->twitter_url,
                'instagram_url' => $request->instagram_url,
                'linked_in_url' => $request->linked_in_url,
                'logo' => $request->logo->hashName(),
                'slugn' => $request->slugn,
                'communication_officer' => $request->communication_officer,
                'address' => $request->address,
                'service' => $request->service,
                'target_number' => $request->target_number,
                'age_group' => $request->age_group,
                'service_description' => $request->service_description,
                'training_time' => $request->training_time,
                'category' => $request->category
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'تم ارسال الطلب
             يقوم فريقنا بدراسة طلبك وسنقوم بالرد عليك في أقرب فرصة شاكرين لكم تعاونكم');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', '');
        }
    }


    public function partner_explanation_page()
    {
        return Inertia::render('views/website/Pages/PartnerExplanationPage', [
            'slider_items' => WebsiteControl::query()->whereTag('slider')->wherePage('partner_page')->select('id', 'title', 'paragraph', 'button_text', 'button_url', 'image')->get(),
            'section_two_item' => WebsiteControl::query()->whereTag('section_two')->wherePage('partner_page')->select('id', 'title', 'paragraph', 'image')->first(),
            'section_three_items' => WebsiteControl::query()->whereTag('section_three_items')->wherePage('partner_page')->select('id', 'title', 'sub_title', 'image')->get(),
            'section_three_item' => WebsiteControl::query()->whereTag('section_three_item')->wherePage('partner_page')->select('id', 'title')->first(),
            'section_four_item' => WebsiteControl::query()->whereTag('section_four_item')->wherePage('partner_page')->select('id', 'title', 'paragraph', 'button_text', 'button_url', 'image')->first(),
            'section_six_items' => WebsiteControl::query()->whereTag('section_six_items')->wherePage('partner_page')->select('id', 'title', 'sub_title', 'image', 'paragraph')->get(),
            'section_six_item' => WebsiteControl::query()->whereTag('section_six_item')->wherePage('partner_page')->select('id', 'title')->first(),
        ]);
    }


}
