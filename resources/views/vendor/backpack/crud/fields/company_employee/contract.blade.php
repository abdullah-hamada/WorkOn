
@if($entry->company_contract !=null)
    <div>
        <label style="    margin-right: 23px">عقد الشركة</label>
        <a
            href="{{('/get_file/'.$entry->company_id .'/company_contract/' .$entry->company_contract) }}"

            target="_blank"
            class="btn btn-sm btn-link"><i
                class="la la-eye"></i>
        </a>
    </div>
@else

    <label style="    margin-right: 23px">عقد الشركة</label>

    <div style="color: red; margin-right: 3px"> بانتظار الرفع</div>
@endif
<br><br>
@if($entry->employee_approve_contract !=null)
    <div>
        <label style="    margin-right: 23px">عقد الموافقة من الموظف</label>
        <a
            href="{{('/get_file/'.$entry->employee_id .'/employee_approve_contract/' .$entry->employee_approve_contract) }}"

            target="_blank"
            class="btn btn-sm btn-link"><i
                class="la la-eye"></i>
        </a>
    </div>
@else
    <label style="    margin-right: 23px">عقد الموافقة من الموظف</label>

    <div style="color: red; margin-right: 3px"> بانتظار الرفع</div>

@endif

