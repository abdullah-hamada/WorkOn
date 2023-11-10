<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MultakaRequest;
use App\Models\Category;
use App\Models\Country;
use App\Models\GuestNamed;
use App\Models\Multaka;
use App\Models\MultakaAgenda;
use App\Models\MultakaFile;
use App\Models\MultakaGalleryImage;
use App\Models\MultakaGuest;
use App\Models\MultakaSpeaker;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MultakaController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $multaka_items = Multaka::query();
        if (isset($request->title)) {
            $multaka_items = $multaka_items->where('title', 'like', '%' . $request->title . '%');
        }
        if (isset($request->sort)) {
            $multaka_items = $multaka_items->orderBy('date_from', $request->sort);
        } else {
            $multaka_items = $multaka_items->orderByDesc('id');
        }
        return Inertia::render('views/admin/Multaka/Index', [
            'multaka_items' => $multaka_items
                ->with('type:id,name')
                ->select('id', 'title', 'brief_explanation', 'date_from', 'date_to', 'location_type', 'price_type', 'price_amount', 'type_id', 'status', 'image')->get(),
            'filters' => $request->only(['title', 'sort']),
            'timezone' => getTimeZone()
        ]);
    }

    public function store(MultakaRequest $request)
    {
//        $response = $this->validate_multaka($request);
//        if (isset($response['status']) && $response['status'] == 'error') {
//            return redirect()->back()->with($response['status'], $response['message']);
//        }
        $data = [
            'title' => $request->title,
            'brief_explanation' => $request->brief_explanation,
            'date_from' => Carbon::parse($request->date_from),
            'date_to' => Carbon::parse($request->date_to),
            'location_type' => $request->location_type,
            'link' => $request->link,
            'price_type' => $request->price_type,
            'organizer_named_id' => $request->organizer_named_id,
            'organizer_name' => $request->organizer_name,
            'organizer_info' => $request->organizer_info,
            'type_id' => $request->type_id,
            'status' => 1,
        ];

        if ($request->price_type == 2) {
            $data['price_amount'] = 0;
        } else {
            $data['price_amount'] = $request->price_amount;
        }

        if (isset($request->image) && !empty($request->image) && $request->image != null) {
            $data['image'] = $request->image->hashName();
            uploadImage('multaka_logos', $request->image);
        } else {
            $data['image'] = 'logo.jfif';
        }

        $multaka = Multaka::create($data);
        if (isset($request->times) && count($request->times) > 0) {
            foreach ($request->times as $item) {
                MultakaAgenda::query()->create([
                    'date' => $item['date'],
                    'time_from' => $item['time_from'],
                    'time_to' => $item['time_to'],
                    'title' => $item['title'],
                    'multaka_id' => $multaka->id
                ]);
            }

        }
        if (isset($request->speakers) && count($request->speakers) > 0) {

            foreach ($request->speakers as $item) {
                uploadImage('multaka_speakers_images', $item['image']);
                MultakaSpeaker::query()->create([
                    'name' => $item['name'],
                    'job_title' => $item['job_title'],
                    'image' => $item['image']->hashName(),
                    'work_location' => $item['work_location'],
                    'country_id' => $item['country_id'],
                    'multaka_id' => $multaka->id,
                    'created_by' => 'Admin',
                    'status' => 1
                ]);
            }
        }
        if (isset($request->guest_items) && count($request->guest_items) > 0) {
            foreach ($request->guest_items as $item) {
                MultakaGuest::query()->create([
                    'name' => $item['name'],
                    'info' => $item['info'],
                    'multaka_id' => $multaka->id,
                    'created_by' => 'Admin',
                    'status' => 1
                ]);
            }
        }
        if (isset($request->multaka_files) && count($request->multaka_files) > 0) {
            foreach ($request->multaka_files as $item) {
                if ($item['file'] == null || $item['title'] == null) {
                    return redirect()->back()->with('error', 'الرجاء إدخال   المرفقات بالشكل الصحيح');
                }
                $files_data['title'] = $item['title'];
                $files_data['multaka_id'] = $multaka->id;
                uploadImage('multaka_files', $item['file']);
                $files_data['file'] = $item['file']->hashName();
                MultakaFile::query()->create($files_data);
            }
        }

        if (isset($request->multaka_gallery)) {
            foreach ($request->multaka_gallery as $item) {
                uploadImage('multaka_gallery_images', $item['image']);
                MultakaGalleryImage::query()->create([
                    'image' => $item['image']->hashName(),
                    'multaka_id' => $multaka->id
                ]);
            }
        }

        if ($multaka) {
            //   $this->dispatch(new CreateMultakaNotification($multaka->id));
            return redirect('/admin/multaka')->with('success', 'تم الحفظ بنجاح');
        } else {
            return redirect('/admin/multaka')->with('error', 'حدث خطا ما');
        }
    }

    public function create()
    {
        return Inertia::render('views/admin/Multaka/Create', [
            'categories' => Category::all(),
            'countries' => Country::query()->select('id', 'name_ar')->get(),
            'types' => Type::query()->orderByDesc('id')->get(),
            'guest_named' => GuestNamed::query()->orderByDesc('id')->get()
        ]);
    }

    public function edit($id)
    {
        $multaka = Multaka::with(['guest_items:id,name,info,multaka_id', 'gallery_images:id,image,multaka_id',
            'files:id,title,file,multaka_id', 'agendas:id,time_from,time_to,title,date,multaka_id',
            'multaka_speakers:id,name,job_title,country_id,work_location,image,status,user_id,multaka_id'])->where('id', $id)->first();
        if (!$multaka) {
            abort(404);
        }
        $multaka->date_from = Carbon::parse($multaka->date_from)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');
        $multaka->date_to = Carbon::parse($multaka->date_to)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');
        return Inertia::render('views/admin/Multaka/Edit', [
            'countries' => Country::all(),
            'multaka' => $multaka,
            'guest_named' => GuestNamed::query()->orderByDesc('id')->get(),
            'types' => Type::query()->orderByDesc('id')->get(),


        ]);
    }

    public function change_status($id)
    {
        $multaka = Multaka::find($id);
        if (!$multaka) {
            abort(404);
        }
        $status = $multaka->update([
            'status' => $multaka->status == 0 ? 1 : 0
        ]);
        if ($status) {
            return redirect()->back()->with('success', 'تم تحديث الحالة بنجاح');
        }
    }


