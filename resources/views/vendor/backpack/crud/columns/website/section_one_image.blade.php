@if(!empty($entry->section_one_image))
    <a target="_blank" href="{{asset('assets/images/home_page_images/' . $entry->section_one_image) }}"
       class="btn btn-xs btn-link"><i class="la la-eye"></i>انقر</a>
@else
    -----
@endif


