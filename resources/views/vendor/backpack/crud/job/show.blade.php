@extends(backpack_view('blank'))

@php
    $defaultBreadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      $crud->entity_name_plural => url($crud->route),
      trans('backpack::crud.preview') => false,
    ];

    // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
    <section class="container-fluid d-print-none">
        <a href="javascript: window.print();" class="btn float-right"><i class="la la-print"></i></a>
        <h2>
            <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
            <small>{!! $crud->getSubheading() ?? mb_ucfirst(trans('backpack::crud.preview')).' '.$crud->entity_name !!}
                .</small>
            @if ($crud->hasAccess('list'))
                <small class=""><a href="{{ url($crud->route) }}" class="font-sm"><i
                            class="la la-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }}
                        <span>{{ $crud->entity_name_plural }}</span></a></small>
            @endif
        </h2>
    </section>
@endsection

@section('content')

    <div class="row">
        <div class="{{ $crud->getShowContentClass() }}">

            <!-- Default box -->
            <div class="">
                @if ($crud->model->translationEnabled())
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <!-- Change translation button group -->
                            <div class="btn-group float-right">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{trans('backpack::crud.language')}}
                                    : {{ $crud->model->getAvailableLocales()[request()->input('_locale')?request()->input('_locale'):App::getLocale()] }}
                                    &nbsp; <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($crud->model->getAvailableLocales() as $key => $locale)
                                        <a class="dropdown-item"
                                           href="{{ url($crud->route.'/'.$entry->getKey().'/show') }}?_locale={{ $key }}">{{ $locale }}</a>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card no-padding no-border">
                    <table class="table table-striped mb-0">
                        <tbody>
                        @foreach ($crud->columns() as $column)
                            <tr>
                                <td>
                                    <strong>{!! $column['label'] !!}:</strong>
                                </td>
                                <td>
                                    @php
                                        // create a list of paths to column blade views
                                        // including the configured view_namespaces
                                        $columnPaths = array_map(function($item) use ($column) {

                                            return $item.'.'.$column['type'];
                                        }, config('backpack.crud.view_namespaces.columns'));

                                        // but always fall back to the stock 'text' column
                                        // if a view doesn't exist
                                        if (!in_array('crud::columns.text', $columnPaths)) {
                                            $columnPaths[] = 'crud::columns.text';
                                        }
                                    @endphp
                                    @includeFirst($columnPaths)
                                </td>
                            </tr>
                        @endforeach
                        @if ($crud->buttons()->where('stack', 'line')->count())
                            <tr>
                                <td><strong>{{ trans('backpack::crud.actions') }}</strong></td>
                                <td>
                                    @include('crud::inc.button_stack', ['stack' => 'line'])
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div>
    </div>

    <section class="container-fluid d-print-none">
        <a href="javascript: window.print();" class="btn float-right"><i class="la la-print"></i></a>
        <h2>
            <span class="text-capitalize">المتقدمين للوظيفة </span>

        </h2>
    </section>
    <div id="crudTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
        <div class="row hidden">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 d-print-none"></div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table id="crudTable"
                       class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2 dataTable dtr-inline"
                       data-responsive-table="1" data-has-details-row="0" data-has-bulk-actions="0" cellspacing="0"
                       aria-describedby="crudTable_info">
                    <thead>
                    <tr>
                        <th>

                            اسم
                        </th>

                        <th>

                            البريد الالكتروني
                        </th>
                        <th>

                            تاريخ التقديم
                        </th>

                        <th data-orderable="false" data-priority="1" data-visible-in-export="false"
                            class="sorting_disabled" rowspan="1" colspan="1" aria-label="أفعال">أفعال
                        </th>
                    </tr>
                    </thead>

                    <tbody>


                    @foreach(\App\Models\UserJob::with('user')->where('job_id', $entry->id)->get() as $user_job)

                        <tr class="odd">
                            <td class="dtr-control"><span>
                        {{$user_job->user->first_name}}
                    </span>
                            </td>

                            <td>
                            <span>
                <a>
                     {{$user_job->user->email}}
                     </a>
                          </span>
                            </td>
                            <td>
                            <span>
                <a>
                     {{$user_job->created_at}}
                     </a>
                          </span>
                            </td>

                            <td>
                                <a href="{{ url('dashboard/show_cv?user_uuid='.$user_job->user->uuid) }}"
                                   target="_blank" class="btn btn-sm btn-link"><i
                                        class="la la-eye"></i>
                                    عرض السيرة الذاتية</a>


                                <!-- Single edit button -->
                                <a href="{{URL('admin/user/'.$user_job->user->id . '/show')}}"
                                   class="btn btn-sm btn-link"><i
                                        class="la la-eye"></i> عرض</a>


                                <!-- Single edit button -->
                                <a href="{{URL('admin/user/'.$user_job->user->id . '/edit')}}"
                                   class="btn btn-sm btn-link"><i
                                        class="la la-edit"></i> تعديل</a>


                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div id="crudTable_processing" class="dataTables_processing card" style="display: none;"><img
                        src="http://localhost:8000/packages/backpack/base/img/spinner.svg" alt="معالجة..."></div>
            </div>
        </div>
    </div>



@endsection