//    public function destroy($id)
//    {
//        $multaka = Multaka::find($id);
//        if (!$multaka) {
//            abort(404);
//        }
//        if (count($multaka->subscriber_users) > 0) {
//            return redirect()->back()->with('error', '   لا يمكن الحذف لوجود مشتركين  ');
//        }
//        $status = $multaka->delete();
//        if ($status) {
//            return redirect()->back()->with('success', 'تم الحذف بنجاح');
//        }
//    }

    public function update(MultakaRequest $request, $id)
    {
        $multaka = Multaka::find($id);
        if (!$multaka) {
            abort(404);
        }
//        if (count($multaka->subscriber_users) > 0) {
//            return redirect()->back()->with('error', '   لا يمكن التحديث لوجود مشتركين  ');
//        }
//        $response = $this->validate_multaka($request);
//        if (isset($response['status']) && $response['status'] == 'error') {
//            return redirect()->back()->with($response['status'], $response['message']);
//        }

        $data = [
            'title' => $request->title,
            'brief_explanation' => $request->brief_explanation,
            'location_type' => $request->location_type,
            'link' => $request->link,
            'price_type' => $request->price_type,
            'organizer_named_id' => $request->organizer_named_id,
            'organizer_name' => $request->organizer_name,
            'organizer_info' => $request->organizer_info,
            'type_id' => $request->type_id,
        ];
        if (isset($request->date_from) && Carbon::parse($request->date_from)->format('Y-m-d H:i') != Carbon::parse($multaka->date_from)->setTimezone(getTimeZone())->format('Y-m-d H:i')) {
            $data['date_from'] = Carbon::parse($request->date_from);
        }
        if (isset($request->date_to) && Carbon::parse($request->date_to)->format('Y-m-d H:i') != Carbon::parse($multaka->date_to)->setTimezone(getTimeZone())->format('Y-m-d H:i')) {
            $data['date_to'] = Carbon::parse($request->date_to);
        }
        if ($request->price_type == 2) {
            $data['price_amount'] = 0;
        } else {
            $data['price_amount'] = $request->price_amount;
        }

        if (isset($request->image) && !empty($request->image) && $request->image != null) {
            $data['image'] = $request->image->hashName();
            uploadImage('multaka_logos', $request->image);
        }
        $multaka->update($data);
        MultakaAgenda::query()->whereIn('id', collect($multaka->agendas)->pluck('id')->diff(collect($request->times)->pluck('id')))->delete();
        foreach ($request->times as $item) {
            if ($item['date'] == null || $item['time_from'] == null || $item['time_to'] == null || $item['title'] == null) {
                return redirect()->back()->with('error', 'الرجاء إدخال   المواعيد بالشكل الصحيح');
            }
            if (isset($item['type']) && $item['type'] == 'new') {
                MultakaAgenda::query()->create([
                    'date' => $item['date'],
                    'time_from' => $item['time_from'],
                    'time_to' => $item['time_to'],
                    'title' => $item['title'],
                    'multaka_id' => $multaka->id
                ]);
            } else {
                $multaka_agenda = MultakaAgenda::find($item['id']);
                $multaka_agenda->update([
                    'date' => $item['date'],
                    'time_from' => $item['time_from'],
                    'time_to' => $item['time_to'],
                    'title' => $item['title'],
                ]);
            }
        }

        MultakaSpeaker::query()->whereIn('id', collect($multaka->multaka_speakers)->pluck('id')->diff(collect($request->speakers)->pluck('id')))->delete();
        if (isset($request->speakers) && count($request->speakers) > 0) {
            foreach ($request->speakers as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    uploadImage('multaka_speakers_images', $item['image']);
                    MultakaSpeaker::query()->create([
                        'name' => $item['name'],
                        'job_title' => $item['job_title'],
                        'image' => $item['image']->hashName(),
                        'work_location' => $item['work_location'],
                        'country_id' => $item['country_id'],
                        'multaka_id' => $multaka->id,
                        'created_by' => 'Admin',
                        'status' => 1
                    ]);
                } else {
                    $speaker = MultakaSpeaker::find($item['id']);
                    if ($item['image'] == $speaker->image) {
                        $speaker->update([
                            'name' => $item['name'],
                            'job_title' => $item['job_title'],
                            'work_location' => $item['work_location'],
                            'country_id' => $item['country_id'],
                        ]);
                    } else {
                        deletePreviousImage('multaka_speakers_images', $speaker->image);
                        uploadImage('multaka_speakers_images', $item['image']);
                        $speaker->update([
                            'name' => $item['name'],
                            'job_title' => $item['job_title'],
                            'image' => $item['image']->hashName(),
                            'work_location' => $item['work_location'],
                            'country_id' => $item['country_id'],
                        ]);
                    }
                }
            }
        }
        MultakaGuest::query()->whereIn('id', collect($multaka->guest_items)->pluck('id')->diff(collect($request->guest_items)->pluck('id')))->delete();
        if (isset($request->guest_items) && count($request->guest_items) > 0) {
            foreach ($request->guest_items as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    MultakaGuest::query()->create([
                        'name' => $item['name'],
                        'info' => $item['info'],
                        'multaka_id' => $multaka->id,
                        'created_by' => 'Admin',
                        'status' => 1
                    ]);
                } else {
                    $guest = MultakaGuest::find($item['id']);
                    $guest->update([
                        'name' => $item['name'],
                        'info' => $item['info'],
                    ]);
                }
            }
        }

        MultakaFile::query()->whereIn('id', collect($multaka->files)->pluck('id')->diff(collect($request->multaka_files)->pluck('id')))->delete();
        if (isset($request->multaka_files) && count($request->multaka_files) > 0) {
            foreach ($request->multaka_files as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    uploadImage('multaka_files', $item['file']);
                    MultakaFile::query()->create([
                        'title' => $item['title'],
                        'multaka_id' => $multaka->id,
                        'file' => $item['file']->hashName()
                    ]);
                } else {
                    $file = MultakaFile::find($item['id']);
                    if ($item['file'] == $file->file) {
                        $file->update([
                            'title' => $item['title'],
                            'multaka_id' => $multaka->id,
                        ]);
                    } else {
                        deletePreviousImage('multaka_files', $file->file);
                        uploadImage('multaka_files', $item['file']);
                        $file->update([
                            'file' => $item['file']->hashName(),
                            'title' => $item['title'],
                        ]);
                    }
                }
            }
        }
        MultakaGalleryImage::query()->whereIn('id', collect($multaka->gallery_images)->pluck('id')->diff(collect($request->multaka_gallery)->pluck('id')))->delete();
        if (isset($request->multaka_gallery) && count($request->multaka_gallery) > 0) {
            foreach ($request->multaka_gallery as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    uploadImage('multaka_gallery_images', $item['image']);
                    MultakaGalleryImage::query()->create([
                        'image' => $item['image']->hashName(),
                        'multaka_id' => $multaka->id
                    ]);
                } else {
                    $gallery_image = MultakaGalleryImage::find($item['id']);
                    if ($item['image'] != $gallery_image->image) {
                        deletePreviousImage('multaka_gallery_images', $gallery_image->image);
                        uploadImage('multaka_gallery_images', $item['image']);
                        $gallery_image->update([
                            'image' => $item['image']->hashName(),
                        ]);
                    }

                }
            }
        }

        if ($multaka) {
            return redirect('/admin/multaka')->with('success', 'تم التحديث بنجاح');
        } else {
            return redirect('/admin/multaka')->with('error', 'حدث خطا ما');
        }
    }

    public function validate_multaka($request)
    {
        if (empty($request->times)) {
            return [
                'status' => 'error',
                'message' => 'الرجاء إدخال   المواعيد بالشكل الصحيح'

            ];
        }
        if (isset($request->times)) {
            foreach ($request->times as $item) {
                if ($item['date'] == null || $item['time_from'] == null || $item['time_to'] == null
                    || $item['title'] == null
//                    || $item['date'] < $request->date_from
//                    || $item['date'] > $request->date_to
                ) {
                    return [
                        'status' => 'error',
                        'message' => 'الرجاء إدخال   المواعيد بالشكل الصحيح'
                    ];
                }
                if ($item['date'] == $request->date_from) {
                    if ($item['time_from'] < $request->time_from) {
                        return [
                            'status' => 'error',
                            'message' => 'الرجاء إدخال   المواعيد بالشكل الصحيح'
                        ];
                    }
                }
                if ($item['date'] == $request->date_to) {
                    if ($item['time_to'] > $request->time_to) {
                        return [
                            'status' => 'error',
                            'message' => 'الرجاء إدخال   المواعيد بالشكل الصحيح'
                        ];
                    }
                }
            }
        }
        if (isset($request->speakers)) {
            foreach ($request->speakers as $item) {
                if ($item['name'] == null || $item['job_title'] == null || $item['image'] == null || $item['work_location'] == null || $item['country_id'] == null) {
                    return [
                        'status' => 'error',
                        'message' => 'الرجاء إدخال   المتحدثين بالشكل الصحيح'
                    ];
                }
            }
        }
        if (isset($request->guest_items)) {
            foreach ($request->guest_items as $item) {
                if ($item['name'] == null || $item['info'] == null) {
                    return [
                        'status' => 'error',
                        'message' => 'الرجاء إدخال   الضيوف بالشكل الصحيح'
                    ];
                }
            }
        }
    }

}
