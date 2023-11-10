<?php

namespace App\Http\Controllers\Share;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserSubcribeNewsRequest;
use App\Models\Course;
use App\Models\CourseAgenda;
use App\Models\Event;
use App\Models\Notification;
use App\Models\UserSubscribe;
use App\Models\UserSubscribeNew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;
use ZipArchive;

class ShareController extends Controller
{
    public function get_file($folder, $file)
    {

        $path = storage_path('app/public/' . $folder) . '/' . $file;
        if (file_exists($path)) {
            return Response::download($path);
        }

    }

    public function download_event_files($id)
    {
        $event = Event::find($id);
        if ($event && $event->event_files) {

            $files = $event->event_files;
            $zip = new ZipArchive();
            $fileName = 'EventFiles.zip';

            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
                foreach ($files as $file) {
                    $path = storage_path('app/public/event_files') . '/' . $file->file;
                    $relativeName = basename($path);
                    $zip->addFile($path, $relativeName);
                }
                $zip->close();
            }

            return response()->download(public_path($fileName));


//           foreach ($event->event_files as $event_file){
//               $path = storage_path('app/public/event_files')  . '/' . $event_file->file;
//               if (file_exists($path)) {
//                   return Response::download($path);
//               }
//           }

        }
    }

    public function search_events(Request $request)
    {
        $events = Event::with('category')->orderByDesc('id');
        if (isset($request->sort)) {
            $events = $events->orderby('id', $request->sort);
        }
        if (isset($request->title)) {
            $events = $events->where('title', 'like', '%' . $request->title . '%');
        }

        return \response()->json($events->get());


    }

    public function notifications()
    {
        Notification::query()->whereUserId(auth()->user()->id)->update([
            'is_read' => 1
        ]);
        $data = auth()->user()->notifications()->orderBy('id', 'desc')->limit(20)->get();
        return Inertia::render('views/Auth/Notification', [
            'all_notification' => $data
        ]);
    }

    public function make_notification_as_read()
    {
        $nofiy = Notification::query()->whereId(\request()->notify_id)->first();
        $nofiy->update([
            'is_read' => 1
        ]);
        return response()->json(true);
    }

    public function get_courses()
    {
        return response()->json(auth()->check() && auth()->user()->hasRole('admin')
            ? Course::orderByDesc('id')->withCount('subscriber_users')->paginate(12)->withQueryString()
            : Course::orderByDesc('id')->whereActive()->withCount('subscriber_users')->paginate(12)->withQueryString()
        );

    }

    public function show_course($id)
    {
        session([
            'redirect_url' => url()->current()
        ]);
        $course = Course::with(['trainer:id,name,job_title,description,image', 'articles:id,title,paragraph,image,course_id',
            'course_sections:id,title,paragraph,course_id',
            'reasons_for_participating_in_course:id,title,image,course_id',
            'users_benefit_course:id,title,image,course_id',
            'course_questions:id,question,answer,course_id',
            'course_opinion_participants:id,video_url,image,course_id',
            'course_slider_images:id,title,image,course_id'
        ])->where('id', $id)->first();

        if (!$course) {
            abort(404);
        }
        $data = [
            'course' => $course,
            'timezone' => getTimeZone(),
            'user_auth_subscribe_course' => auth()->check() ? UserSubscribe::query()->where('course_id', $id)->where('user_id', auth()->user()->id)->count() > 0 : false
        ];
        return Inertia::render('views/share_component/Courses/Show', $data);
    }

    public function subscribe_user_in_news(UserSubcribeNewsRequest $request)
    {

        $status = UserSubscribeNew::query()->create([
            'email' => $request->user_email
        ]);
        if (!$status) {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
        return redirect()->back()->with('success', 'تم الإشتراك بالنشرة البريدية بنجاح');

    }
}
