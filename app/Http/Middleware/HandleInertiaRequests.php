<?php

namespace App\Http\Middleware;

use App\Models\LogoSetting;
use App\Models\WebsiteControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param Request $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param Request $request
     * @return array
     */
    public function share(Request $request): array
    {
        if (auth()->check() && auth('web')->user()->image) {
            $image = '/get_file/user_images/' . auth('web')->user()->image;
        } else {
            $image = '/assets/images/avatars/1.png';
        }
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'roles' => auth()->check() ? auth()->user()->roles : '',
            'user_image' => $image,


            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },

            'notifications' => auth('web')->user() ?
                auth()->user()->notifications()->orderBy('id', 'desc')
                    ->whereNull('is_read')->limit(5)->get()
                : '',
            'notifications_count' => auth('web')->user() ?
                auth()->user()->notifications()->orderBy('id', 'desc')
                    ->whereNull('is_read')->count()
                : '',
            'logo_settings' => LogoSetting::first(),
            'header_items' => WebsiteControl::query()->whereTag('header')->wherePage('main_page')->select('id', 'title', 'order', 'url')->get(),
            'social_media_items' => WebsiteControl::query()->whereTag('social_media')->wherePage('main_page')
                ->select('id', 'title', 'url', DB::raw('CAST(title AS UNSIGNED) AS title'))->get(),
            'footer_item' => WebsiteControl::query()->whereTag('footer_item')->wherePage('main_page')->select('id', 'paragraph')->first(),
            'footer_items' => WebsiteControl::query()->whereTag('footer_items')->wherePage('main_page')->select('id', 'button_text', 'button_url')->get(),

        ]);
    }
}
