<?php

namespace App\Exports\user;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UserExcelExport implements FromView, WithColumnWidths, WithEvents
{


    public function view(): View
    {
         return view('exports.users.info', [
            'users' => User::with(['roles','country:id,name_ar','category:id,name_ar','courses:id,title'])->withCount('courses')->orderBy('id', 'desc')
                ->get()
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 40,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
                $event->sheet->getDelegate()->freezePane('A3', 'A3');
                $event->sheet->autoSize();
            },
        ];
    }
}
