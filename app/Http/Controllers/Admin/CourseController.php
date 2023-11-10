<?php

namespace App\Http\Controllers\Admin;

use App\Exports\course\CourseSubscriberExcelExport;
use App\Exports\user\CourseExcelExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseAgenda;
use App\Models\CourseArticle;
use App\Models\CourseBenefitType;
use App\Models\CourseOpinion;
use App\Models\CourseParticipatingReason;
use App\Models\CourseQuestion;
use App\Models\CourseSection;
use App\Models\CourseSlider;
use App\Models\CourseType;
use App\Models\Service;
use App\Models\Trainer;
use App\Models\TrainerLabel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $courses = Course::with('service:id,name');
        if (isset($request->title)) {
            $courses = $courses->where('title', 'like', '%' . $request->title . '%');
        }
        if (isset($request->sort)) {
            $courses = $courses->orderBy('date_from', $request->sort ?? 'desc');
        } else {
            $courses = $courses->orderByDesc('id');
        }

        return Inertia::render('views/admin/Courses/Index', [
            'courses' => $courses->select('id', 'title', 'date_from', 'date_to', 'price_before_discount', 'price_after_discount', 'price_type', 'status', 'service_id')->get(),
            'filters' => $request->only(['title', 'sort']),
            'timezone' => getTimeZone()

        ]);
    }

    public function store(CourseRequest $request)
    {
//        $response = $this->validate_course($request);
//        if (isset($response['status']) && $response['status'] == 'error') {
//            return redirect()->back()->with($response['status'], $response['message']);
//        }
        $data = [
            'title' => $request->title,
            'brief_explanation' => $request->brief_explanation,
            'lectures_link' => $request->lectures_link,
            'date_from' => Carbon::parse($request->date_from),
            'date_to' => Carbon::parse($request->date_to),
            'price_type' => $request->price_type,
            'trainer_id' => $request->trainer_id,
            'service_id' => $request->service_id,
            'status' => 1,
        ];

        if ($request->price_type == 2) {
            $data['price_before_discount'] = NULL;
            $data['price_after_discount'] = NULL;

        } else {
            $data['price_before_discount'] = $request->price_before_discount;
            $data['price_after_discount'] = $request->price_after_discount;
        }

        if (isset($request->image) && !empty($request->image) && $request->image != null) {
            $data['image'] = $request->image->hashName();
            uploadImage('course_logos', $request->image);
        } else {
            $data['image'] = 'logo.jpg';
        }


        if (isset($request->course_promotional_video['image']) && !empty($request->course_promotional_video['image']) && $request->course_promotional_video['image'] != null) {
            $data['promotional_video_image'] = $request->course_promotional_video['image']->hashName();
            uploadImage('course_promotional_video_images', $request->course_promotional_video['image']);
        } else {
            $data['promotional_video_image'] = 'logo.jpg';
        }

        if (isset($request->course_promotional_video['promotional_video_title']) && !empty($request->course_promotional_video['promotional_video_title'])
            && $request->course_promotional_video['promotional_video_title'] != null) {
            $data['promotional_video_title'] = $request->course_promotional_video['title'];

        }
        if (isset($request->course_promotional_video['video_url']) && !empty($request->course_promotional_video['video_url'])
            && $request->course_promotional_video['video_url'] != null) {
            $data['promotional_video_url'] = $request->course_promotional_video['video_url'];

        }

        $course = Course::create($data);
        if (isset($request->articles) && count($request->articles) > 0) {
            foreach ($request->articles as $item) {
                $data = [
                    'paragraph' => $item['paragraph'],
                    'title' => $item['title'],
                    'course_id' => $course->id
                ];
                if (isset($request->image) && !empty($request->image) && $request->image != null) {
                    $data['image'] = $item['image']->hashName();
                    uploadImage('course_articles', $item['image']);
                } else {
                    $data['image'] = 'logo.jpg';
                }
                CourseArticle::query()->create($data);
            }
        }
        if (isset($request->reasons_for_participating_in_course) && count($request->reasons_for_participating_in_course) > 0) {
            foreach ($request->reasons_for_participating_in_course as $item) {
                $data = [
                    'title' => $item['title'],
                    'course_id' => $course->id
                ];
                if (isset($request->image) && !empty($request->image) && $request->image != null) {
                    $data['image'] = $item['image']->hashName();
                    uploadImage('course_participating_reason_images', $item['image']);
                } else {
                    $data['image'] = 'logo.jpg';
                }
                CourseParticipatingReason::query()->create($data);
            }
        }
        if (isset($request->course_sections) && count($request->course_sections) > 0) {
            foreach ($request->course_sections as $item) {
                CourseSection::query()->create([
                    'title' => $item['title'],
                    'paragraph' => $item['paragraph'],
                    'course_id' => $course->id,
                ]);
            }
        }
        if (isset($request->users_benefit_course) && count($request->users_benefit_course) > 0) {
            foreach ($request->users_benefit_course as $item) {
                $data = [
                    'title' => $item['title'],
                    'course_id' => $course->id
                ];
                if (isset($request->image) && !empty($request->image) && $request->image != null) {
                    $data['image'] = $item['image']->hashName();
                    uploadImage('course_benefit_type_images', $item['image']);
                } else {
                    $data['image'] = 'logo.jpg';
                }
                CourseBenefitType::query()->create($data);
            }
        }
        if (isset($request->course_questions) && count($request->course_questions) > 0) {
            foreach ($request->course_questions as $item) {
                CourseQuestion::query()->create([
                    'question' => $item['question'],
                    'answer' => $item['answer'],
                    'course_id' => $course->id,
                ]);
            }
        }
        if (isset($request->course_opinion_participants) && count($request->course_opinion_participants) > 0) {
            foreach ($request->course_opinion_participants as $item) {
                $data = [
                    'video_url' => $item['video_url'],
                    'course_id' => $course->id
                ];
                if (isset($request->image) && !empty($request->image) && $request->image != null) {
                    $data['image'] = $item['image']->hashName();
                    uploadImage('course_opinion_participants_video_images', $item['image']);
                } else {
                    $data['image'] = 'logo.jpg';
                }
                CourseOpinion::query()->create($data);
            }
        }
        if (isset($request->course_slider_images) && count($request->course_slider_images) > 0) {
            foreach ($request->course_slider_images as $item) {
                $data = [
                    'title' => $item['title'],
                    'course_id' => $course->id
                ];
                if (isset($request->image) && !empty($request->image) && $request->image != null) {
                    $data['image'] = $item['image']->hashName();
                    uploadImage('course_slider_images', $item['image']);
                } else {
                    $data['image'] = 'logo.jpg';
                }
                CourseSlider::query()->create($data);
            }
        }
        if ($course) {
//            $this->dispatch(new CreateMultakaNotification($multaka->id));
            return redirect('/admin/courses')->with('success', 'تم الحفظ بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا  ما');
        }
    }

    public function create()
    {
        return Inertia::render('views/admin/Courses/Create', [
            'categories' => Category::all(),
            'trainers' => Trainer::query()->select('id', 'name')->orderByDesc('id')->whereActive()->get(),
            'services' => Service::query()->select('id', 'name')->orderByDesc('id')->whereActive()->get()
        ]);
    }

    public function show($id)
    {
        $course = Course::with(['subscriber_users' => function ($q) {
            $q->with('country:id,name_ar', 'category:id,name_ar')->select('name', 'email', 'whatsapp_number', 'country_id', 'category_id', 'user_id');
        }, 'trainer:id,name', 'service:id,name'])
            ->withCount('subscriber_users')
            ->where('id', $id)
            ->first();


        if (!$course) {
            abort(404);
        }
        return Inertia::render('views/admin/Courses/ShowInfo', [
            'course' => $course,
            'timezone' => getTimeZone()

        ]);
    }

    public function edit($id)
    {
        $course = Course::with(['articles:id,title,paragraph,image,course_id', 'course_sections:id,title,paragraph,course_id',
            'reasons_for_participating_in_course:id,title,image,course_id',
            'users_benefit_course:id,title,image,course_id',
            'course_questions:id,question,answer,course_id', 'course_opinion_participants:id,video_url,image,course_id',
            'course_slider_images:id,title,image,course_id'
        ])->where('id', $id)->first();
        if (!$course) {
            abort(404);
        }
        $course->price_type = intval($course->price_type);
        $course->service_id = intval($course->service_id);
        $course->trainer_id = intval($course->trainer_id);

        $course->date_from = Carbon::parse($course->date_from)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');
        $course->date_to = Carbon::parse($course->date_to)->setTimezone(getTimeZone())->format('Y-m-d H:i:s');

        return Inertia::render('views/admin/Courses/Edit', [
            'course' => $course,
            'trainers' => Trainer::query()->select('id', 'name')->orderByDesc('id')->whereActive()->get(),
            'services' => Service::query()->select('id', 'name')->orderByDesc('id')->whereActive()->get()
        ]);
    }

    public function change_status($id)
    {
        $course = Course::find($id);
        if (!$course) {
            abort(404);
        }
        $status = $course->update([
            'status' => $course->status == 0 ? 1 : 0
        ]);
        if ($status) {
            return redirect()->back()->with('success', 'تم تحديث الحالة بنجاح');
        }
    }

