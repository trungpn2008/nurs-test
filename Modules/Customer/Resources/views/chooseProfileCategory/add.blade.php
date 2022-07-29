@extends('Backend.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/libs/select2/select2.css" />
@endsection
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">Choose Profile Category /</span> Add
    </h4>
    <div class="box-content">
        <div class="card mb-4">
        <h5 class="card-header">Thêm Choose Profile Category</h5>
        <form id="form-category-type" class="card-body" method="post" action="" enctype="application/x-www-form-urlencoded">
            @csrf
            <h6 class="fw-normal">1. Thông tin cấu hình</h6>
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Tiêu đề" />
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="name_input">Name Input</label>
                    <input type="text" id="name_input" name="name_input" class="form-control" placeholder="Name Input" />
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="requiredChecked">required</label>
                    <div class="form-check form-switch mb-2" style="padding-top: 5px;">
                        <input class="form-check-input" name="required" type="checkbox" id="requiredChecked">
                    </div>
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="flexSwitchCheckChecked">Trạng thái</label>
                    <div class="form-check form-switch mb-2" style="padding-top: 5px;">
                        <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked">
                    </div>
                </div>
            </div>
            <hr class="my-4 mx-n4" />
            <div class="pt-4">
                <button type="submit" form="form-category-type" class="btn btn-primary me-sm-3 me-1">Submit</button>
                <a href="{{route('admin.choose-profile-category.index')}}" class="btn btn-label-secondary">Back</a>
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
    <script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>
    <script>
        const formCategoryType = document.querySelector('#form-category-type');

        document.addEventListener('DOMContentLoaded', function (e) {
            (function () {
                // Form validation for Add new record
                if (formCategoryType) {
                    const fv = FormValidation.formValidation(formCategoryType, {
                        fields: {
                            title: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter title'
                                    },
                                    stringLength: {
                                        min: 2,
                                        max:255,
                                        message: 'The title must be more than 3 and less than 255 characters long'
                                    }
                                }
                            },
                            code: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter your code'
                                    },
                                    stringLength: {
                                        min: 3,
                                        max:255,
                                        message: 'The code must be more than 3 and less than 255 characters lon'
                                    }
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
        sidebarMenu('ChooseProfileCategory', 'add');
    </script>
@endsection

