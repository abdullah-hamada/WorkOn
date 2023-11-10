@if($entry->report_file)
    <a target="_blank"
       href="{{('/get_file/'.$entry->employee_id .'/report_files/' .$entry->report_file) }}"
       class="btn btn-xs btn-link">
        انقر</a>
@else
    -------
@endif


