@extends('Backend.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/libs/select2/select2.css" />
@endsection
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">@if ($type == 'partner')Partner @else Images @endif /</span> List
    </h4>
    <div class="box-content">
        <div class="card mb-4">
            <h5 class="card-header">Tạo @if ($type == 'partner')partner @else images @endif</h5>
            <form class="card-body" id="form-images" method="post" action="" enctype="application/x-www-form-urlencoded">
                @csrf
                {{--            <h6 class="fw-normal">1. Thông tin cấu hình</h6>--}}
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="title">Tiêu đề</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Tiêu đề" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="arrange">Sắp xếp</label>
                        <input type="number" id="arrange" name="arrange" class="form-control" placeholder="Sắp xếp" />
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="link">Link</label>
                        <input type="text" id="link" name="link" class="form-control" placeholder="Link" />
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-image">Image</label>
                            <div class="input-group">
                                <input type="text" name="image" id="ckfinder-input-image" value=""
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image" class="btn btn-primary">Chọn</a></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="pt-4">
                    <button type="submit" form="form-images" class="btn btn-primary me-sm-3 me-1">Submit</button>
                    <a href="{{route('admin.images.index')}}" class="btn btn-label-secondary">Back</a>
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
        $("#ckfinder-popup-image").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-image' );
        })
        function selectFileWithCKFinder( elementId ) {
            CKFinder.modal( {
                chooseFiles: true,
                top:200,
                width: 800,
                height: 600,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files.first();
                        var output = $("#"+elementId);
                        output.val(file.getUrl()) ;
                    } );

                    finder.on( 'file:choose:resizedImage', function( evt ) {
                        var output = $("#"+elementId);
                        output.val(evt.data.resizedUrl);
                    } );
                }
            } );
        }
        const formAuthentication = document.querySelector('#form-images');

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
                                        min: 6,
                                        max:255,
                                        message: 'The title must be more than 6 and less than 255 characters long'
                                    }
                                }
                            },
                            image: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter image'
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
                                        case 'image':
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
        @if ($type == 'partner')
        sidebarMenu('Partner', 'add');
        @else
        sidebarMenu('Images', 'add');
        @endif
    </script>
@endsection
@include('ckfinder::setup')

