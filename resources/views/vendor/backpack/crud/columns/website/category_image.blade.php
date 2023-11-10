@if(!empty($entry->image))
    <a target="_blank" href="{{asset('assets/images/website_category_image/' . $entry->image) }}"
       class="btn btn-xs btn-link"><i class="la la-eye"></i>انقر</a>
@else
    -----
@endif


