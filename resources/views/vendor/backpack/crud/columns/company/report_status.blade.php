@if($entry->report_status==0)
    لم يسلم
@elseif($entry->report_status==1)
    غير مقروء
@elseif($entry->report_status==2)
    مقروء
@endif
