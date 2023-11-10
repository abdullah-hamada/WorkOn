<?php

namespace Database\Seeders;

use App\Models\LogoSetting;
use App\Models\MotivationalMessage;
use App\Models\Role;
use App\Models\User;
use App\Models\WebsiteControl;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


//        WebsiteControl::query()->create([
//            'tag' => 'header',
//            'page' => 'main_page',
//            'title' => 'حاضنة العمل الحر',
//            'url' => config('app.url') . '/#freelance_incubator'
//        ]);
//
//        WebsiteControl::query()->create([
//            'tag' => 'header',
//            'page' => 'main_page',
//            'title' => 'الخدمات',
//            'url' => config('app.url') . '/#services'
//
//        ]);
//
//        WebsiteControl::query()->create([
//            'tag' => 'header',
//            'page' => 'main_page',
//            'title' => 'توجيه وارشاد',
//            'url' => config('app.url') . '/#guidance'
//
//        ]);
//        WebsiteControl::query()->create([
//            'tag' => 'header',
//            'page' => 'main_page',
//            'title' => 'العضويات',
//            'url' => config('app.url') . '/#memberships'
//
//        ]);
//        WebsiteControl::query()->create([
//            'tag' => 'header',
//            'page' => 'main_page',
//            'title' => 'الدورات التدريبية',
//            'url' => config('app.url') . '/#courses'
//
//        ]);
//        WebsiteControl::query()->create([
//            'tag' => 'header',
//            'page' => 'main_page',
//            'title' => 'مدربينا المحترفين  ',
//            'url' => config('app.url') . '/#trainers'
//
//        ]);
//        WebsiteControl::query()->create([
//            'tag' => 'header',
//            'page' => 'main_page',
//            'title' => 'أرقامنا',
//            'url' => config('app.url') . '/#numbers'
//
//        ]);
//        WebsiteControl::query()->create([
//            'tag' => 'header',
//            'page' => 'main_page',
//            'title' => 'قالوا عنا',
//            'url' => config('app.url') . '/#about_us'
//
//        ]);
//
//
//        WebsiteControl::query()->create([
//            'tag' => 'section_one',
//            'page' => 'main_page',
//        ]);
//        WebsiteControl::query()->create([
//            'tag' => 'section_two',
//            'page' => 'main_page',
//        ]);
//
//        WebsiteControl::query()->create([
//            'tag' => 'section_three_items',
//            'page' => 'main_page',
//        ]);
//        WebsiteControl::query()->create([
//            'tag' => 'section_three_item',
//            'page' => 'main_page',
//        ]);
//
//
//        WebsiteControl::query()->create([
//            'tag' => 'section_four',
//            'page' => 'main_page',
//        ]);
//
//        WebsiteControl::query()->create([
//            'tag' => 'section_five_items',
//            'page' => 'main_page',
//        ]);
//        WebsiteControl::query()->create([
//            'tag' => 'section_five_item',
//            'page' => 'main_page',
//        ]);
//
//
//
//
//        WebsiteControl::query()->create([
//            'tag' => 'section_six_items',
//            'page' => 'main_page',
//        ]);
//        WebsiteControl::query()->create([
//            'tag' => 'section_six_item',
//            'page' => 'main_page',
//        ]);
//
//
//            WebsiteControl::query()->create([
//            'tag' => 'section_seven_items',
//            'page' => 'main_page',
//        ]);
//        WebsiteControl::query()->create([
//            'tag' => 'section_seven_item',
//            'page' => 'main_page',
//        ]);
//
//        WebsiteControl::query()->create([
//            'tag' => 'section_nine',
//            'page' => 'main_page',
//        ]);
//
//
//            WebsiteControl::query()->create([
//            'tag' => 'section_ten_items',
//            'page' => 'main_page',
//        ]);
//        WebsiteControl::query()->create([
//            'tag' => 'section_ten_item',
//            'page' => 'main_page',
//        ]);
//
//        WebsiteControl::query()->create([
//            'tag' => 'section_eleven',
//            'page' => 'main_page',
//        ]);
//
//        WebsiteControl::query()->create([
//            'tag' => 'section_twelve_item',
//            'page' => 'main_page',
//        ]);
//        WebsiteControl::query()->create([
//            'tag' => 'section_twelve_items',
//            'page' => 'main_page',
//        ]);
//
//        WebsiteControl::query()->create([
//            'tag' => 'social_media',
//            'page' => 'main_page',
//        ]);
//
//        WebsiteControl::query()->create([
//            'tag' => 'footer_item',
//            'page' => 'main_page',
//        ]);

//partner
//        Role::query()->create([
//           'name'=>'user',
//            'guard_name'=>'web'
//        ]);
//        Role::query()->create([
//            'name'=>'admin',
//            'guard_name'=>'web'
//        ]);
//    Role::query()->create([
////            'name'=>'partner',
////            'guard_name'=>'web'
////        ]);
//        $user=User::query()->create([
//            'name'=>'admin',
//            'email'=>'admin@gmail.com',
//            'whatsapp_number'=>'9999999999999999',
//            'password'=>Hash::make('admin'),
//            'email_verified_at'=>Carbon::now()
//        ]);
//        $user->assignRole('admin');
//        MotivationalMessage::query()->create([
//           'title'=>'Welcome Back'
//        ]);
//////
//        LogoSetting::query()->create([
//            'text'=>'Work Net',
//            'logo'=>' '
//        ]);
//

        // \App\Models\User::factory(10)->create();

//
//        WebsiteControl::query()->create([
//            'tag' => 'section_two',
//            'page' => 'partner_page',
//        ]);
//        WebsiteControl::query()->create([
//            'tag' => 'section_three_item',
//            'page' => 'partner_page',
//        ]);
//
//        WebsiteControl::query()->create([
//            'tag' => 'section_four_item',
//            'page' => 'partner_page',
//        ]);
//        WebsiteControl::query()->create([
//            'tag' => 'section_six_item',
//            'page' => 'partner_page',
//        ]);
        WebsiteControl::query()->create([
            'tag' => 'partner_items',
            'page' => 'main_page',
        ]);
    }
}