//    public function destroy($id)
//    {
//        $course = Course::find($id);
//        if (!$course) {
//            abort(404);
//        }
//        if (count($course->subscriber_users) > 0) {
//            return redirect()->back()->with('error', '   لا يمكن الحذف لوجود مشتركين  ');
//        }
//        $status = $course->delete();
//        if ($status) {
//            return redirect()->back()->with('success', 'تم الحذف بنجاح');
//        }
//    }

    public function update(CourseRequest $request, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            abort(404);
        }
//        if (count($course->subscriber_users) > 0) {
//            return redirect()->back()->with('error', '   لا يمكن التحديث لوجود مشتركين  ');
//        }
//        $response = $this->validate_course($request);
//        if (isset($response['status']) && $response['status'] == 'error') {
//            return redirect()->back()->with($response['status'], $response['message']);
//        }

        $data = [
            'title' => $request->title,
            'brief_explanation' => $request->brief_explanation,
            'lectures_link' => $request->lectures_link,
            'date_from' => Carbon::parse($request->date_from),
            'date_to' => Carbon::parse($request->date_to),
            'price_type' => $request->price_type,
            'trainer_id' => $request->trainer_id,
            'service_id' => $request->service_id,

        ];

        if ($request->price_type == 2) {
            $data['price_before_discount'] = NULL;
            $data['price_after_discount'] = NULL;
        } else {
            $data['price_before_discount'] = $request->price_before_discount;
            $data['price_after_discount'] = $request->price_after_discount;
        }

        if (isset($request->image) && !empty($request->image) && $request->image != null) {
            $data['image'] = $request->image->hashName();
            deletePreviousImage('course_logos', $course->image);
            uploadImage('course_logos', $request->image);
        } else {
            $data['image'] = $course->image;
        }

        if (isset($request->course_promotional_video['image']) && !empty($request->course_promotional_video['image']) && $request->course_promotional_video['image'] != null) {
            $data['promotional_video_image'] = $request->course_promotional_video['image']->hashName();
            deletePreviousImage('course_promotional_video_images', $course->promotional_video_image);
            uploadImage('course_promotional_video_images', $request->course_promotional_video['image']);
        }


        if (isset($request->course_promotional_video['promotional_video_title']) && !empty($request->course_promotional_video['promotional_video_title'])
            && $request->course_promotional_video['promotional_video_title'] != null) {
            $data['promotional_video_title'] = $request->course_promotional_video['title'];

        }
        if (isset($request->course_promotional_video['video_url']) && !empty($request->course_promotional_video['video_url'])
            && $request->course_promotional_video['video_url'] != null) {
            $data['promotional_video_url'] = $request->course_promotional_video['video_url'];

        }


        $course->update($data);
        CourseArticle::query()->whereIn('id', collect($course->articles)->pluck('id')->diff(collect($request->articles)->pluck('id')))->delete();
        if (isset($request->articles) && count($request->articles) > 0) {
            foreach ($request->articles as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    uploadImage('course_articles', $item['image']);
                    CourseArticle::query()->create([
                        'paragraph' => $item['paragraph'],
                        'title' => $item['title'],
                        'image' => $item['image']->hashName(),
                        'course_id' => $course->id
                    ]);
                } else {

                    $article = CourseArticle::find($item['id']);
                    if ($item['image'] == $article->image) {
                        $article->update([
                            'paragraph' => $item['paragraph'],
                            'title' => $item['title'],
                        ]);
                    } else {
                        deletePreviousImage('course_articles', $article->image);
                        uploadImage('course_articles', $item['image']);
                        $article->update([
                            'paragraph' => $item['paragraph'],
                            'title' => $item['title'],
                            'image' => $item['image']->hashName(),
                        ]);
                    }
                }
            }
        }

        CourseParticipatingReason::query()->whereIn('id', collect($course->reasons_for_participating_in_course)->pluck('id')->diff(collect($request->reasons_for_participating_in_course)->pluck('id')))->delete();
        if (isset($request->reasons_for_participating_in_course) && count($request->reasons_for_participating_in_course) > 0) {
            foreach ($request->reasons_for_participating_in_course as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    uploadImage('course_participating_reason_images', $item['image']);
                    CourseParticipatingReason::query()->create([
                        'title' => $item['title'],
                        'image' => $item['image']->hashName(),
                        'course_id' => $course->id

                    ]);
                } else {
                    $reason = CourseParticipatingReason::find($item['id']);
                    if ($item['image'] == $reason->image) {
                        $reason->update([
                            'title' => $item['title'],
                        ]);
                    } else {
                        deletePreviousImage('course_participating_reason_images', $reason->image);
                        uploadImage('course_participating_reason_images', $item['image']);
                        $reason->update([
                            'title' => $item['title'],
                            'image' => $item['image']->hashName(),
                        ]);
                    }
                }
            }
        }

        CourseSection::query()->whereIn('id', collect($course->course_sections)->pluck('id')->diff(collect($request->course_sections)->pluck('id')))->delete();
        if (isset($request->course_sections) && count($request->course_sections) > 0) {
            foreach ($request->course_sections as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    CourseSection::query()->create([
                        'title' => $item['title'],
                        'paragraph' => $item['paragraph'],
                        'course_id' => $course->id

                    ]);
                } else {
                    $section = CourseSection::find($item['id']);
                    $section->update([
                        'title' => $item['title'],
                        'paragraph' => $item['paragraph'],
                    ]);
                }

            }
        }


        CourseBenefitType::query()->whereIn('id', collect($course->users_benefit_course)->pluck('id')->diff(collect($request->users_benefit_course)->pluck('id')))->delete();
        if (isset($request->users_benefit_course) && count($request->users_benefit_course) > 0) {
            foreach ($request->users_benefit_course as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    uploadImage('course_benefit_type_images', $item['image']);
                    CourseBenefitType::query()->create([
                        'title' => $item['title'],
                        'image' => $item['image']->hashName(),
                        'course_id' => $course->id

                    ]);
                } else {
                    $benefit = CourseBenefitType::find($item['id']);
                    if ($item['image'] == $benefit->image) {
                        $benefit->update([
                            'title' => $item['title'],
                        ]);
                    } else {
                        deletePreviousImage('course_benefit_type_images', $benefit->image);
                        uploadImage('course_benefit_type_images', $item['image']);
                        $benefit->update([
                            'title' => $item['title'],
                            'image' => $item['image']->hashName(),
                        ]);
                    }
                }
            }
        }


        CourseQuestion::query()->whereIn('id', collect($course->course_questions)->pluck('id')->diff(collect($request->course_questions)->pluck('id')))->delete();
        if (isset($request->course_questions) && count($request->course_questions) > 0) {
            foreach ($request->course_questions as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    CourseQuestion::query()->create([
                        'question' => $item['question'],
                        'answer' => $item['answer'],
                        'course_id' => $course->id

                    ]);
                } else {
                    $question = CourseQuestion::find($item['id']);
                    $question->update([
                        'question' => $item['question'],
                        'answer' => $item['answer'],
                    ]);
                }

            }
        }

        CourseOpinion::query()->whereIn('id', collect($course->course_opinion_participants)->pluck('id')->diff(collect($request->course_opinion_participants)->pluck('id')))->delete();
        if (isset($request->course_opinion_participants) && count($request->course_opinion_participants) > 0) {
            foreach ($request->course_opinion_participants as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    uploadImage('course_opinion_participants_video_images', $item['image']);
                    CourseOpinion::query()->create([
                        'video_url' => $item['video_url'],
                        'image' => $item['image']->hashName(),
                        'course_id' => $course->id

                    ]);
                } else {
                    $opinion = CourseOpinion::find($item['id']);
                    if ($item['image'] == $opinion->image) {
                        $opinion->update([
                            'video_url' => $item['video_url'],
                        ]);
                    } else {
                        deletePreviousImage('course_opinion_participants_video_images', $opinion->image);
                        uploadImage('course_opinion_participants_video_images', $item['image']);
                        $opinion->update([
                            'video_url' => $item['video_url'],
                            'image' => $item['image']->hashName(),
                        ]);
                    }
                }
            }
        }

        CourseSlider::query()->whereIn('id', collect($course->course_slider_images)->pluck('id')->diff(collect($request->course_slider_images)->pluck('id')))->delete();
        if (isset($request->course_slider_images) && count($request->course_slider_images) > 0) {
            foreach ($request->course_slider_images as $item) {
                if (isset($item['type']) && $item['type'] == 'new') {
                    uploadImage('course_slider_images', $item['image']);
                    CourseSlider::query()->create([
                        'title' => $item['title'],
                        'image' => $item['image']->hashName(),
                        'course_id' => $course->id

                    ]);
                } else {
                    $slider = CourseSlider::find($item['id']);
                    if ($item['image'] == $slider->image) {
                        $slider->update([
                            'title' => $item['title'],
                        ]);
                    } else {
                        if ($slider->image != null) {
                            deletePreviousImage('course_slider_images', $slider->image);
                        }
                        uploadImage('course_slider_images', $item['image']);
                        $slider->update([
                            'title' => $item['title'],
                            'image' => $item['image']->hashName(),
                        ]);
                    }
                }
            }
        }
        if ($course) {
            return redirect('/admin/courses')->with('success', 'تم التحديث بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا  ما');
        }
    }

    public function export_course_subscriber_info($id)
    {
        $course = Course::find($id);
        if (!$course) {
            abort(404);
        }
        return Excel::download(new CourseSubscriberExcelExport($course->title, $course->subscriber_users), $course->title . '.xlsx');

    }

    public function validate_course($request)
    {

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
    }

}
