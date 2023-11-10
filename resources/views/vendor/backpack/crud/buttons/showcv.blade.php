@if ($crud->hasAccess('showcv'))


    @if($entry->hasRole('talent')||$entry->hasRole('employee'))

        <a href="{{ url('dashboard/show_cv?user_uuid='.$entry->uuid) }}" target="_blank" class="btn btn-sm btn-link"><i
                class="la la-eye"></i>
            عرض السيرة الذاتية</a>

    @elseif($entry->hasRole('company'))
        <a href="{{ url('/dashboard/company/information?user_uuid='.$entry->uuid) }}" target="_blank"
           class="btn btn-sm btn-link"><i
                class="la la-eye"></i>
            عرض بيانات الشركة</a>
    @endif

@endif
