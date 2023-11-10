@if(!empty($entry->commercial_register) &&$entry->commercial_register_status ==0 )
    <a href="{{'accept_commercial_register_status/'.$entry->getKey() }}" class="btn btn-sm btn-link"><i
            class="la la-eye"></i> قبول السجل التجاري</a>


@endif
