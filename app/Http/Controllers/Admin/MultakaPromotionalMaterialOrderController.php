<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Multaka;
use App\Models\MultakaPromotionalMaterialOrder;
use App\Models\MultakaSpeakerOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MultakaPromotionalMaterialOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $promotional_material_order = MultakaPromotionalMaterialOrder::with(['multaka:id,title'])
            ->orderBy('status', 'asc')
            ->select('id', 'type', 'file', 'status', 'user_id', 'multaka_id')
            ->get();
        return Inertia::render('views/admin/Multaka/PromotionalMaterialOrder', [
            'promotional_material_order' => $promotional_material_order,
            'multakas' => Multaka::where('date_from', '>=', Carbon::now()->format('Y-m-d'))->select('id', 'title', 'date_from')->get(),
            'filters' => $request->only('multaka_id')
        ]);
    }


    public function change_status(Request $request)
    {
        $order = MultakaPromotionalMaterialOrder::find($request->id);
        if (!$order) {
            abort(404);
        }

        if (!$order || !empty($order->status) || !in_array($request->status, [1, 2])) {
            return redirect()->back()->with('error', 'حدث خطا ما');

        }
        $status = $order->update([
            'status' => $request->status
        ]);
        if ($status) {
            return redirect()->back()->with('success', 'تم تحديث الحالة بنجاح');
        }
    }


}
