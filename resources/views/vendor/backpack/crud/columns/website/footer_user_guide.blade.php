@if(!empty($entry->footer_user_guide))
    <a target="_blank" href="{{asset('assets/images/home_page_images/' . $entry->footer_user_guide) }}"
       class="btn btn-xs btn-link"><i class="la la-eye"></i>انقر</a>
@else
    -----
@endif


