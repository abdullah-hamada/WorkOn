@if ($crud->hasAccess('comment'))
    @if (!$crud->model->translationEnabled())

        <!-- Single edit button -->
        <a href="{{ url($crud->route.'/'.$entry->getKey().'/comment') }}" class="btn btn-sm btn-link"><i
                class="la la-edit"></i> {{ trans('backpack::crud.edit') }}</a>

    @else

        <!-- Edit button group -->
        <div class="btn-group">
            <a href="{{ url($crud->route.'/'.$entry->getKey().'/comment') }}" class="btn btn-sm btn-link pr-0"><i
                    class="la la-edit"></i> {{ trans('backpack::crud.edit') }}</a>
            <a class="btn btn-sm btn-link dropdown-toggle text-primary pl-1" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                <span class="caret"></span>
            </a>
        </div>

    @endif
@endif
