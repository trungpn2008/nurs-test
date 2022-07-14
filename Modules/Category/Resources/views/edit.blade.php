@extends('Backend.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/libs/select2/select2.css" />
@endsection
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">Category /</span> List
    </h4>
    <div class="box-content">
        <div class="card mb-4">
            <h5 class="card-header">Tạo category</h5>
            <form class="card-body" id="form-category" method="post" action="" enctype="application/x-www-form-urlencoded">
                @csrf
                <h6 class="fw-normal">1. Thông tin cấu hình</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="title">Tiêu đề</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Tiêu đề" value="{{$category->title}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="category_action">Danh mục cha</label>
                        <div class="">
                            <select id="category_action" name="category_id" class="form-select" data-allow-clear="true">
                                <option value="">Chọn danh mục cha</option>
                                @if($category->parent_id)
                                    <option value="{{$category->parent_id}}" selected="selected">{{$category->parent_title}}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-password-toggle">
                            <label class="form-label" for="category_type_action">Loại danh mục</label>
                            <div class="">
                                <select id="category_type_action" name="type" class="form-select" data-allow-clear="true">
                                    <option value="">Chọn loại danh mục</option>
                                    @if($category->type)
                                        <option value="{{$category->type}}" selected="selected">{{$category->cate_type_title}}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-password-toggle">
                            <label class="form-label" for="arrange">Thứ tự</label>
                            <div class="input-group input-group-merge">
                                <input type="number" id="arrange" name="arrange" class="form-control" value="{{$category->arrange}}" placeholder="Vị trí" aria-describedby="multicol-confirm-password2" />
                                {{--                            <span class="input-group-text cursor-pointer" id="multicol-confirm-password2"><i class="bx bx-hide"></i></span>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label" for="flexSwitchCheckChecked">Trạng thái</label>
                        <div class="form-check form-switch mb-2" style="padding-top: 5px;">
                            <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked" @if ($category->status == 1) checked @endif >
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="form-password-toggle">
                            <label class="form-label" for="arrange">Link vị trí (Iframe google map)</label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="url_location" name="url_location" class="form-control" placeholder="Vị trí" value="{{$category->url_location}}" aria-describedby="multicol-confirm-password2" />
                            </div>
                        </div>
                        <div class="iframe-view"></div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="text_image">Text ảnh</label>
                        <input type="text" id="text_image" name="text_image" class="form-control" placeholder="Text ảnh" value="{{$category->text_image}}" />
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-image">Ảnh</label>
                            <div class="input-group">
                                <input type="text" name="image" id="ckfinder-input-image" value="{{$category->image}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image" class="btn btn-primary">Chọn</a></span>
                            </div>
                            <div class="clearfix"></div>
                            @if (!empty($category->image))
                                <img src="{{$category->image}}" width="300">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-icon">Icon</label>
                            <div class="input-group">
                                <input type="text" name="icon" id="ckfinder-input-icon" value="{{$category->icon}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-icon" class="btn btn-primary">Chọn</a></span>
                            </div>
                            <div class="clearfix"></div>
                            @if (!empty($category->icon))
                                <img src="{{$category->icon}}" width="50">
                            @endif
                        </div>
                    </div>
                </div>
                <hr class="my-4 mx-n4" />
                <div class="box-des"></div>
                <div class="pt-4">
                    <button type="submit" form="form-category" class="btn btn-primary me-sm-3 me-1">Submit</button>
                    <a href="{{route('admin.category.index')}}" class="btn btn-label-secondary">Back</a>
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

        var mySec = 1000;
        var myEvent;

        $(document).ready(function () {
            htmlCategoryType('{{$category->type}}','{{$id}}');
            $("#url_location").on('change',function (e) {
                clearTimeout(myEvent);
                url_location = $(this).val();
                myEvent = setTimeout(function(){
                    $(".iframe-view").html('<iframe src="'+GoogleMapsURLToEmbedURL(url_location)+'" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>');
                }, mySec);
            });
            $("#category_type_action").on('change',function (e) {
                clearTimeout(myEvent);
                select_cate_type = $(this).val();
                myEvent = setTimeout(function(){
                    htmlCategoryType(select_cate_type);
                }, mySec);
            });
            function htmlCategoryType(t,i) {
                $.ajax({
                    type: "get",
                    dataType: "html",
                    url: '{{ route("admin.category.ajax-get-form") }}',
                    data: {'type': t,'id':i},
                    async: false,
                    success: function (data) {
                        if(data === 'false-load'){
                            // $('.box-des').html('<h6 class="fw-normal">Loại danh mục này không có dữ liệu thêm!</h6>');
                            // toastr.warning('Loại danh mục này không có dữ liệu thêm!');
                        }else{
                            $('.box-des').html(data);
                            toastr.success('Load dữ liệu thêm thành công!');
                        }
                    },
                    error: function () {
                        // _.alert(_.label("Unknown error."));
                    }
                });
            }
            function GoogleMapsURLToEmbedURL(GoogleMapsURL)
            {
                var coords = /\@([0-9\.\,\-a-zA-Z]*)/.exec(GoogleMapsURL);
                var coords2 = /\!1s([0-9a-zA-z\:\.\,]*)/.exec(GoogleMapsURL);
                if(coords!=null)
                {
                    var coordsArray = coords[1].split(',');
                    return "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.767410027492!2d"+coordsArray[1]+"!3d"+coordsArray[0]+"!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2"+coords2[0]+"!2sAsahi%20Japan!5e0!3m2!1svi!2s!4v1646939153883!5m2!1svi!2s";
                }
            }
            get_categorys({
                object: '#category_action',
                url: '{{ route("admin.category.ajax-get-category").'?id='.$id }}',
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
            get_category_types({
                object: '#category_type_action',
                url: '{{ route("admin.categorytype.ajax-get-category-type") }}',
                data_id: 'id',
                data_text: 'text',
                title_default: 'Chọn loại danh mục'
            });
            function get_category_types(options) {
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
        const formAuthentication = document.querySelector('#form-category');

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
                            type: {
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
                                        case 'type':
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
        $("#ckfinder-popup-image").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-image' );
        })

        $("#ckfinder-popup-icon").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-icon' );
        })
        function selectFileWithCKFinder( elementId ) {
            CKFinder.modal( {
                chooseFiles: true,
                top:-200,
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
        sidebarMenu('Category', 'index');
    </script>
@endsection
@include('ckfinder::setup')

