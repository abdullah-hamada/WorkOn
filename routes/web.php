<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require __DIR__ . '/auth.php';
Route::get('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'logout'])->middleware('auth:web');
Route::get('/', [\App\Http\Controllers\Website\HomeController::class, 'index']);
Route::get('/all_courses', [\App\Http\Controllers\Website\HomeController::class, 'courses']);
Route::get('/get_all_courses', [\App\Http\Controllers\Website\HomeController::class, 'get_all_courses']);
Route::post('/news/subscribe', [\App\Http\Controllers\Website\HomeController::class, 'subscribe_user_in_news']);
Route::post('/save_contact_us', [\App\Http\Controllers\Website\HomeController::class, 'save_contact_us']);
Route::get('/course/{id}', [\App\Http\Controllers\Share\ShareController::class, 'show_course']);
Route::get('/get_file/{folder}/{image}', [\App\Http\Controllers\Share\ShareController::class, 'get_file']);
Route::get('/partners', [\App\Http\Controllers\Website\HomeController::class,'partners']);
Route::post('/partner_order', [\App\Http\Controllers\Website\HomeController::class,'partner_order']);


Route::get('/company_service_order', [\App\Http\Controllers\Website\HomeController::class,'company_service_order']);
Route::post('/company_service_order', [\App\Http\Controllers\Website\HomeController::class,'save_company_service_order']);


Route::get('/partner_explanation_page', [\App\Http\Controllers\Website\HomeController::class,'partner_explanation_page']);
Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'], function () {
        Route::resource('/countries', \App\Http\Controllers\Admin\CountryController::class);
        Route::resource('/categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('/parent_categories', \App\Http\Controllers\Admin\ParentCategoryController::class);
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);
        Route::resource('/logo_setting', \App\Http\Controllers\Admin\LogoSettingController::class);
        Route::resource('/motivational_message', \App\Http\Controllers\Admin\MotivationalMessageController::class);
        Route::resource('/roles', \App\Http\Controllers\Admin\RoleController::class);
        Route::resource('/users', \App\Http\Controllers\Admin\UserController::class);
        Route::get('/export_users', [\App\Http\Controllers\Admin\UserController::class, 'export_users']);
        Route::get('/export_course_subscriber_info/{id}', [\App\Http\Controllers\Admin\CourseController::class, 'export_course_subscriber_info']);
        Route::post('/user/change_status/{user_id}', [\App\Http\Controllers\Admin\UserController::class, 'change_status']);
        Route::resource('/courses', \App\Http\Controllers\Admin\CourseController::class);
        Route::post('/courses/{course_id}/update', [\App\Http\Controllers\Admin\CourseController::class, 'update']);
        Route::get('/show_subscribe_user_info/{type}/{id}/{user_id}', [\App\Http\Controllers\Admin\SubscribeUserController::class, 'show_subscribe_user_info']);
        Route::get('/subscribe_user_in_news', [\App\Http\Controllers\Admin\ShareController::class, 'index']);


        Route::get('/main_page_control', [\App\Http\Controllers\Admin\WebsitePageControlController::class, 'main_page_control']);
        Route::post('/main_page_control', [\App\Http\Controllers\Admin\WebsitePageControlController::class, 'save_main_page_control']);
        Route::get('/partner_page_control', [\App\Http\Controllers\Admin\WebsitePageControlController::class, 'partner_page_control']);
        Route::post('/partner_page_control', [\App\Http\Controllers\Admin\WebsitePageControlController::class, 'save_partner_page_control']);


        Route::resource('/trainers', \App\Http\Controllers\Admin\TrainerController::class);
        Route::post('/trainers/{id}/update', [\App\Http\Controllers\Admin\TrainerController::class, 'update']);
        Route::resource('/services', \App\Http\Controllers\Admin\ServiceController::class);
        Route::post('/services/{id}/update', [\App\Http\Controllers\Admin\ServiceController::class, 'update']);
        Route::post('/trainers/change_status/{id}', [\App\Http\Controllers\Admin\TrainerController::class, 'change_status']);
        Route::post('/services/change_status/{id}', [\App\Http\Controllers\Admin\ServiceController::class, 'change_status']);
        Route::post('/courses/change_status/{id}', [\App\Http\Controllers\Admin\CourseController::class, 'change_status']);
        Route::get('/subscribe_user_in_news', [\App\Http\Controllers\Admin\ShareController::class, 'subscribe_user_in_news']);
        Route::get('/contact_us', [\App\Http\Controllers\Admin\ShareController::class, 'contact_us']);

        Route::get('/partners_order', [\App\Http\Controllers\Admin\PartnerOrderController::class, 'index']);
        Route::get('/partner_order_info/{id}', [\App\Http\Controllers\Admin\PartnerOrderController::class, 'show']);
        Route::get('/partner/change_status/{id}/{status}', [\App\Http\Controllers\Admin\PartnerOrderController::class, 'change_status']);
        Route::get('/partner/service_orders', [\App\Http\Controllers\Admin\PartnerOrderController::class, 'service_orders']);
        Route::get('/partner/cancel_order_requests', [\App\Http\Controllers\Admin\PartnerOrderController::class, 'cancel_order_requests']);
        Route::post('/partner/cancel_partner_order/{id}/change_status/{status}', [\App\Http\Controllers\Admin\PartnerOrderController::class, 'cancel_partner_order']);

        Route::get('/company_service_order', [\App\Http\Controllers\Admin\CompanyServiceOrderController::class, 'index']);
        Route::get('/company_service_order/{id}', [\App\Http\Controllers\Admin\CompanyServiceOrderController::class, 'show']);


    });
    Route::group(['middleware' => 'role:user|partner'], function () {
        Route::get('/user_subscribers', [\App\Http\Controllers\User\SubscribeController::class, 'user_subscribers']);
        Route::resource('courses', \App\Http\Controllers\User\CourseController::class);
        Route::get('tap-payment/{course_id}', [\App\Http\Controllers\User\TapPaymentController::class, 'payment'])->name('tap.payment');
        Route::any('tap-callback', [\App\Http\Controllers\User\TapPaymentController::class, 'callback'])->name('tap.callback');
    });
    Route::group(['middleware' => 'role:user|admin|partner'], function () {
        Route::get('/profile', [\App\Http\Controllers\Auth\ProfileController::class, 'profile']);
        Route::post('/profile', [\App\Http\Controllers\Auth\ProfileController::class, 'update_profile']);
        Route::get('/dashboard', [\App\Http\Controllers\Share\DashboardController::class, 'index']);
        Route::get('/make_notification_as_read', [\App\Http\Controllers\Share\ShareController::class, 'make_notification_as_read']);
        Route::get('/notifications', [\App\Http\Controllers\Share\ShareController::class, 'notifications']);
        Route::get('/get_courses', [\App\Http\Controllers\Share\ShareController::class, 'get_courses']);
    });
    Route::group(['middleware' => 'role:partner'], function () {
        Route::get('/dashboard/partner/edit_order_info', [\App\Http\Controllers\Partner\PartnerController::class, 'edit_order_info']);
        Route::post('/dashboard/partner/update_order_info', [\App\Http\Controllers\Partner\PartnerController::class, 'update_order_info']);
        Route::get('/dashboard/partner', [\App\Http\Controllers\Partner\PartnerController::class, 'show']);
        Route::get('/dashboard/partner/service_orders', [\App\Http\Controllers\Partner\PartnerController::class, 'service_orders']);
        Route::post('/dashboard/partner/service_order/{id}/change_status/{status}', [\App\Http\Controllers\Partner\PartnerController::class, 'service_order_change_status']);
        Route::get('/dashboard/partner/cancel_order_request', [\App\Http\Controllers\Partner\PartnerController::class, 'cancel_order_request']);

    });
    Route::group(['middleware' => 'role:user'], function () {
        Route::get('/dashboard/user/partners', [\App\Http\Controllers\User\PartnerController::class, 'partners']);
        Route::get('/dashboard/user/show_partner/{id}', [\App\Http\Controllers\User\PartnerController::class, 'show_partner']);
        Route::post('/dashboard/user/request_service_order/{id}', [\App\Http\Controllers\User\PartnerController::class, 'request_service_order']);
         Route::get('/dashboard/user/service_orders', [\App\Http\Controllers\User\PartnerController::class, 'service_orders']);
    });

});

