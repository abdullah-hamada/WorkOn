@if($entry->recommendation_file !=null)

<a target="_blank"
    href="{{('/get_file/'.$entry->company_id .'/employee_recommendation_files/' .$entry->recommendation_file) }}"

   class="btn btn-xs btn-link">
    انقر</a>

@else
لم يتم الرفع
@endif


