@extends('Backend.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/libs/select2/select2.css" />
@endsection
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">Customer /</span> Edit
    </h4>
    <div class="box-content">
        <div class="card mb-4">
        <h5 class="card-header">Show Customer</h5>
        <form id="form-category-type" class="card-body" method="post" action="" enctype="application/x-www-form-urlencoded">
            @csrf
            <h6 class="fw-normal">1. Thông tin cấu hình</h6>
            <div class="row g-3">
                <div class="col-md-12">
                    @if($customer->avatar)
                    <img src="/storage/{{$customer->avatar}}" alt="Avatar" class="rounded-circle me-3" width="150" style="justify-content: center;display: flex;margin: auto !important;">
                    @else
                        <img src="/images/no-image.png" alt="Avatar" class="rounded-circle me-3" width="150" style="justify-content: center;display: flex;margin: auto !important;">
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="name">Name</label>
                    <p class="fw-bolder">{{$customer->name}}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="user_name">NickName</label>
                    <p class="fw-bolder">{{$customer->user_name}}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="email">Email</label>
                    <p class="fw-bolder">{{$customer->email}}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="phone">Phone</label>
                    <p class="fw-bolder">{{$customer->phone}}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="pass_port">ID</label>
                    <p class="fw-bolder">{{$customer->pass_port}}</p>
                </div>
                @if($customer->day_of_birth || $customer->month_of_birth || $customer->year_of_birth)
                    <div class="col-md-6">
                        <label class="form-label" for="birth">Birth</label>
                        @if($customer->day_of_birth && empty($customer->month_of_birth)&& empty($customer->year_of_birth))
                            <p class="fw-bolder">{{$customer->day_of_birth}}</p>
                        @elseif($customer->day_of_birth && $customer->month_of_birth&& empty($customer->year_of_birth))
                            <p class="fw-bolder">{{$customer->day_of_birth .' / '.$customer->month_of_birth}} </p>
                        @elseif($customer->day_of_birth && $customer->month_of_birth&& $customer->year_of_birth)
                            <p class="fw-bolder">{{$customer->day_of_birth .' / '.$customer->month_of_birth .' / '.$customer->year_of_birth}} </p>
                        @elseif(empty($customer->day_of_birth) && $customer->month_of_birth && $customer->year_of_birth)
                            <p class="fw-bolder">{{$customer->month_of_birth .' / '.$customer->year_of_birth}} </p>
                        @elseif(empty($customer->day_of_birth) && empty($customer->month_of_birth) && $customer->year_of_birth)
                            <p class="fw-bolder">{{$customer->year_of_birth}} </p>
                        @elseif(empty($customer->day_of_birth) && $customer->month_of_birth && empty($customer->year_of_birth))
                            <p class="fw-bolder">{{' / '.$customer->month_of_birth.' / '}} </p>
                        @elseif($customer->day_of_birth && empty($customer->month_of_birth) && $customer->year_of_birth)
                            <p class="fw-bolder">{{$customer->day_of_birth.' / / '.$customer->year_of_birth}} </p>
                        @endif

                    </div>
                @endif
                <div class="col-md-6">
                    <label class="form-label" for="gender">Gender</label>
                    <p class="fw-bolder">{{$customer->gender==1?'Female':'Male'}}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="zipcode">Zipcode</label>
                    <p class="fw-bolder">{{$customer->zipcode}}</p>
                    <p class="fw-bolder">{{$customer->address2}}</p>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="address">Address</label>
                    <p class="fw-bolder">{{$customer->address}}</p>
                </div>
                @if($customer->data_choose)
                    @foreach(json_decode($customer->data_choose,true) as $key => $item)
                        <div class="col-md-6">
                            <label class="form-label" for="{{$key}}">{{$key}}</label>
                            <p class="fw-bolder">{{$item}}</p>
                        </div>
                    @endforeach
                @endif
                @if($customer->content_profile)
                <div class="col-md-12">
                    <label class="form-label" for="profile">Profile</label>
                    <p class="fw-bolder">{{$customer->content_profile}}</p>
                </div>
                @endif
                <div class="col-md-12">
                    @if($customer->covered == 1)
                        <p class="fw-bolder text-success">This customer has insurance</p>
                    @else
                        <p class="fw-bolder text-danger">This customer has no insurance</p>
                    @endif
                </div>
                <div class="col-md-3">
                    @if($customer->verify == 1)
                        <p class="fw-bolder text-success">Customer is verify</p>
                    @else
                        <p class="fw-bolder text-danger">Customer is not verify</p>
                    @endif
                </div>
                <div class="col-md-3">
                    @if($customer->ban == 0)
                        <p class="fw-bolder text-success">Customer is not ban</p>
                    @else
                        <p class="fw-bolder text-danger">Customer is ban</p>
                    @endif
                </div>
                <div class="col-md-3">
                    @if($customer->status == 1)
                        <p class="fw-bolder text-success">Customer is active</p>
                    @else
                        <p class="fw-bolder text-danger">Customer is unactive</p>
                    @endif
                </div>
            </div>
{{--            <hr class="my-4 mx-n4" />--}}
{{--            <div class="pt-4">--}}
{{--                <button type="submit" form="form-category-type" class="btn btn-primary me-sm-3 me-1">Submit</button>--}}
{{--                <a href="{{route('admin.faqcates.index')}}" class="btn btn-label-secondary">Back</a>--}}
{{--            </div>--}}
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
                                        min: 3,
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
        sidebarMenu('$STUDLY_NAME$', 'index');
    </script>
@endsection=

