<?php

namespace App\Http\Controllers\Admin;

use App\Exports\job\JobUserApplyReportExcelExport;
use App\Exports\PrizeRegisterExport;
use App\Http\Controllers\Controller;
use App\Models\PrizeRegister;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class PrizeRegistersController extends Controller
{
    public function index()
    {
        return Inertia::render('views/admin/Prize/Registers', [
            'registers' => PrizeRegister::query()->with('user:id,name,email,whatsapp_number')->select('id', 'user_id', 'created_at')->get()
        ]);
    }

    public function show($id)
    {
        $data = PrizeRegister::query()->with('user:id,name,email,whatsapp_number')->where('id', $id)->first();
        if (!$data) {
            abort(404);
        }
        return Inertia::render('views/admin/Prize/ShowApplicantInfo', [
            'data' => $data
        ]);
    }

    public function export()
    {
        return Excel::download(new PrizeRegisterExport(), 'prize_register_export.xlsx');

    }


}
