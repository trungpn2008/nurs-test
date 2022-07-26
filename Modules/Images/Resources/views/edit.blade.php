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
            <h5 class="card-header">Sửa @if ($type == 'partner')partner @else images @endif</h5>
            <form class="card-body" id="form-images" method="post" action="" enctype="application/x-www-form-urlencoded">
                @csrf
                {{--            <h6 class="fw-normal">1. Thông tin cấu hình</h6>--}}
                <input type="hidden" name="type" value="@if ($type == 'partner') Partner @else Banner @endif">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="title">Tiêu đề</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Tiêu đề" value="{{$images->title}}" />
                    </div>


                    <div class="col-md-5">
                        <label class="form-label" for="arrange">Sắp xếp</label>
                        <input type="number" id="arrange" name="arrange" class="form-control" placeholder="Sắp xếp" value="{{$images->arrange}}" />
                    </div>
                    <div class="col-md-1">
                        <label class="form-label" for="status">Trạng thái</label>
                        <div class="form-check form-switch mb-2" style="padding-top: 5px;">
                            <input class="form-check-input" name="status" type="checkbox" id="status"  @if ($images->status == 1) checked @endif>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="link">Link</label>
                        <input type="text" id="link" name="link" class="form-control" placeholder="Link" value="{{$images->link}}" />
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="type-image">Loại</label>
                        <div class="">
                            <select id="type-image" name="blueprint_type_id" class="form-select" data-allow-clear="true">
                                <option value="">Chọn loại</option>
                                @if($images->blueprint_type_id)
                                    <option value="{{$images->blueprint_type_id}}" selected>{{$blueprinttype->title}}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-image">Image</label>
                            <div class="input-group">
                                <input type="text" name="image" id="ckfinder-input-image" value="{{$images->image}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image" class="btn btn-primary">Chọn</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-icon">Icon</label>
                            <div class="input-group">
                                <input type="text" name="icon" id="ckfinder-input-icon" value="{{$images->icon}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-icon" class="btn btn-primary">Chọn</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-image-left">Image Left</label>
                            <div class="input-group">
                                <input type="text" name="image_left" id="ckfinder-input-image-left" value="{{$images->image_left}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-left" class="btn btn-primary">Chọn</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-image-right">Image Right</label>
                            <div class="input-group">
                                <input type="text" name="image_right" id="ckfinder-input-image-right" value="{{$images->image_right}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-right" class="btn btn-primary">Chọn</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">list images <a href="javascript:void(0);" class="btn btn-primary btn-add-js-images" data-type="listImages" data-boxinput="box-input-list-image" data-boxadd="box-list-images" style="padding: 0;"><i class="bx bx-plus"></i></a></label>
                        <div class="box-list-images">
                            @if (isset($images->list_image))
                                <?php $count_number= count(json_decode($images->list_image)); ?>
                                @foreach (json_decode($images->list_image) as $key => $item)
                                        <div class="box-input-list-image">
                                            <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
                                                <div class="card accordion-item active">
                                                    <h2 class="accordion-header d-flex align-items-center">
                                                        <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-{{$key}}" aria-expanded="true">
                                                            <i class="bx bx-bar-chart-alt-2 me-2"></i>
                                                            <span class="title-list_image-box-{{$key}}">{{isset($item->title)?$item->title:''}}</span>
                                                        </button>
                                                        <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$key}}" data-boxinput="box-input-list-image" style="display: block;"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
                                                    </h2>

                                                    <div id="box-{{$key}}" class="accordion-collapse collapse show" style="padding: 10px 0;">
                                                        <div class="container">
                                                            <input type="hidden" name="list_image[{{$key}}][type]" value="listImages">
                                                            <input type="hidden" name="list_image[{{$key}}][number]" value="{{$key}}">
                                                            <div class="row g-3">
                                                                <div class="col-md-5">
                                                                    <label class="form-label" for="title_list_image_{{$key}}">Tên </label>
                                                                    <input type="text" id="title_list_image_{{$key}}" name="list_image[{{$key}}][title]" class="form-control" placeholder="Tên" value="{{isset($item->title)?$item->title:''}}"/>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label" for="subtitle_list_image_{{$key}}">Note </label>
                                                                    <input type="text" id="note_list_image_{{$key}}" name="list_image[{{$key}}][note]" class="form-control" placeholder="note" value="{{isset($item->note)?$item->note:''}}" />
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="ckfinder-input-image-list_image-{{$key}}">Image</label>
                                                                        <div class="input-group">
                                                                            <input type="text" name="list_image[{{$key}}][image]" id="ckfinder-input-image-list_image-{{$key}}" value="{{isset($item->image)?$item->image:''}}"
                                                                                   class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-list_image-{{$key}}" class="btn btn-primary">Chọn</a></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <label class="form-label" for="check_{{$key}}">Check</label>
                                                                    <div class="form-check form-switch mb-2" style="padding-top: 5px;">
                                                                        <input class="form-check-input" name="list_image[{{$key}}][check]" type="checkbox" id="check_{{$key}}" @if (isset($item->check))
                                                                            checked
                                                                        @endif >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            $(".remove-box").on('click',function () {
                                                var boxInput = $(this).data('boxinput');
                                                var lengBoxInput = $('.'+boxInput).length - 2;
                                                $(this).closest('.'+boxInput).remove();
                                                if(lengBoxInput >= 0){
                                                    $('.'+boxInput+' .btn-remove-box-'+lengBoxInput).show();
                                                }
                                            });
                                            $("#ckfinder-popup-image-list_image-{{$key}}").on('click',function () {
                                                selectFileWithCKFinder( 'ckfinder-input-image-list_image-{{$key}}' );
                                            })
                                            $('#title_list_image_{{$key}}').on('keyup',function () {
                                                $(".title-list_image-box-{{$key}}").text($(this).val());
                                            })
                                        </script>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="intro">Intro First</label>
                        <textarea name="intro" id="intro"  class="form-control" placeholder="Nội dung" cols="30" rows="10">{{$images->intro}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="intro2">Intro Second</label>
                        <textarea name="intro2" id="intro2"  class="form-control" placeholder="Nội dung" cols="30" rows="10">{{$images->intro2}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="description">Nội dung</label>
                        <textarea name="description" id="description"  class="form-control" placeholder="Nội dung" cols="30" rows="10">{{$images->description}}</textarea>
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
        function blueprintType(options) {
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
                }
            });
        }
        $(document).ready(function () {
            blueprintType({
                object: '#type-image',
                url: '{{ route("admin.blueprinttype.ajax-get") }}',
                data_id: 'id',
                data_text: 'text',
                title_default: 'Chọn loại'
            });
        })
        $(".btn-add-js-images").on('click',function () {
            var type = $(this).data('type');
            var boxInput = $(this).data('boxinput');
            var boxadd = $(this).data('boxadd');
            var lengBoxInput = $('.'+boxInput).length;
            $.ajax({
                type: "get",
                dataType: "html",
                url: '{{ route("admin.images.ajax-get-box-images") }}',
                data: {'type': type,'count':(lengBoxInput)},
                async: false,
                success: function (data) {
                    if(data === 'false-load'){
                        // $('.'+boxadd).html('<h6 class="fw-normal">Loại box này chưa dựng data!</h6>');
                        // toastr.warning('Loại danh mục này không có dữ liệu thêm!');
                    }else{
                        $("."+boxInput+" .remove-box").hide();
                        $("."+boxInput+" .accordion-item").removeClass('active');
                        $("."+boxInput+" .accordion-collapse").removeClass('show');
                        $('.'+boxadd).append(data);
                        toastr.success('Load dữ liệu thêm thành công!');
                    }
                },
                error: function () {
                    // _.alert(_.label("Unknown error."));
                }
            });
        });
        $("#ckfinder-popup-image").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-image' );
        })
        $("#ckfinder-popup-icon").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-icon' );
        })
        $("#ckfinder-popup-image-left").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-image-left' );
        })
        $("#ckfinder-popup-image-right").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-image-right' );
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
        CKEDITOR.replace('intro',editor_config);
        CKEDITOR.replace('intro2',editor_config);
        CKEDITOR.replace('description',editor_config);
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
        sidebarMenu('Partner', 'index');
        @else
        sidebarMenu('Images', 'index');
        @endif
    </script>
@endsection
@include('ckfinder::setup')

