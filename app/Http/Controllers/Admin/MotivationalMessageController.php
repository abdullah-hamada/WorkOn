<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MotivationalMessageRequest;
use App\Models\MotivationalMessage;
use Inertia\Inertia;

class MotivationalMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return Inertia::render('views/admin/MotivationalMessage/Index', [
            'messages' => MotivationalMessage::orderBy('id', 'desc')->get()
        ]);
    }

    public function store(MotivationalMessageRequest $request)
    {
        $status = MotivationalMessage::create([
            'title' => $request->title
        ]);
        if ($status) {
            return redirect('/admin/motivational_message')->with('success', 'تم الحفظ بنجاح');
        }
    }

    public function create()
    {
        return Inertia::render('views/admin/MotivationalMessage/Create');
    }

    public function edit($id)
    {
        $message = MotivationalMessage::where('id', $id)->first();
        return Inertia::render('views/admin/MotivationalMessage/Edit', [
            'message' => $message,

        ]);
    }


    public function update(MotivationalMessageRequest $request, $id)
    {

        $message = MotivationalMessage::find($id);
        $status = $message->update([
            'title' => $request->title

        ]);
        if ($status) {
            return redirect('/admin/motivational_message')->with('success', 'تم التحديث بنجاح');
        }
    }

    public function destroy($id)
    {
        $message = MotivationalMessage::find($id);
        $status = $message->delete();
        if ($status) {
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        }
    }

}
