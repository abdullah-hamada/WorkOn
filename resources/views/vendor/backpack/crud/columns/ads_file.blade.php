@if(!empty($entry->file ))
    <a target="_blank"
       href="{{('/get_file/'.$entry->company_id .'/ads_files/' .$entry->file) }}"


       class="btn btn-xs btn-link"><i class="la la-eye"></i>انقر</a>
@else
    ----

@endif

