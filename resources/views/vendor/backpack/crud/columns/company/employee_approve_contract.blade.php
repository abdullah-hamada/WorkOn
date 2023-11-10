@if($entry->employee_approve_contract !=null)
    <a
        href="{{('/get_file/'.$entry->employee_id .'/employee_approve_contract/' .$entry->employee_approve_contract) }}"

        target="_blank"
        class="btn btn-sm btn-link"><i
            class="la la-eye"></i>
    </a>
@else
    -
@endif
