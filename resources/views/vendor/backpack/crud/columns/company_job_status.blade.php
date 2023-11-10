@if($entry->status == 0)
    <span style="color:red">بانتظار القبول</span>
@elseif($entry->status == 1)
    <span style="color:green">  مقبول</span>

    @else
    <span style="color:black">   مرفوض</span>

@endif
