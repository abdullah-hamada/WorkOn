<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartnerMainPageRequest;
use App\Http\Requests\Admin\WebsiteMainPageRequest;
use App\Models\WebsiteControl;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class WebsitePageControlController extends Controller
{


    public function main_page_control()
    {
        return Inertia::render('views/admin/WebsiteControl/MainPageControl', [
            'header_items' => WebsiteControl::query()->whereTag('header')->wherePage('main_page')->select('id', 'title', 'order', 'url')->get(),
            'section_one_item' => WebsiteControl::query()->whereTag('section_one')->wherePage('main_page')->select('id', 'title', 'paragraph', 'button_text', 'button_url', 'image')->first(),
            'section_two_item' => WebsiteControl::query()->whereTag('section_two')->wherePage('main_page')->select('id', 'title', 'paragraph', 'image','button_url')->first(),
//            'section_three_items' => WebsiteControl::query()->whereTag('section_three_items')->wherePage('main_page')->select('id', 'title', 'sub_title', 'image')->get(),
            'section_three_item' => WebsiteControl::query()->whereTag('section_three_item')->wherePage('main_page')->select('id', 'title')->first(),
            'section_four_item' => WebsiteControl::query()->whereTag('section_four')->wherePage('main_page')->select('id', 'title', 'paragraph', 'button_text', 'button_url', 'image')->first(),
            'section_five_items' => WebsiteControl::query()->whereTag('section_five_items')->wherePage('main_page')->select('id', 'title', 'sub_title', 'image')->get(),
            'section_five_item' => WebsiteControl::query()->whereTag('section_five_item')->wherePage('main_page')->select('id', 'title', 'paragraph')->first(),
            'section_six_items' => WebsiteControl::query()->whereTag('section_six_items')->wherePage('main_page')->select('id', 'title', 'image' ,'sub_title','button_url')->get(),
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
            'footer_items' => WebsiteControl::query()->whereTag('footer_items')->wherePage('main_page')->select('id', 'button_text', 'button_url')->get(),


            'social_media_items' => WebsiteControl::query()->whereTag('social_media')->wherePage('main_page')
                ->select('id', 'title', 'url', DB::raw('CAST(title AS DECIMAL) AS title'))->get()->map(function ($item) {
                    return [
                        'title' => intval($item->title),
                        'url' => $item['url'],
                        'id' => $item['id'],
                    ];
                }),


            'footer_item' => WebsiteControl::query()->whereTag('footer_item')->wherePage('main_page')->select('id', 'paragraph')->first(),
            'slider_items' => WebsiteControl::query()->whereTag('slider')->wherePage('main_page')->select('id', 'title', 'paragraph', 'button_text', 'button_url', 'image')->get(),
            'partner_items' => WebsiteControl::query()->whereTag('partner_items')->wherePage('main_page')->select('id', 'button_url', 'image')->get(),


        ]);
    }

    public function save_main_page_control(WebsiteMainPageRequest $request)
    {
        WebsiteControl::query()->whereIn('id', collect(WebsiteControl::whereTag('header')
            ->wherePage('main_page')->pluck('id'))->diff(collect($request->header_items)->pluck('id')))
            ->delete();
        if (isset($request->header_items) && count($request->header_items) > 0) {
            foreach ($request->header_items as $item) {
                $header_item = WebsiteControl::find($item['id']);
                $header_item->update([
                    'title' => $item['title'],
                    'url' => $item['url'],
                    'order' => $item['order'],
                ]);
            }
        }
        WebsiteControl::query()->whereIn('id', collect(WebsiteControl::whereTag('slider')->wherePage('main_page')->pluck('id'))->diff(collect($request->slider_items)->pluck('id')))
            ->delete();
        if (isset($request->slider_items) && count($request->slider_items) > 0) {

            foreach ($request->slider_items as $item) {

                if (isset($item['type']) && $item['type'] == 'new') {
                    if ($item['image'] != null) {
                        uploadImage('website_images', $item['image']);
                        $image = $item['image']->hashName();
                    }
                    WebsiteControl::query()->create([
                        'title' => $item['title'],
                        'paragraph' => $item['paragraph'],
                        'button_url' => $item['button_url'],
                        'button_text' => $item['button_text'],
                        'image' => $image ?? 'logo.jfif',
                        'page' => 'main_page',
                        'tag' => 'slider'
                    ]);
                } else {
                    $slider_item = WebsiteControl::find($item['id']);
                    $data =
                        ['title' => $item['title'],
                            'paragraph' => $item['paragraph'],
                            'button_url' => $item['button_url'],
                            'button_text' => $item['button_text']
                        ];
                    if ($item['image'] != $slider_item->image) {
                        deletePreviousImage('website_images', $slider_item->image);
                        uploadImage('website_images', $item['image']);
                        $data['image'] = $item['image']->hashName();
                    }
                    $slider_item->update($data);
                }
            }
        }
        WebsiteControl::query()->whereIn('id', collect(WebsiteControl::whereTag('partner_items')->wherePage('main_page')->pluck('id'))->diff(collect($request->partner_items)->pluck('id')))
            ->delete();
        if (isset($request->partner_items) && count($request->partner_items) > 0) {

            foreach ($request->partner_items as $item) {

                if (isset($item['type']) && $item['type'] == 'new') {
                    if ($item['image'] != null) {
                        uploadImage('website_images', $item['image']);
                        $image = $item['image']->hashName();
                    }
                    WebsiteControl::query()->create([
                         'button_url' => $item['button_url'],
                         'image' => $image ?? 'logo.jfif',
                        'page' => 'main_page',
                        'tag' => 'partner_items'
                    ]);
                } else {
                    $partner_item = WebsiteControl::find($item['id']);
                    $data =
                        [
                            'button_url' => $item['button_url'],
                         ];
                    if ($item['image'] != $partner_item->image) {
                        deletePreviousImage('website_images', $partner_item->image);
                        uploadImage('website_images', $item['image']);
                        $data['image'] = $item['image']->hashName();
                    }
                    $partner_item->update($data);
                }
            }
        }


//        if (isset($request->section_one_item)) {
//            $section_one_item = WebsiteControl::find($request->section_one_item['id']);
//            $image = $section_one_item->image;
//            if ($request->section_one_item['image'] != null && $section_one_item->image != $request->section_one_item['image']) {
//                deletePreviousImage('website_images', $section_one_item->image);
//                uploadImage('website_images', $request->section_one_item['image']);
//                $image = $request->section_one_item['image']->hashName();
//            }
//            $section_one_item->update([
//                'image' => $image,
//                'title' => $request->section_one_item['title'],
//                'button_url' => $request->section_one_item['button_url'],
//                'button_text' => $request->section_one_item['button_text'],
//                'paragraph' => $request->section_one_item['paragraph'],
//            ]);
//
//        }


        if (isset($request->section_two_item)) {
            $section_two_item = WebsiteControl::find($request->section_two_item['id']);
            $image = $section_two_item->image;
            if ($request->section_two_item['image'] != null && $section_two_item->image != $request->section_two_item['image']) {
                deletePreviousImage('website_images', $section_two_item->image);
                uploadImage('website_images', $request->section_two_item['image']);
                $image = $request->section_two_item['image']->hashName();
            }
            $section_two_item->update([
                'image' => $image,
                'title' => $request->section_two_item['title'],
                'paragraph' => $request->section_two_item['paragraph'],
                'button_url'=>$request->section_two_item['button_url']
            ]);

        }
        if (isset($request->section_three_item)) {
            $section_three_item = WebsiteControl::find($request->section_three_item['id']);
            $section_three_item->update([
                'title' => $request->section_three_item['title'],
            ]);
        }


        WebsiteControl::query()->whereIn('id', collect(WebsiteControl::whereTag('section_three_items')->wherePage('main_page')->pluck('id'))->diff(collect($request->section_three_items)->pluck('id')))
            ->delete();
        if (isset($request->section_three_items) && count($request->section_three_items) > 0) {
            foreach ($request->section_three_items as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    if ($item['image'] != null) {
                        uploadImage('website_images', $item['image']);
                        $image = $item['image']->hashName();
                    }
                    WebsiteControl::query()->create([
                        'title' => $item['title'],
                        'sub_title' => $item['sub_title'],
                        'image' => $image,
                        'page' => 'main_page',
                        'tag' => 'section_three_items'
                    ]);
                } else {
                    $section_three_item = WebsiteControl::find($item['id']);
                    $data =
                        ['title' => $item['title'],
                            'sub_title' => $item['sub_title'],
                        ];
                    if ($item['image'] != $section_three_item->image) {
                        deletePreviousImage('website_images', $section_three_item->image);
                        uploadImage('website_images', $item['image']);
                        $data['image'] = $item['image']->hashName();
                    }
                    $section_three_item->update($data);
                }

            }


        }


        if (isset($request->section_four_item)) {
            $section_four_item = WebsiteControl::find($request->section_four_item['id']);
            $image = $section_four_item->image;
            if ($request->section_four_item['image'] != null && $section_four_item->image != $request->section_four_item['image']) {
                deletePreviousImage('website_images', $section_four_item->image);
                uploadImage('website_images', $request->section_four_item['image']);
                $image = $request->section_four_item['image']->hashName();
            }
            $section_four_item->update([
                'image' => $image,
                'title' => $request->section_four_item['title'],
                'paragraph' => $request->section_four_item['paragraph'],
                'button_text' => $request->section_four_item['button_text'],
                'button_url' => $request->section_four_item['button_url'],

            ]);

        }


        if (isset($request->section_five_item)) {
            $section_five_item = WebsiteControl::find($request->section_five_item['id']);
            $section_five_item->update([
                'title' => $request->section_five_item['title'],
                'paragraph' => $request->section_five_item['paragraph'],

            ]);
        }

        WebsiteControl::query()->whereIn('id', collect(WebsiteControl::whereTag('section_five_items')->wherePage('main_page')->pluck('id'))->diff(collect($request->section_five_items)->pluck('id')))
            ->delete();
        if (isset($request->section_five_items) && count($request->section_five_items) > 0) {
            foreach ($request->section_five_items as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    if ($item['image'] != null) {
                        uploadImage('website_images', $item['image']);
                        $image = $item['image']->hashName();
                    }
                    WebsiteControl::query()->create([
                        'title' => $item['title'],
                        'sub_title' => $item['sub_title'],
                        'image' => $image,
                        'page' => 'main_page',
                        'tag' => 'section_five_items'
                    ]);
                } else {
                    $section_five_item = WebsiteControl::find($item['id']);
                    $data =
                        ['title' => $item['title'],
                            'sub_title' => $item['sub_title'],
                        ];
                    if ($item['image'] != $section_five_item->image) {
                        deletePreviousImage('website_images', $section_five_item->image);
                        uploadImage('website_images', $item['image']);
                        $data['image'] = $item['image']->hashName();
                    }
                    $section_five_item->update($data);
                }

            }


        }


        if (isset($request->section_six_item)) {
            $section_six_item = WebsiteControl::find($request->section_six_item['id']);
            $section_six_item->update([
                'title' => $request->section_six_item['title'],

            ]);
        }

        WebsiteControl::query()->whereIn('id', collect(WebsiteControl::whereTag('section_six_items')->wherePage('main_page')->pluck('id'))->diff(collect($request->section_six_items)->pluck('id')))
            ->delete();
        if (isset($request->section_six_items) && count($request->section_six_items) > 0) {
            foreach ($request->section_six_items as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    if ($item['image'] != null) {
                        uploadImage('website_images', $item['image']);
                        $image = $item['image']->hashName();
                    }
                    WebsiteControl::query()->create([
                        'title' => $item['title'],
                        'sub_title' => $item['sub_title'],
                        'button_url' => $item['button_url'],
                        'image' => $image,
                        'page' => 'main_page',
                        'tag' => 'section_six_items'
                    ]);
                } else {
                    $section_six_item = WebsiteControl::find($item['id']);
                    $data =
                        ['title' => $item['title'],
                            'sub_title' => $item['sub_title'],
                            'button_url' => $item['button_url'],
                        ];
                    if ($item['image'] != $section_six_item->image) {
                        deletePreviousImage('website_images', $section_six_item->image);
                        uploadImage('website_images', $item['image']);
                        $data['image'] = $item['image']->hashName();
                    }
                    $section_six_item->update($data);
                }

            }


        }

        if (isset($request->section_seven_item)) {
            $section_seven_item = WebsiteControl::find($request->section_seven_item['id']);
            $section_seven_item->update([
                'title' => $request->section_seven_item['title'],

            ]);
        }

        WebsiteControl::query()->whereIn('id', collect(WebsiteControl::whereTag('section_seven_items')->wherePage('main_page')->pluck('id'))->diff(collect($request->section_seven_items)->pluck('id')))
            ->delete();
        if (isset($request->section_seven_items) && count($request->section_seven_items) > 0) {
            foreach ($request->section_seven_items as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    if ($item['image'] != null) {
                        uploadImage('website_images', $item['image']);
                        $image = $item['image']->hashName();
                    }
                    WebsiteControl::query()->create([
                        'title' => $item['title'],
                        'sub_title' => $item['sub_title'],
                        'image' => $image,
                        'page' => 'main_page',
                        'tag' => 'section_seven_items'
                    ]);
                } else {
                    $section_seven_item = WebsiteControl::find($item['id']);
                    $data =
                        ['title' => $item['title'],
                            'sub_title' => $item['sub_title'],

                        ];
                    if ($item['image'] != $section_seven_item->image) {
                        deletePreviousImage('website_images', $section_seven_item->image);
                        uploadImage('website_images', $item['image']);
                        $data['image'] = $item['image']->hashName();
                    }
                    $section_seven_item->update($data);
                }

            }


        }
        if (isset($request->section_nine_item)) {
            $section_nine_item = WebsiteControl::find($request->section_nine_item['id']);
            $section_nine_item->update([
                'title' => $request->section_nine_item['title'],
                'button_url' => $request->section_nine_item['button_url'],
                'button_text' => $request->section_nine_item['button_text'],
                'paragraph' => $request->section_nine_item['paragraph'],
            ]);

        }


        if (isset($request->section_ten_item)) {
            $section_ten_item = WebsiteControl::find($request->section_ten_item['id']);
            $section_ten_item->update([
                'title' => $request->section_ten_item['title'],
                'paragraph' => $request->section_ten_item['paragraph'],

            ]);
        }


        WebsiteControl::query()->whereIn('id', collect(WebsiteControl::whereTag('section_ten_items')->wherePage('main_page')->pluck('id'))->diff(collect($request->section_ten_items)->pluck('id')))
            ->delete();
        if (isset($request->section_ten_items) && count($request->section_ten_items) > 0) {
            foreach ($request->section_ten_items as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    if ($item['image'] != null) {
                        uploadImage('website_images', $item['image']);
                        $image = $item['image']->hashName();
                    }
                    WebsiteControl::query()->create([
                        'title' => $item['title'],
                        'sub_title' => $item['sub_title'],
                        'twitter_url' => $item['twitter_url'],
                        'linked_in_url' => $item['linked_in_url'],
                        'instagram_url' => $item['instagram_url'],
                        'facebook_url' => $item['facebook_url'],
                        'image' => $image,
                        'page' => 'main_page',
                        'tag' => 'section_ten_items'
                    ]);
                } else {
                    $section_ten_item = WebsiteControl::find($item['id']);
                    $data =
                        ['title' => $item['title'],
                            'sub_title' => $item['sub_title'],
                            'twitter_url' => $item['twitter_url'],
                            'linked_in_url' => $item['linked_in_url'],
                            'instagram_url' => $item['instagram_url'],
                            'facebook_url' => $item['facebook_url'],
                        ];
                    if ($item['image'] != $section_ten_item->image) {
                        deletePreviousImage('website_images', $section_ten_item->image);
                        uploadImage('website_images', $item['image']);
                        $data['image'] = $item['image']->hashName();
                    }
                    $section_ten_item->update($data);
                }

            }


        }


        if (isset($request->section_eleven_item)) {
            $section_eleven_item = WebsiteControl::find($request->section_eleven_item['id']);
            $image = $section_eleven_item->image;
            if ($request->section_eleven_item['image'] != null && $section_eleven_item->image != $request->section_eleven_item['image']) {
                deletePreviousImage('website_images', $section_eleven_item->image);
                uploadImage('website_images', $request->section_eleven_item['image']);
                $image = $request->section_eleven_item['image']->hashName();
            }
            $section_eleven_item->update([
                'image' => $image,
                'title' => $request->section_eleven_item['title'],
                'paragraph' => $request->section_eleven_item['paragraph'],
                'button_text' => $request->section_eleven_item['button_text'],
                'button_url' => $request->section_eleven_item['button_url'],

            ]);

        }

        if (isset($request->section_twelve_item)) {
            $section_twelve_item = WebsiteControl::find($request->section_twelve_item['id']);
            $section_twelve_item->update([
                'title' => $request->section_twelve_item['title'],

            ]);
        }

        WebsiteControl::query()->whereIn('id', collect(WebsiteControl::whereTag('section_twelve_items')->wherePage('main_page')->pluck('id'))->diff(collect($request->section_twelve_items)->pluck('id')))
            ->delete();
        if (isset($request->section_twelve_items) && count($request->section_twelve_items) > 0) {
            foreach ($request->section_twelve_items as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    if ($item['image'] != null) {
                        uploadImage('website_images', $item['image']);
                        $image = $item['image']->hashName();
                    }
                    WebsiteControl::query()->create([
                        'title' => $item['title'],
                        'sub_title' => $item['sub_title'],
                        'paragraph' => $item['paragraph'],
                        'image' => $image,
                        'page' => 'main_page',
                        'tag' => 'section_twelve_items'
                    ]);
                } else {
                    $section_twelve_item = WebsiteControl::find($item['id']);
                    $data =
                        ['title' => $item['title'],
                            'sub_title' => $item['sub_title'],
                            'paragraph' => $item['paragraph'],
                        ];
                    if ($item['image'] != $section_twelve_item->image) {
                        deletePreviousImage('website_images', $section_twelve_item->image);
                        uploadImage('website_images', $item['image']);
                        $data['image'] = $item['image']->hashName();
                    }
                    $section_twelve_item->update($data);
                }

            }


        }
        WebsiteControl::query()->whereIn('id', collect(WebsiteControl::whereTag('social_media')->wherePage('main_page')->pluck('id'))->diff(collect($request->social_media_items)->pluck('id')))
            ->delete();
        foreach ($request->social_media_items as $item) {
            if (isset($item['type']) && $item['type'] == 'new') {
                WebsiteControl::query()->create([
                    'url' => $item['url'],
                    'title' => $item['title'],
                    'page' => 'main_page',
                    'tag' => 'social_media'
                ]);
            } else {
                $social_media_item = WebsiteControl::find($item['id']);
                $social_media_item->update(
                    [
                        'url' => $item['url'],
                        'title' => $item['title'],
                    ]);
            }
        }

        if (isset($request->footer_item)) {
            $footer_item = WebsiteControl::find($request->footer_item['id']);
            $footer_item->update([
                'paragraph' => $request->footer_item['paragraph'],
            ]);
        }


        WebsiteControl::query()->whereIn('id', collect(WebsiteControl::whereTag('footer_items')->wherePage('main_page')->pluck('id'))->diff(collect($request->footer_items)->pluck('id')))
            ->delete();
        foreach ($request->footer_items as $item) {
            if (isset($item['type']) && $item['type'] == 'new') {
                WebsiteControl::query()->create([
                    'button_url' => $item['button_url'],
                    'button_text' => $item['button_text'],
                    'page' => 'main_page',
                    'tag' => 'footer_items'
                ]);
            } else {
                $footer_item = WebsiteControl::find($item['id']);
                $footer_item->update(
                    [
                        'button_url' => $item['button_url'],
                        'button_text' => $item['button_text'],
                    ]);
            }
        }
        return redirect()->back()->with('success', 'تم التحديث بنجاح');


    }


    public function partner_page_control()
    {
        return Inertia::render('views/admin/WebsiteControl/PartnerPageControl', [
            'slider_items' => WebsiteControl::query()->whereTag('slider')->wherePage('partner_page')->select('id', 'title', 'paragraph', 'button_text', 'button_url', 'image')->get(),
            'section_two_item' => WebsiteControl::query()->whereTag('section_two')->wherePage('partner_page')->select('id', 'title', 'paragraph', 'image')->first(),
            'section_three_items' => WebsiteControl::query()->whereTag('section_three_items')->wherePage('partner_page')->select('id', 'title', 'sub_title', 'image')->get(),
            'section_three_item' => WebsiteControl::query()->whereTag('section_three_item')->wherePage('partner_page')->select('id', 'title')->first(),
            'section_four_item' => WebsiteControl::query()->whereTag('section_four_item')->wherePage('partner_page')->select('id', 'title', 'paragraph', 'button_text', 'button_url', 'image')->first(),
            'section_six_items' => WebsiteControl::query()->whereTag('section_six_items')->wherePage('partner_page')->select('id', 'title', 'sub_title', 'image', 'paragraph')->get(),
            'section_six_item' => WebsiteControl::query()->whereTag('section_six_item')->wherePage('partner_page')->select('id', 'title')->first(),
        ]);
    }

    public function save_partner_page_control(PartnerMainPageRequest $request)
    {

        WebsiteControl::query()->whereIn('id', collect(WebsiteControl::whereTag('slider')->wherePage('partner_page')->pluck('id'))->diff(collect($request->slider_items)->pluck('id')))
            ->delete();
        if (isset($request->slider_items) && count($request->slider_items) > 0) {

            foreach ($request->slider_items as $item) {

                if (isset($item['type']) && $item['type'] == 'new') {
                    if ($item['image'] != null) {
                        uploadImage('website_images', $item['image']);
                        $image = $item['image']->hashName();
                    }
                    WebsiteControl::query()->create([
                        'title' => $item['title'],
                        'paragraph' => $item['paragraph'],
                        'button_url' => $item['button_url'],
                        'button_text' => $item['button_text'],
                        'image' => $image ?? 'logo.jfif',
                        'page' => 'partner_page',
                        'tag' => 'slider'
                    ]);
                } else {
                    $slider_item = WebsiteControl::find($item['id']);
                    $data =
                        ['title' => $item['title'],
                            'paragraph' => $item['paragraph'],
                            'button_url' => $item['button_url'],
                            'button_text' => $item['button_text']
                        ];
                    if ($item['image'] != $slider_item->image) {
                        deletePreviousImage('website_images', $slider_item->image);
                        uploadImage('website_images', $item['image']);
                        $data['image'] = $item['image']->hashName();
                    }
                    $slider_item->update($data);
                }
            }
        }


        if (isset($request->section_two_item)) {
            $section_two_item = WebsiteControl::find($request->section_two_item['id']);
            $image = $section_two_item->image;
            if ($request->section_two_item['image'] != null && $section_two_item->image != $request->section_two_item['image']) {
                deletePreviousImage('website_images', $section_two_item->image);
                uploadImage('website_images', $request->section_two_item['image']);
                $image = $request->section_two_item['image']->hashName();
            }
            $section_two_item->update([
                'image' => $image,
                'title' => $request->section_two_item['title'],
                'paragraph' => $request->section_two_item['paragraph'],
            ]);

        }


        if (isset($request->section_three_item)) {
            $section_three_item = WebsiteControl::find($request->section_three_item['id']);
            $section_three_item->update([
                'title' => $request->section_three_item['title'],
            ]);
        }


        WebsiteControl::query()->whereIn('id', collect(WebsiteControl::whereTag('section_three_items')->wherePage('partner_page')->pluck('id'))->diff(collect($request->section_three_items)->pluck('id')))
            ->delete();
        if (isset($request->section_three_items) && count($request->section_three_items) > 0) {
            foreach ($request->section_three_items as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    if ($item['image'] != null) {
                        uploadImage('website_images', $item['image']);
                        $image = $item['image']->hashName();
                    }
                    WebsiteControl::query()->create([
                        'title' => $item['title'],
                        'sub_title' => $item['sub_title'],
                        'image' => $image,
                        'page' => 'partner_page',
                        'tag' => 'section_three_items'
                    ]);
                } else {
                    $section_three_item = WebsiteControl::find($item['id']);
                    $data =
                        ['title' => $item['title'],
                            'sub_title' => $item['sub_title'],
                        ];
                    if ($item['image'] != $section_three_item->image) {
                        deletePreviousImage('website_images', $section_three_item->image);
                        uploadImage('website_images', $item['image']);
                        $data['image'] = $item['image']->hashName();
                    }
                    $section_three_item->update($data);
                }

            }


        }


        if (isset($request->section_four_item)) {
            $section_four_item = WebsiteControl::find($request->section_four_item['id']);
            $image = $section_four_item->image;
            if ($request->section_four_item['image'] != null && $section_four_item->image != $request->section_four_item['image']) {
                deletePreviousImage('website_images', $section_four_item->image);
                uploadImage('website_images', $request->section_four_item['image']);
                $image = $request->section_four_item['image']->hashName();
            }
            $section_four_item->update([
                'image' => $image,
                'title' => $request->section_four_item['title'],
                'paragraph' => $request->section_four_item['paragraph'],
                'button_text' => $request->section_four_item['button_text'],
                'button_url' => $request->section_four_item['button_url'],

            ]);

        }


        if (isset($request->section_six_item)) {
            $section_six_item = WebsiteControl::find($request->section_six_item['id']);
            $section_six_item->update([
                'title' => $request->section_six_item['title'],

            ]);
        }

        WebsiteControl::query()->whereIn('id', collect(WebsiteControl::whereTag('section_six_items')->wherePage('partner_page')->pluck('id'))->diff(collect($request->section_six_items)->pluck('id')))
            ->delete();
        if (isset($request->section_six_items) && count($request->section_six_items) > 0) {
            foreach ($request->section_six_items as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    if ($item['image'] != null) {
                        uploadImage('website_images', $item['image']);
                        $image = $item['image']->hashName();
                    }
                    WebsiteControl::query()->create([
                        'title' => $item['title'],
                        'sub_title' => $item['sub_title'],
                        'paragraph' => $item['paragraph'],
                        'image' => $image,
                        'page' => 'partner_page',
                        'tag' => 'section_six_items'
                    ]);
                } else {
                    $section_six_item = WebsiteControl::find($item['id']);
                    $data =
                        ['title' => $item['title'],
                            'sub_title' => $item['sub_title'],
                            'paragraph' => $item['paragraph'],
                        ];
                    if ($item['image'] != $section_six_item->image) {
                        deletePreviousImage('website_images', $section_six_item->image);
                        uploadImage('website_images', $item['image']);
                        $data['image'] = $item['image']->hashName();
                    }
                    $section_six_item->update($data);
                }

            }


        }


        return redirect()->back()->with('success', 'تم التحديث بنجاح');


    }


}
