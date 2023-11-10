<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\MultakaPromotionalOrderRequest;
use App\Models\Multaka;
use App\Models\MultakaPromotionalMaterialOrder;
use App\Models\MultakaSpeakerOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MultakaPromotionalOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:user');
    }

    public function index(Request $request)
    {
        $promotional_material_order = MultakaPromotionalMaterialOrder::with(['multaka:id,title'])
            ->where('user_id', auth()->user()->id)
            ->orderBy('status', 'asc')
            ->select('id', 'type', 'file', 'status', 'user_id', 'multaka_id')
            ->get();
        return Inertia::render('views/user/Multaka/PromotionalMaterialOrder', [
            'promotional_material_order' => $promotional_material_order,
            'multakas' => Multaka::where('date_from', '>=', Carbon::now()->format('Y-m-d'))->select('id', 'title', 'date_from')->get(),

        ]);
    }

    public function save_promotional_material_order(MultakaPromotionalOrderRequest $request)
    {
        $multaka = Multaka::find($request->multaka_id);
        if (!$multaka) {
            abort(404);
        }
        if ($multaka->is_finish_apply) {
            return redirect()->back()->with('error', '  تم انتهاء وقت الاشتراك');
        }
        $order = MultakaPromotionalMaterialOrder::query()->where('user_id', auth()->user()->id)
            ->where('multaka_id', $multaka->id)->first();
        if ($order) {
            return redirect()->back()->with('error', 'تم اضافة طلب من قبل');
        }
        $data = [
            'type' => $request->type,
            'multaka_id' => $request->multaka_id,
            'user_id' => auth()->user()->id
        ];

        if (isset($request->file)) {
            uploadImage('multaka_promotional_material_files', $request->file);
            $data['file'] = $request->file->hashName();
        }
        $status = MultakaPromotionalMaterialOrder::query()->create($data);

        if ($status) {
            return redirect()->back()->with('success', 'تم اضافة الطلب بنجاح  ');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }
}
