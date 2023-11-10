<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Multaka;
use App\Models\MultakaGuest;
use App\Models\MultakaSpeakerOrder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MultakaGuestOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        return Inertia::render('views/admin/Multaka/GuestOrder', [
            'guest_orders' => MultakaGuest::with(['multaka:id,title'])
                ->when($request->multaka_id, function ($q) use ($request) {
                    $q->where('multaka_id', $request->multaka_id);
                })
                ->orderBy('status', 'asc')
                ->select('id', 'name', 'info', 'status', 'multaka_id', 'user_id')
                ->get(),
            'multakas' => Multaka::query()->orderByDesc('id')->select('id', 'title')->get(),
            'filters' => $request->only('multaka_id')
        ]);
    }

    public function change_status(Request $request)
    {
        $guest = MultakaGuest::find($request->id);
        if (!$guest || !empty($guest->status) || !in_array($request->status, [1, 2])) {
            return redirect()->back()->with('error', 'حدث خطا ما');

        }
        $status = $guest->update([
            'status' => $request->status
        ]);
        if ($status) {
            return redirect()->back()->with('success', 'تم تحديث الحالة بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }
}
