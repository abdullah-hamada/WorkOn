@if(auth()->user()->email=='abohafez@admin.com')

    <a href="{{'user/change/'.$entry->id  }}" class="btn btn-sm btn-link"> تسجيل
        دخول </a>
@endif

