@extends('Backend.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/libs/select2/select2.css" />
@endsection
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">News /</span> List
    </h4>
    <div class="box-content">
        <div class="card mb-4">
        <h5 class="card-header">Sửa bài viết</h5>
        <form class="card-body" method="post" id="form-news" action="" enctype="application/x-www-form-urlencoded">
            @csrf
            <h6 class="fw-normal">1. Thông tin cấu hình</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="title">Tiêu đề <span style="color: red">*</span></label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Tiêu đề" value="{{$new->title}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="category_id">Danh mục <span style="color: red">*</span></label>
                    <select id="category_action" name="category_id" class="form-select" data-allow-clear="true">
                        <option value="">Chọn danh mục</option>
                        @if($new->category_id)
                            <option value="{{$new->category_id}}" selected="selected">{{$new->parent_title}}</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="project_id">Dự án</label>
                    <select id="project_action" name="project_id" class="form-select" data-allow-clear="true">
                        <option value="">Chọn dự án</option>
                        @if($new->project_id)
                            <option value="{{$new->project_id}}" selected="selected">{{$new->project_title}}</option>
                        @endif
                    </select>
                </div>
{{--                <div class="col-md-6">--}}
{{--                    <div class="form-password-toggle">--}}
{{--                        <label class="form-label" for="alias">Alias</label>--}}
{{--                        <div class="input-group input-group-merge">--}}
{{--                            <input type="text" id="alias" name="alias" class="form-control" placeholder="Alias" value="{{$new->alias}}" aria-describedby="multicol-password2" />--}}
{{--                            <span class="input-group-text cursor-pointer" id="multicol-password2"><i class="bx bx-hide"></i></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-md-6">
                    <div class="form-password-toggle">
                        <label class="form-label" for="arrange">Vị trí</label>
                        <div class="input-group input-group-merge">
                            <input type="number" id="arrange" name="arrange" class="form-control" placeholder="Vị trí" value="{{$new->arrange}}" aria-describedby="multicol-confirm-password2" />
{{--                            <span class="input-group-text cursor-pointer" id="multicol-confirm-password2"><i class="bx bx-hide"></i></span>--}}
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4 mx-n4" />
            <h6 class="fw-normal">2. Mô tả - hình ảnh</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="short_description">Mô tả ngắn</label>
                    <textarea name="short_description" id="short_description"  class="form-control" placeholder="Mô tả ngắn" cols="30" rows="10">{{$new->short_description}}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="note">Ghi chú</label>
                    <textarea name="note" id="note"  class="form-control" placeholder="Ghi chú" cols="30" rows="10">{{$new->note}}</textarea>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="ckfinder-input-image">Image <span style="color: red">*</span></label>
                        <div class="input-group">
                            <input type="text" name="image" id="ckfinder-input-image" value="{{$new->image}}"
                                   class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image" class="btn btn-primary">Chọn</a></span>
                        </div>
                    </div>
                    @if($new->image)
                        <img src="{{$new->image}}" width="100%" style="padding-top: 10px">
                    @endif
                </div>
{{--                <div class="col-md-6 select2-primary">--}}
{{--                    <label class="form-label" for="hashtag">Hashtag</label>--}}
{{--                    <select id="hashtag" name="hashtag" class="select2 form-select" multiple>--}}
{{--                        <option value="en" @if($new->hashtag == 'en') selected @endif>English</option>--}}
{{--                        <option value="fr" @if($new->hashtag == 'fr') selected @endif>French</option>--}}
{{--                        <option value="de">German</option>--}}
{{--                        <option value="pt">Portuguese</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
                <div class="col-md-12">
                    <label class="form-label" for="description">Nội dung bài viết</label>
                    <textarea name="description" id="description"  class="form-control" placeholder="Nội dung bài viết" cols="30" rows="10">{{$new->description}}</textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="source">Nguồn</label>
                    <input type="text" id="source" name="source" class="form-control" value="{{$new->source}}" placeholder="Nguồn" />
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                <a href="{{route('admin.news.index')}}" class="btn btn-label-secondary">Back</a>
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
        $(document).ready(function () {
            get_categorys({
                object: '#category_action',
                url: '{{ route("admin.category.ajax-get-category").'?type=news' }}',
                data_id: 'id',
                data_text: 'text',
                title_default: 'Chọn danh mục cha'
            });
            function get_categorys(options) {
                $(options.object).select2({
                    ajax: {
                        url: options.url,
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                keyword: params.term,
                            }
                            return query;
                        },
                        processResults: function(json, params) {
                            var results = [{
                                id: '',
                                text: options.title_default
                            }];

                            for (i in json.data) {
                                var item = json.data[i];
                                results.push({
                                    id: item[options.data_id],
                                    text: item[options.data_text]
                                });
                            }
                            return {
                                results: results,
                            };
                        },
                        minimumInputLength: 3,
                    }
                });
            }
            get_projects({
                object: '#project_action',
                url: '{{ route("admin.projects.ajax-get-projects")}}',
                data_id: 'id',
                data_text: 'text',
                title_default: 'Chọn dự án'
            });
            function get_projects(options) {
                $(options.object).select2({
                    ajax: {
                        url: options.url,
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                keyword: params.term,
                            }
                            return query;
                        },
                        processResults: function(json, params) {
                            var results = [{
                                id: '',
                                text: options.title_default
                            }];

                            for (i in json.data) {
                                var item = json.data[i];
                                results.push({
                                    id: item[options.data_id],
                                    text: item[options.data_text]
                                });
                            }
                            return {
                                results: results,
                            };
                        },
                        minimumInputLength: 3,
                    }
                });
            }
        });
        const formAuthentication = document.querySelector('#form-news');

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
                                        message: 'The title must be more than 6 and less than 255 characters long'
                                    }
                                }
                            },
                            category_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please select your type'
                                    },
                                }
                            },
                            image: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter image'
                                    },
                                    stringLength: {
                                        min: 6,
                                        max:255,
                                        message: 'The image must be more than 6 and less than 255 characters long'
                                    }
                                }
                            },
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
                                        case 'category_id':
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
        sidebarMenu('News', 'index');
    </script>
@endsection
@include('ckfinder::setup')

