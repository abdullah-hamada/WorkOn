<?php

namespace App\Exports\course;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class CourseSubscriberExcelExport implements FromView, WithColumnWidths, WithEvents
{

    public $users;
    public $course_title;

    public function __construct($course_title , $users)
    {
        $this->users = $users;
        $this->course_title = $course_title;

    }

    public function view(): View
    {
        return view('exports.courses.subscriber_info', [
            'users' => $this->users,
            'course_title' => $this->course_title
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
