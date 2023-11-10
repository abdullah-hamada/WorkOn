@if($entry->status==0)
 بانتظار القبول
@elseif($entry->status==1)
    مقبول
@elseif($entry->status==2)
    مرفوض
@endif
