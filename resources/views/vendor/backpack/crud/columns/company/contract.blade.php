@if($entry->company_contract !=null)
    <a
        href="{{('/get_file/'.$entry->company_id .'/company_contract/' .$entry->company_contract) }}"

        target="_blank"
        class="btn btn-sm btn-link"><i
            class="la la-eye"></i>
    </a>
@else
    ------
@endif
