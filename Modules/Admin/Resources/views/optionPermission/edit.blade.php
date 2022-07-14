@extends('Backend.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/libs/select2/select2.css" />
@endsection
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">OptionActionPermission /</span> List
    </h4>
    <div class="box-content">
        <div class="card mb-4">
        <h5 class="card-header">Sửa lựa chọn pemission</h5>
        <form class="card-body" method="post" action="" enctype="application/x-www-form-urlencoded">
            @csrf
{{--            <h6 class="fw-normal">1. Thông tin cấu hình</h6>--}}
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="title">Tiêu đề</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Tiêu đề" value="{{$option->title}}" />
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="code">Code</label>
                    <input type="text" id="code" name="code" class="form-control" placeholder="Code" value="{{$option->code}}" />
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                <a href="{{route('admin.option.index')}}" class="btn btn-label-secondary">Back</a>
            </div>
        </form>
    </div>
    </div>
@endsection
@section('javascript')
    <script src="/libs/cleavejs/cleave.js"></script>
    <script src="/libs/cleavejs/cleave-phone.js"></script>
    <script src="/libs/moment/moment.js"></script>
    <script src="/libs/flatpickr/flatpickr.js"></script>
    <script src="/libs/select2/select2.js"></script>
    <script src="/js/form-layouts.js"></script>
    <script src="/js/ckfinder/ckfinder.js"></script>
    <script src="/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
    <script>
        const formAuthentication = document.querySelector('#form-roles');

        document.addEventListener('DOMContentLoaded', function (e) {
            (function () {
                // Form validation for Add new record
                if (formAuthentication) {
                    const fv = FormValidation.formValidation(formAuthentication, {
                        fields: {
                            title: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter title'
                                    },
                                    stringLength: {
                                        min: 3,
                                        max:255,
                                        message: 'The title must be more than 3 and less than 255 characters long'
                                    }
                                }
                            },
                            code: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter your module'
                                    },
                                    stringLength: {
                                        min: 1,
                                        max:10,
                                        message: 'The module must be more than 1 and less than 10 characters long'
                                    },
                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap5: new FormValidation.plugins.Bootstrap5({
                                // Use this for enabling/changing valid/invalid class
                                // eleInvalidClass: '',
                                eleValidClass: '',
                                rowSelector: function (field, ele) {
                                    // field is the field name & ele is the field element
                                    switch (field) {
                                        case 'title':
                                        case 'code':
                                        default:
                                            return '.row';
                                    }
                                }
                            }),
                            submitButton: new FormValidation.plugins.SubmitButton(),
                            // Submit the form when all fields are valid
                            defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                            autoFocus: new FormValidation.plugins.AutoFocus()
                        },
                        init: instance => {
                            instance.on('plugins.message.placed', function (e) {
                                //* Move the error message out of the `input-group` element
                                if (e.element.parentElement.classList.contains('input-group')) {
                                    // `e.field`: The field name
                                    // `e.messageElement`: The message element
                                    // `e.element`: The field element
                                    e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                                }
                                //* Move the error message out of the `row` element for custom-options
                                if (e.element.parentElement.parentElement.classList.contains('custom-option')) {
                                    e.element.closest('.row').insertAdjacentElement('afterend', e.messageElement);
                                }
                            });
                        }
                    });
                }
            })();
        });
        sidebarMenu('Roles', 'option');
    </script>
@endsection

