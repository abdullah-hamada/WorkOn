@if(!empty($entry->kafu_profile))
    <a target="_blank" href="{{asset('assets/images/home_page_images/' . $entry->kafu_profile) }}"
       class="btn btn-xs btn-link"><i class="la la-eye"></i>انقر</a>
@else
    -----
@endif


