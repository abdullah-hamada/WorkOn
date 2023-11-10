@if ($crud->hasAccess('showcvjob'))

    <a href="{{ url('/dashboard/show_job_information/'.$entry->uuid) }}" target="_blank"
       class="btn btn-sm btn-link"><i class="la la-eye"></i>
        عرض تفاصيل الوظيفة</a>

@endif
