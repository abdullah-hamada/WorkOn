@extends(backpack_view('blank'))

@php
    $defaultBreadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      trans('backpack::crud.list') => false,
    ];

    // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs
@endphp

@section('header')
    <div class="container-fluid">
        <h2>
                        <span class="text-capitalize">
                           الاشعارات
                        </span>
        </h2>
    </div>
@endsection

@section('content')
    <!-- Default box -->
    <div class="row">
        <!-- THE ACTUAL CONTENT -->
        <div style="width: 100%">

            <table
                style="width: 100%"

                class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2"
            >
                <thead>
                <tr>
                    {{-- Table columns --}}
                    <th>عنوان الاشعار</th>
                    <th>نص الاشعار</th>
                    <th>تاريخ الاشعار</th>

                </tr>
                </thead>
                <tbody>

                @foreach($notifications as $notification)
                    <tr>
                        <td>{{__($notification->title)}}</td>
                        <td><a href="{{URL($notification->link)}}">{{__($notification->text)}}</a></td>
                        <td>{{$notification->created_at}}</td>

                    </tr>

                @endforeach

                </tbody>
                <tfoot>
                <tr>
                    {{-- Table columns --}}
                    <th>عنوان الاشعار</th>
                    <th>نص الاشعار</th>
                    <th>تاريخ الاشعار</th>

                </tr>
                </tfoot>
            </table>


            <div class="d-flex justify-content-center">
                {!! $notifications->links('pagination::bootstrap-4') !!}
            </div>

        </div>

    </div>

@endsection

@section('after_styles')
    <!-- DATA TABLES -->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

    <!-- CRUD LIST CONTENT - crud_list_styles stack -->

@endsection

@section('after_scripts')

@endsection
