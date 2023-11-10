@if ($crud->hasAccess('approvecompanyjob'))
    <a href="javascript:void(0)" onclick="ApproveEntry(this)"
       data-route="{{ url($crud->route.'/approvecompanyjob/'.$entry->getKey()) }}" class="btn btn-sm btn-link"
       data-button-type="delete"><i class="la la-check"></i> قبول الوظيفة</a>
@endif

{{-- Button Javascript --}}
{{-- - used right away in AJAX operations (ex: List) --}}
{{-- - pushed to the end of the page, after jQuery is loaded, for non-AJAX operations (ex: Show) --}}
@push('after_scripts') @if (request()->ajax()) @endpush @endif
<script>

    if (typeof ApproveEntry != 'function') {
        $("[data-button-type=delete]").unbind('click');

        function ApproveEntry(button) {
            // ask for confirmation before deleting an item
            // e.preventDefault();
            var route = $(button).attr('data-route');


            swal({
                title: "{!! trans('backpack::base.warning') !!}",
                text: "هل انت متاكد من قبول هذه الوظيفة؟",
                icon: "warning",
                buttons: ["{!! trans('backpack::crud.cancel') !!}", "قبول"],
                dangerMode: true,
            }).then((value) => {
                if (value) {
                    $.ajax({
                        url: route,
                        type: 'get',
                        success: function (result) {
                            new Noty({
                                type: "success",
                                text: " <strong>نجاح</strong><br>تم قبول الوظيفة بنجاح"
                            }).show();

                            // Hide the modal, if any
                            $('.modal').modal('hide');
                        },
                        error: function (result) {
                            // Show an alert with the result
                            swal({
                                title: "{!! trans('backpack::crud.delete_confirmation_not_title') !!}",
                                text: "{!! trans('backpack::crud.delete_confirmation_not_message') !!}",
                                icon: "error",
                                timer: 4000,
                                buttons: false,
                            });
                        }
                    });
                }
            });

        }
    }

    // make it so that the function above is run after each DataTable draw event
    // crud.addFunctionToDataTablesDrawEventQueue('deleteEntry');
</script>
@if (!request()->ajax()) @endpush @endif
