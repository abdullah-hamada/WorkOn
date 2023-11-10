<span class="backpack-avatar-menu-container"></span>
<li style="margin-left:-30px" class="nav-item dropdown pr-4">
    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"
       style="position: relative;width: 35px;height: 35px;margin: 0 10px;">
        <img class="img-avatar" src="{{ backpack_avatar_url(backpack_auth()->user()) }}"
             alt="{{ backpack_auth()->user()->name }}" onerror="this.style.display='none'"
             style="margin: 0;position: absolute;left: 0;z-index: 1;">
        <span class="backpack-avatar-menu-container"
              style="position: absolute;left: 0;width: 100%;background-color: #00a65a;border-radius: 50%;color: #FFF;line-height: 35px;font-size: 85%;font-weight: 300;">
      <i class="nav-icon ">{{backpack_user()->notifications()->where('user_id',auth()->user()->id)->whereNull('is_read')->count()}}</i>
    </span>


    </a>

    <div style="width:380px"
         class="dropdown-menu {{ config('backpack.base.html_direction') == 'rtl' ? 'dropdown-menu-left' : 'dropdown-menu-right' }}
             mr-4 pb-1 pt-1">
        @foreach(backpack_user()->notifications()
    ->where('user_id',auth()->user()->id)->whereNull('is_read')->latest()->limit(5)->orderBy('id','desc')->get()
                as $notify)

            <a target="_blank" class="dropdown-item" href="{{route('make_notification_as_read',$notify)}}"><i
                    class="la la-list"></i>
                {{__($notify->text)}} <span style="float:left;">{{$notify->created_at->diffForHumans()}}</span> </a>

        @endforeach
        <a style="text-align: center" class="dropdown-item" href="{{ route('show_notification',auth()->user()->id) }}">
            <i class="la la-bell"></i>
            Show More </a>
    </div>
</li>
