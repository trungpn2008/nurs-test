@extends('Backend.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/libs/select2/select2.css" />
@endsection
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">Recruitment /</span> List
    </h4>
    <div class="box-content">
        <div class="card mb-4">
        <h5 class="card-header">Sửa</h5>
        <form class="card-body" id="form-recruitment" method="post" action="" enctype="application/x-www-form-urlencoded">
            @csrf
{{--            <h6 class="fw-normal">1. Thông tin cấu hình</h6>--}}
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="title">Tiêu đề</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Tiêu đề" value="{{$recruitment->title}}" />
                </div>
                <div class="col-md-5">
                    <label class="form-label" for="number">Số lượng</label>
                    <input type="number" id="number" name="number" class="form-control" placeholder="Số lượng" value="{{$recruitment->number}}" />
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="hot">Hot</label>
                    <div class="form-check form-switch mb-2" style="padding-top: 5px;">
                        <input class="form-check-input" name="hot" type="checkbox" id="hot"  @if ($recruitment->hot == 1) checked @endif>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="ckfinder-input-image">File mẫu</label>
                        <div class="input-group">
                            <input type="text" name="file" id="ckfinder-input-image" value="{{$recruitment->file}}"
                                   class="form-control" placeholder="File mẫu" ><span class="input-group-btn">
                                <a id="ckfinder-popup-image" class="btn btn-primary">Chọn</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="time-end-datetime" class="form-label">Datetime</label>
                    <div class="col-md-12">
                        <input class="form-control" type="date" name="time_end" id="time-end-datetime" value="{{$recruitment->time_end}}" />
                    </div>
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="status">Trạng thái</label>
                    <div class="form-check form-switch mb-2" style="padding-top: 5px;">
                        <input class="form-check-input" name="status" type="checkbox" id="status"  @if ($recruitment->status == 1) checked @endif>
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="description">Nội dung</label>
                    <textarea name="description" id="description"  class="form-control" placeholder="Nội dung" cols="30" rows="10">{{$recruitment->description}}</textarea>
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" form="form-recruitment" class="btn btn-primary me-sm-3 me-1">Submit</button>
                <a href="{{route('admin.recruitment.index')}}" class="btn btn-label-secondary">Back</a>
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

        var editor_config = {
            language: 'vi',
            removeButtons : 'Underline,Subscript,Superscript',

            // Set the most common block elements.
            format_tags : 'p;h1;h2;h3;pre',

            // Simplify the dialog windows.
            removeDialogTabs : 'image:advanced;link:advanced',
            fillEmptyBlocks : false,
            tabSpaces : 0,
            forcePasteAsPlainText : true,
            basicEntities : false,
            entities_latin : false,
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
            {{--filebrowserImageBrowseUrl: "{{ route('ckfinder_browser') }}?type=Images",--}}
            {{--filebrowserFlashBrowseUrl: "{{ route('ckfinder_browser') }}?type=Flash",--}}
            {{--filebrowserUploadUrl     : "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files",--}}
            {{--filebrowserImageUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Images",--}}
            {{--filebrowserFlashUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Flash",--}}
            {{--        filebrowserBrowseUrl: '{{ url('/kcfinder/browse.php?type=image') }}',--}}

        };
        CKEDITOR.replace('description',editor_config);
        CKEDITOR.replace('short_description',editor_config);
        CKEDITOR.replace('note',editor_config);

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
        const formAuthentication = document.querySelector('#form-recruitment');

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
                            number: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter number'
                                    },
                                    stringLength: {
                                        min: 1,
                                        message: 'The title must be more than 1'
                                    }
                                }
                            },
                            time_end: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please select your time end'
                                    }
                                }
                            },
                            description: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter description'
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
                                        case 'number':
                                        case 'time_end':
                                        case 'description':
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
        sidebarMenu('Recruitment', 'index');
    </script>
@endsection
@include('ckfinder::setup')

