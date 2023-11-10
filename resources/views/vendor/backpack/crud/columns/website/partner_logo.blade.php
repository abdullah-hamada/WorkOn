@if(!empty($entry->logo))
    <a target="_blank" href="{{asset('assets/images/partners_logo/' . $entry->logo) }}"
       class="btn btn-xs btn-link"><i class="la la-eye"></i>انقر</a>
@else
    -----
@endif


