@extends(backpack_view('blank'))

@php
    $defaultBreadcrumbs = [
      trans('backpack::crud.admin') => backpack_url('dashboard'),
      $crud->entity_name_plural => url($crud->route),
      trans('backpack::crud.edit') => false,
    ];

    // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs
@endphp

@section('header')
    <section class="container-fluid">
        <h2>
            <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
            <small>{!! $crud->getSubheading() ?? trans('backpack::crud.edit').' '.$crud->entity_name !!}.</small>

            @if ($crud->hasAccess('list'))
                <small><a href="{{ url($crud->route) }}" class="d-print-none font-sm"><i
                            class="la la-angle-double-{{ config('backpack.base.html_direction') == 'rtl' ? 'right' : 'left' }}"></i> {{ trans('backpack::crud.back_to_all') }}
                        <span>{{ $crud->entity_name_plural }}</span></a></small>
            @endif
        </h2>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="{{ $crud->getEditContentClass() }}">
            <!-- Default box -->

            @include('crud::inc.grouped_errors')

            <form method="post"
                  action="{{ url($crud->route.'/'.$entry->getKey()) }}"
                  @if ($crud->hasUploadFields('update', $entry->getKey()))
                  enctype="multipart/form-data"
                @endif
            >
                {!! csrf_field() !!}
                {!! method_field('PUT') !!}

                @if ($crud->model->translationEnabled())
                    <div class="mb-2 text-right">
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                {{trans('backpack::crud.language')}}
                                : {{ $crud->model->getAvailableLocales()[request()->input('_locale')?request()->input('_locale'):App::getLocale()] }}
                                &nbsp; <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($crud->model->getAvailableLocales() as $key => $locale)
                                    <a class="dropdown-item"
                                       href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}?_locale={{ $key }}">{{ $locale }}</a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            <!-- load the view from the application if it exists, otherwise load the one in the package -->
                @if(view()->exists('crud.company_job.edit_form_content'))
                    @include('crud.company_job.edit_form_content', ['fields' => $crud->fields(), 'action' => 'edit'])
                @else
                    @include('crud::company_job.edit_form_content', ['fields' => $crud->fields(), 'action' => 'edit'])
                @endif
            <!-- This makes sure that all field assets are loaded. -->
                <div class="d-none" id="parentLoadedAssets">{{ json_encode(Assets::loaded()) }}</div>
                @include('crud::inc.form_save_buttons')
            </form>
        </div>
    </div>
@endsection
@section('before_scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // $(document).on('change', 'select[name=category]', function() {
        //     alert("The text has been changed.");
        //
        // });


        $(document).ready(function () {
            $(".category").change(function () {
                $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: '/admin/get_sub_categories/' + this.value,
                    success: function (data) {
                        $("#sub_category").html("")
                        $.each(data, function (key, value) {
                            $("#sub_category").append('<option value="' + value.id + '">' + value.name_ar + '</option>');
                        });

                    },
                    error: function () {
                        console.log(data);
                    }
                });
            });
            // $("select[name='category']").click(function(){
            //     alert("The text has been changed.");
            // });

            $('div[bp-field-name="sub_category"]').click(function () {
                console.log($('select[name="sub_category[]"]').data('data-source'))
                $('select[name="sub_category[]"]').data("data-source", 'http://localhost:8000/admin/get_sub_categories/' + $('select[name="category"]').val());
                console.log($('select[name="sub_category[]"]').data('data-source'))

            })
        });

    </script>


@endsection

