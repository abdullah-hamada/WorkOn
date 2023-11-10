<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventRequest;
use App\Models\Event;
use App\Models\EventAppointment;
use App\Models\EventFile;
use App\Models\EventGuest;
use App\Models\GalleryImage;
use App\Models\GuestNamed;
use App\Models\QuestionRate;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $events = Event::withCount('subscriber_users');
        if (isset($request->title)) {
            $events = $events->where('title', 'like', '%' . $request->title . '%');
        }
        if (isset($request->sort)) {
            $events = $events->orderBy('date_from', $request->sort);
        } else {
            $events = $events->orderByDesc('id');
        }
        return Inertia::render('views/admin/Events/Index', [
            'event_items' => $events->with('type:id,name')->get(),
            'filters' => $request->only(['title', 'sort']),
            'timezone' => getTimeZone()
        ]);
    }

    public function store(EventRequest $request)
    {
        $response = $this->validate_event($request);
        if (isset($response['status']) && $response['status'] == 'error') {
            return redirect()->back()->with($response['status'], $response['message']);
        }
        $data = [
            'title' => $request->title,
            'brief_explanation' => $request->brief_explanation,
            'date_from' => Carbon::parse($request->date_from),
            'date_to' => Carbon::parse($request->date_to),
            'location_type' => $request->location_type,
            'price_type' => $request->price_type,
            'organizer_named_id' => $request->organizer_named_id,
            'organizer_name' => $request->organizer_name,
            'organizer_info' => $request->organizer_info,
            'guest_name' => $request->guest_name,
            'guest_info' => $request->guest_info,
            'type_id' => $request->type_id,
            'status' => 1,
        ];
        if ($request->price_type == 2) {
            $data['price_amount'] = 0;
        } else {
            $data['price_amount'] = $request->price_amount;
        }

        if (isset($request->link)) {
            $data['link'] = $request->link;
        }

        if (isset($request->image) && !empty($request->image) && $request->image != null) {
            $data['image'] = $request->image->hashName();
            uploadImage('event_images', $request->image);
        } else {
            $data['image'] = 'logo.jfif';
        }
        $event = Event::create($data);
        if (isset($request->times)) {
            foreach ($request->times as $item) {
                EventAppointment::query()->create([
                    'date' => $item['date'],
                    'time_from' => $item['time_from'],
                    'time_to' => $item['time_to'],
                    'title' => $item['title'],
                    'event_id' => $event->id
                ]);
            }
        }
        if (isset($request->event_files) && count($request->event_files) > 0) {
            foreach ($request->event_files as $item) {
                if ($item['file'] == null || $item['title'] == null) {
                    return redirect()->back()->with('error', 'الرجاء إدخال   المرفقات بالشكل الصحيح');
                }
                $files_data['title'] = $item['title'];
                $files_data['event_id'] = $event->id;
                uploadImage('event_files', $item['file']);
                $files_data['file'] = $item['file']->hashName();
                EventFile::query()->create($files_data);
            }
        }

        if (isset($request->event_gallery)) {
            foreach ($request->event_gallery as $event_gallery) {
                uploadImage('gallery_images', $event_gallery['image']);
                GalleryImage::query()->create([
                    'image' => $event_gallery['image']->hashName(),
                    'event_id' => $event->id
                ]);
            }
        }

        if (isset($request->event_questions)) {
            foreach ($request->event_questions as $question) {
                if ($question['type'] == null || $question['title'] == null) {
                    return redirect()->back()->with('error', 'الرجاء إدخال   الأسئلة بالشكل الصحيح');
                }
                QuestionRate::query()->create([
                    'title' => $question['title'],
                    'type' => $question['type'],
                    'event_id' => $event->id
                ]);
            }
        }
        if (isset($request->guest_items) && count($request->guest_items) > 0) {
            foreach ($request->guest_items as $item) {
                EventGuest::query()->create([
                    'name' => $item['name'],
                    'info' => $item['info'],
                    'event_id' => $event->id,
                    'created_by' => 'Admin',
                    'status' => 1
                ]);
            }
        }
        if ($event) {
            //   $this->dispatch(new CreateEventNotification($event->id));
            return redirect('/admin/events')->with('success', 'تم الحفظ بنجاح');
        } else {
            return redirect('/admin/events')->with('error', 'حدث خطا ما ');
        }
    }

    public function validate_event($request)
    {
//        if (empty($request->times)) {
//            return [
//                'status' => 'error',
//                'message' => 'الرجاء إدخال   المواعيد بالشكل الصحيح'
//            ];
//        }
        if (isset($request->times)) {
            foreach ($request->times as $item) {
                if ($item['date'] == null || $item['time_from'] == null || $item['time_to'] == null
                    || $item['title'] == null
                    //|| $item['date'] < $request->date_from
                    //  || $item['date'] > $request->date_to
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
        if (isset($request->event_files)) {
            foreach ($request->event_files as $item) {
                if ($item['file'] == null || $item['title'] == null) {
                    return [
                        'status' => 'error',
                        'message' => 'الرجاء إدخال   المرفقات بالشكل الصحيح'
                    ];
                }
            }
        }
        if (isset($request->event_gallery)) {
            foreach ($request->event_gallery as $item) {
                if ($item['image'] == null) {
                    return [
                        'status' => 'error',
                        'message' => 'الرجاء إدخال   الصور بالشكل الصحيح'
                    ];
                }
            }
        }
        if (isset($request->event_questions)) {
            foreach ($request->event_questions as $question) {
                if ($question['type'] == null || $question['title'] == null) {
                    return [
                        'status' => 'error',
                        'message' => 'الرجاء إدخال   الأسئلة بالشكل الصحيح'
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

    public function create()
    {
        return Inertia::render('views/admin/Events/Create', [
            'types' => Type::query()->orderByDesc('id')->get(),
            'guest_named' => GuestNamed::query()->orderByDesc('id')->get()
        ]);
    }

    public
    function edit($id)
    {
        $event = Event::where('id', $id)
            ->with(['gallery_images:id,image,event_id', 'rate_questions:id,event_id,title,type', 'guest_items:id,name,info,status,event_id', 'files:id,title,file,event_id'])
            ->select('id', 'title', 'brief_explanation', 'date_from', 'date_to', 'location_type', 'link', 'price_type', 'price_amount', 'guest_name'
                , 'organizer_name', 'organizer_info', 'organizer_named_id', 'type_id', 'status', 'image')
            ->first();
        if (!$event) {
            return redirect()->back()->with('error', '   الفعالية غير موجودة ');
        }

        $event->date_from = Carbon::parse($event->date_from)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');
        $event->date_to = Carbon::parse($event->date_to)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');

        return Inertia::render('views/admin/Events/Edit', [
            'event' => $event,
            'event_times' => $event->event_times,
            'types' => Type::query()->orderByDesc('id')->get(),
            'guest_named' => GuestNamed::query()->orderByDesc('id')->get()
        ]);
    }

    public
    function destroy($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return redirect()->back()->with('error', '     الفعالية غير موجودة ');
        }
        if (count($event->subscriber_users) > 0) {
            return redirect()->back()->with('error', '   لا يمكن الحذف لوجود مشتركين  ');
        }
        $status = $event->delete();
        if ($status) {
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        }
    }

    public
    function change_status($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return redirect()->back()->with('error', '     الفعالية غير موجودة ');
        }
        $status = $event->update([
            'status' => $event->status == 0 ? 1 : 0
        ]);
        if ($status) {
            return redirect()->back()->with('success', 'تم تحديث الحالة بنجاح');
        }
    }

    public
    function update(EventRequest $request, $id)
    {
        $response = $this->validate_event($request);
        if (isset($response['status']) && $response['status'] == 'error') {
            return redirect()->back()->with($response['status'], $response['message']);
        }
        $event = Event::find($id);
        if (!$event) {
            return redirect()->back()->with('error', '     الفعالية غير موجودة ');
        }
        $data = [
            'title' => $request->title,
            'brief_explanation' => $request->brief_explanation,
            'location_type' => $request->location_type,
            'price_type' => $request->price_type,
            'organizer_named_id' => $request->organizer_named_id,
            'organizer_name' => $request->organizer_name,
            'organizer_info' => $request->organizer_info,
            'type_id' => $request->type_id,
        ];
        if (isset($request->date_from) && Carbon::parse($request->date_from)->format('Y-m-d H:i') != Carbon::parse($event->date_from)->setTimezone(getTimeZone())->format('Y-m-d H:i')) {
            $data['date_from'] = Carbon::parse($request->date_from);
        }
        if (isset($request->date_to) && Carbon::parse($request->date_to)->format('Y-m-d H:i') != Carbon::parse($event->date_to)->setTimezone(getTimeZone())->format('Y-m-d H:i')) {
            $data['date_to'] = Carbon::parse($request->date_to);
        }
        if ($request->price_type == 2) {
            $data['price_amount'] = 0;
        } else {
            $data['price_amount'] = $request->price_amount;
        }

        if (isset($request->link)) {
            $data['link'] = $request->link;

        }
        if (empty($request->link)) {
            $data['link'] = '';
        }

        if (isset($request->image) && !empty($request->image) && $request->image != null) {
            $data['image'] = $request->image->hashName();
            if ($event->image != null) {
                deletePreviousImage('event_images', auth()->user()->image);
            }
            uploadImage('event_images', $request->image);
        }

        $event->update($data);
        if (isset($request->times)) {
            EventAppointment::query()->whereIn('id', collect($event->event_times)->pluck('id')->diff(collect($request->times)->pluck('id')))->delete();
            foreach ($request->times as $item) {
                if ($item['date'] == null || $item['time_from'] == null || $item['time_to'] == null || $item['title'] == null) {
                    return redirect()->back()->with('error', 'الرجاء إدخال   المواعيد بالشكل الصحيح');
                }
                if (isset($item['type']) && $item['type'] == 'new') {
                    EventAppointment::query()->create([
                        'date' => $item['date'],
                        'time_from' => $item['time_from'],
                        'time_to' => $item['time_to'],
                        'title' => $item['title'],
                        'event_id' => $event->id
                    ]);
                } else {
                    $event_appointment = EventAppointment::find($item['id']);
                    $event_appointment->update([
                        'date' => $item['date'],
                        'time_from' => $item['time_from'],
                        'time_to' => $item['time_to'],
                        'title' => $item['title'],
                    ]);
                }
            }
        }

        EventFile::query()->whereIn('id', collect($event->event_files)->pluck('id')->diff(collect($request->event_files)->pluck('id')))->delete();
        if (isset($request->event_files) && count($request->event_files) > 0) {
            foreach ($request->event_files as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    uploadImage('event_files', $item['file']);
                    EventFile::query()->create([
                        'title' => $item['title'],
                        'event_id' => $event->id,
                        'file' => $item['file']->hashName()
                    ]);
                } else {
                    $file = EventFile::find($item['id']);
                    if ($item['file'] == $file->file) {
                        $file->update([
                            'title' => $item['title'],
                            'event_id' => $event->id,
                        ]);
                    } else {
                        deletePreviousImage('event_files', $file->file);
                        uploadImage('event_files', $item['file']);
                        $file->update([
                            'file' => $item['file']->hashName(),
                            'title' => $item['title'],
                        ]);
                    }
                }
            }
        }
        GalleryImage::query()->whereIn('id', collect($event->gallery_images)->pluck('id')->diff(collect($request->event_gallery)->pluck('id')))->delete();
        if (isset($request->event_gallery) && count($request->event_gallery) > 0) {
            foreach ($request->event_gallery as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    uploadImage('gallery_images', $item['image']);
                    GalleryImage::query()->create([
                        'image' => $item['image']->hashName(),
                        'event_id' => $event->id
                    ]);
                } else {
                    $gallery_image = GalleryImage::find($item['id']);
                    if ($item['image'] != $gallery_image->image) {
                        deletePreviousImage('gallery_images', $gallery_image->image);
                        uploadImage('gallery_images', $item['image']);
                        $gallery_image->update([
                            'image' => $item['image']->hashName(),
                        ]);
                    }

                }
            }
        }

        QuestionRate::query()->whereIn('id', collect($event->rate_questions)->pluck('id')->diff(collect($request->event_questions)->pluck('id')))->delete();
        if (isset($request->event_questions) && count($request->event_questions) > 0) {
            foreach ($request->event_questions as $question) {
                if ($question['type'] == null || $question['title'] == null) {
                    return redirect()->back()->with('error', 'الرجاء إدخال   الأسئلة بالشكل الصحيح');
                }
                if (isset($question['row_type']) && $question['row_type'] == 'new') {
                    QuestionRate::query()->create([
                        'title' => $question['title'],
                        'type' => $question['type'],
                        'event_id' => $event->id
                    ]);
                } else {
                    $question = QuestionRate::find($question['id']);
                    $question->update([
                        'title' => $question['title'],
                        'type' => $question['type'],
                    ]);
                }
            }
        }


        EventGuest::query()->whereIn('id', collect($event->guest_items)->pluck('id')->diff(collect($request->guest_items)->pluck('id')))->delete();
        if (isset($request->guest_items) && count($request->guest_items) > 0) {
            foreach ($request->guest_items as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    EventGuest::query()->create([
                        'name' => $item['name'],
                        'info' => $item['info'],
                        'event_id' => $event->id,
                        'created_by' => 'Admin',
                        'status' => 1
                    ]);
                } else {
                    $guest = EventGuest::find($item['id']);
                    $guest->update([
                        'name' => $item['name'],
                        'info' => $item['info'],
                    ]);
                }
            }
        }
        if ($event) {
            return redirect('/admin/events')->with('success', 'تم التحديث بنجاح');
        } else {
            return redirect('/admin/events')->with('error', 'حدث خطا ما ');
        }
    }


}
