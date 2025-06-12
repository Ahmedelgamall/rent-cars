@extends('dashboard.layouts.app')
@section('title', getTranslatedWords('add role'))
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bs-stepper/bs-stepper.min.css') }}">
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container .select2-selection--single {

            height: 35px;

        }
    </style>
@endsection
@section('js')
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bs-stepper/bs-stepper.min.js') }}"></script>
    <script>
        $('select').select2();
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.sidebar-permissions .nav-link').forEach(function(element) {

                element.addEventListener('click', function(e) {

                    let nextEl = element.nextElementSibling;
                    let parentEl = element.parentElement;

                    if (nextEl) {
                        e.preventDefault();
                        let mycollapse = new bootstrap.Collapse(nextEl);

                        if (nextEl.classList.contains('show')) {
                            mycollapse.hide();
                        } else {
                            mycollapse.show();
                            // find other submenus with class=show
                            var opened_submenu = parentEl.parentElement.querySelector(
                                '.submenu.show');
                            // if it exists, then close all of them
                            if (opened_submenu) {
                                new bootstrap.Collapse(opened_submenu);
                            }
                        }
                    }
                }); // addEventListener
            }) // forEach
        });
        document.addEventListener('DOMContentLoaded', function() {

            window.stepper = new Stepper(document.querySelector('#stepper'));

        })

        $('.choose_permissions').click(function() {

            var x = $(this);



            var groups = $(".choose_permissions:checked")
                .map(function() {
                    return $(this).attr('data-group');
                }).get();


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ URL::to('get_permissions') }}",
                method: 'get',
                data: {
                    groups: groups,

                },
                success: function(res) {


                    if (res != "") {

                        $(
                            '.show_permissions').find('.check_all').prop("checked", false);
                        $('.show_permissions tbody tr')
                            .detach();
                        $('.choose_monitors').empty();
                        $('.choose_monitors').append(
                            "<option disabled selected>{{ getTranslatedWords('select') }}</option>"
                        );

                        $.each(res.monitors, function(key, value) {

                            $('.choose_monitors')
                                .append('<option value="' + key + '">' + value +
                                    '</option>');
                        });

                        // x.closest('form').parent('.modal-body').find('.data-table2').DataTable().draw();
                        $.each(res.permissions, function(key, value) {
                            var values = $(
                                    "input[name='permissions[]']")
                                .map(function() {
                                    return $(this).val();
                                }).get();

                            if (!values.includes(key)) {
                                $(
                                    '.show_permissions tbody').append('<tr><td>' + value +
                                    '</td><td>' +
                                    '<input type="checkbox" class="select_permissions" value="' +
                                    key + '"></td></tr>');
                            } else {
                                $(
                                    '.show_permissions tbody').append('<tr><td>' + value +
                                    '</td><td>' +
                                    '<input type="checkbox" checked class="select_permissions" value="' +
                                    key + '"></td></tr>');
                            }

                        });





                    } else {
                        //alert("تعذر الحصول على تصنيفات لهذا التصنيف الرئيسى");


                        //x.closest('form').parent('.modal-body').find('.data-table2').DataTable().draw();
                        $('.show_permissions tbody tr')
                            .detach();




                    }







                },

                error: function() {
                    alert("خطأ فى تحديث البيانات حاول لاحقا")
                }
            });


        })


        $(document).on('change', '.choose_monitors', function() {


            var x = $(this);
            var monitor = $(this).val();
            if (monitor != '') {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ URL::to('get_permissions_per_monitor') }}",
                    method: 'get',
                    data: {
                        monitor: monitor
                    },
                    success: function(res) {


                        if (res != "") {


                            $('.show_permissions tbody tr')
                                .detach();


                            $('.show_permissions').find('.check_all').prop("checked", false);

                            // x.closest('form').parent('.modal-body').find('.data-table2').DataTable().draw();
                            $.each(res, function(key, value) {
                                var values = $("input[name='permissions[]']")
                                    .map(function() {
                                        return $(this).val();
                                    }).get();

                                if (!values.includes(key)) {
                                    $(
                                        '.show_permissions tbody').append('<tr><td>' +
                                        value +
                                        '</td><td>' +
                                        '<input type="checkbox" class="select_permissions" value="' +
                                        key + '"></td></tr>');
                                } else {
                                    $(
                                        '.show_permissions tbody').append('<tr><td>' +
                                        value +
                                        '</td><td>' +
                                        '<input type="checkbox" checked class="select_permissions" value="' +
                                        key + '"></td></tr>');
                                }

                            });





                        } else {
                            //alert("تعذر الحصول على تصنيفات لهذا التصنيف الرئيسى");


                            //x.closest('form').parent('.modal-body').find('.data-table2').DataTable().draw();
                            $('.show_permissions tbody tr')
                                .detach();




                        }







                    },

                    error: function() {
                        alert("خطأ فى تحديث البيانات حاول لاحقا")
                    }
                });
            }




        })

        $(document).on('click', '.select_permissions', function() {
            //$('.select_permissions').click(function() {

            var x = $(this);

            if (x.prop("checked") == false) {


                $(
                        ".view_permissions ul li input[value='" + x.val() + "']").closest('li')
                    .remove();

            }

            var selected = $(".select_permissions:checked")
                .map(function() {
                    return $(this).val();
                }).get();
            var values = $("input[name='permissions[]']")
                .map(function() {
                    return $(this).val();
                }).get();
            var ids = $.merge(selected, values);
            ids = $.unique(ids);





            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ URL::to('show_permissions') }}",
                method: 'post',
                data: {
                    ids: ids,

                },
                success: function(res) {


                    if (res != "") {

                        $('.view_permissions')
                            .html(res);
                        /*x.closest('form').parent('.modal-body').find('.view_permissions ul')
                            .html('');*/


                        // x.closest('form').parent('.modal-body').find('.data-table2').DataTable().draw();

                        /*$.each(res, function(key, value) {
                            
                           
                            if (!values.includes(key)) {

                                x.closest('form').parent('.modal-body').find(
                                    '.view_permissions ul').append(
                                    '<li class="col-lg-4 mb-4 text-center"><input type="hidden" name="permissions[]" value="' +
                                    key + '">' +
                                    value + ' ' +
                                    '<a href="#" class="delete_permission btn btn-danger d-flex justify-content-center mt-2"><i class="bx bx-times"></i></a></li>'
                                );
                               
                            }

                        });*/






                    } else {
                        //alert("تعذر الحصول على تصنيفات لهذا التصنيف الرئيسى");


                        //x.closest('form').parent('.modal-body').find('.data-table2').DataTable().draw();
                        $('.view_permissions')
                            .html('');




                    }







                },

                error: function() {
                    alert("خطأ فى تحديث البيانات حاول لاحقا")
                }
            });


        })

        $(document).on('click', '.delete_permission', function(e) {
            e.preventDefault();
            var x = $(this).closest('li').find('input').val();
            $(
                ".show_permissions tbody input[type=checkbox][value='" + x + "']").prop("checked", false);
            $(this).closest('li').remove();

        })



        $(document).on('click', '.check_all', function() {

            $('.show_permissions input:checkbox:visible').prop(
                'checked',
                this.checked);
            var x = $(this);

            $('.show_permissions input:checkbox:visible').each(function() {

                if ($(this).prop("checked") == false) {


                    $(".view_permissions ul li input[value='" + $(this).val() + "']").closest('li')
                        .remove();

                }
            });

            var selected = $(".select_permissions:checked")
                .map(function() {
                    return $(this).val();
                }).get();
            var values = $("input[name='permissions[]']")
                .map(function() {
                    return $(this).val();
                }).get();
            var ids = $.merge(selected, values);
            ids = $.unique(ids);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ URL::to('show_permissions') }}",
                method: 'post',
                data: {
                    ids: ids,

                },
                success: function(res) {


                    if (res != "") {


                        $('.view_permissions')
                            .html(res);







                    } else {
                        //alert("تعذر الحصول على تصنيفات لهذا التصنيف الرئيسى");


                        //x.closest('form').parent('.modal-body').find('.data-table2').DataTable().draw();
                        /*x.closest('form').parent('.modal-body').find('.view_permissions')
                            .html('');*/




                    }







                },

                error: function() {
                    alert("خطأ فى تحديث البيانات حاول لاحقا")
                }
            });

        })
    </script>
@endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ getTranslatedWords('home') }} /</span> {{ getTranslatedWords('add role') }}</h4>

    <div class="row">
        <div class="col-md-12">

            <div class="card mb-4">
                <h5 class="card-header">{{ getTranslatedWords('add role') }}</h5>
                <!-- Account -->

                <hr class="my-0" />
                <div class="card-body">
                    <form enctype="multipart/form-data" id="formAccountSettings" method="POST" action="{{ route('roles.store') }}">
                        @csrf



                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="email" class="form-label">{{ getTranslatedWords('name') }}</label>
                                <input type="text" value="{{ old('name') }}" class="form-control" name="name"
                                    placeholder="{{ getTranslatedWords('name') }}">
                                @error('name')
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                                @enderror
                            </div>
                            <div id="stepper" class="bs-stepper">
                                <div class="bs-stepper-header" role="tablist">
                                    <!-- your steps here -->
                                    <div class="step" data-target="#monitors-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="monitors-part" id="monitors-part-trigger">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">{{ getTranslatedWords('monitors') }}</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#processes-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="processes-part" id="processes-part-trigger">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">{{ getTranslatedWords('processes') }}</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#permissions-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="permissions-part" id="permissions-part-trigger">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">{{ getTranslatedWords('permissions selected') }}</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">
                                    <div id="monitors-part" class="content" role="tabpanel" aria-labelledby="monitors-part-trigger">
                                        <div class="d-flex justify-content-end mt-2 mb-2">
                                            <a class="btn btn-primary" onclick="stepper.next()"><i class="bx @if (App::getLocale() != 'ar') bx-chevron-right @else bx-chevron-left @endif"></i></a>
                                        </div>

                                        <nav class="sidebar-permissions card py-2 mb-4">
                                            <ul class="nav flex-column" id="nav_accordion">
                                                <label for="">{{ getTranslatedWords('choose one monitors group at least to show permission') }}
                                                    *</label>
                                                @foreach (Spatie\Permission\Models\Permission::groupBy('permission_group')->pluck('permission_group')->toArray() as $permission)
                                                    <li>
                                                        <input type="checkbox" class="choose_permissions" data-group="{{ $permission }}">
                                                        <a class="nav-link d-inline-block mb-2" href="javascript:void(0)">
                                                            {{ getTranslatedWords('' . $permission) }}</a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </nav>







                                        <div class="d-flex justify-content-end mt-2 mb-2">
                                            <a class="btn btn-primary" onclick="stepper.next()"><i class="bx @if (App::getLocale() != 'ar') bx-chevron-right @else bx-chevron-left @endif"></i></a>
                                        </div>


                                    </div>
                                    <div id="processes-part" class="content" role="tabpanel" aria-labelledby="processes-part-trigger">
                                        <div class="d-flex justify-content-center mt-2 mb-2 justify-content-between">

                                            <a class="btn btn-primary" onclick="stepper.previous()"><i class="bx @if (App::getLocale() != 'ar') bx-chevron-left @else bx-chevron-right @endif"></i>
                                            </a>
                                            <a class="btn btn-primary" onclick="stepper.next()"><i class="bx @if (App::getLocale() != 'ar') bx-chevron-right @else bx-chevron-left @endif"></i></a>
                                        </div>

                                        <div class="table-responsive">
                                            {{-- <input type="text" class="form-control mb-4 search"
                                                placeholder="{{ getTranslatedWords('search') }}"> --}}
                                            <select name="" class="form-control choose_monitors mb-4 test">
                                                <option value="">
                                                    {{ getTranslatedWords('select groups and categories first') }}
                                                </option>
                                            </select>
                                            @error('permissions')
                                                <div class="text-danger">{{ $errors->first('permissions') }}</div>
                                            @enderror
                                            <table class="w-100 table table-bordered show_permissions mt-4">
                                                <thead>
                                                    <tr>
                                                        <td>{{ getTranslatedWords('permission name') }}</td>
                                                        <td>{{ getTranslatedWords('permit') }} <br>
                                                            <input type="checkbox" class="check_all">
                                                            {{ getTranslatedWords('check all') }}
                                                        </td>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>

                                            </table>
                                        </div>
                                        <div class="d-flex justify-content-center mt-2 mb-2 justify-content-between">
                                            <a class="btn btn-primary" onclick="stepper.previous()"><i class="bx @if (App::getLocale() != 'ar') bx-chevron-left @else bx-chevron-right @endif"></i>
                                            </a>
                                            <a class="btn btn-primary" onclick="stepper.next()"><i class="bx @if (App::getLocale() != 'ar') bx-chevron-right @else bx-chevron-left @endif"></i></a>


                                        </div>

                                    </div>
                                    <div id="permissions-part" class="content" role="tabpanel" aria-labelledby="permissions-part-trigger">
                                        <div class="d-flex justify-content-start mt-2 mb-2">
                                            <a class="btn btn-primary" onclick="stepper.previous()"><i class="bx @if (App::getLocale() != 'ar') bx-chevron-left @else bx-chevron-right @endif"></i>
                                            </a>
                                        </div>

                                        <div class="view_permissions">

                                        </div>

                                        <div class="d-flex justify-content-start mt-2 mb-2">
                                            <a class="btn btn-primary" onclick="stepper.previous()"><i class="bx @if (App::getLocale() != 'ar') bx-chevron-left @else bx-chevron-right @endif"></i>
                                            </a>
                                        </div>


                                    </div>
                                </div>
                            </div>







                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">{{ getTranslatedWords('submit') }}</button>
                            <button type="reset" class="btn btn-outline-secondary">{{ getTranslatedWords('cancel') }}</button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>

        </div>
    </div>
</div>
@endsection