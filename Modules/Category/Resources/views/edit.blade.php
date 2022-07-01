@extends('backend.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/libs/select2/select2.css" />
@endsection
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">$STUDLY_NAME$ /</span> List
    </h4>
    <div class="box-content">
        <div class="card mb-4">
        <h5 class="card-header">Sửa</h5>
        <form class="card-body" method="post" action="" enctype="application/x-www-form-urlencoded">
            @csrf
            <h6 class="fw-normal">1. Thông tin cấu hình</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="title">Tiêu đề</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Tiêu đề" value="{{$$LOWER_NAME$->title}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="category_id">Danh mục</label>
                    <div class="">
                        <select id="category_id" name="category_id" class="select2 form-select" data-allow-clear="true">
                            <option value="">Select</option>
                            <option value="1" @if ($$LOWER_NAME$->category_id == 1) selected @endif>Australia</option>
                            <option value="2" @if ($$LOWER_NAME$->category_id == 2) selected @endif>Bangladesh</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Canada">Canada</option>
                            <option value="China">China</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Japan">Japan</option>
                            <option value="Korea">Korea, Republic of</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Russia">Russian Federation</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-password-toggle">
                        <label class="form-label" for="alias">Alias</label>
                        <div class="input-group input-group-merge">
                            <input type="text" id="alias" name="alias" class="form-control" placeholder="Alias" value="{{$$LOWER_NAME$->alias}}" aria-describedby="multicol-password2" />
{{--                            <span class="input-group-text cursor-pointer" id="multicol-password2"><i class="bx bx-hide"></i></span>--}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-password-toggle">
                        <label class="form-label" for="arrange">Vị trí</label>
                        <div class="input-group input-group-merge">
                            <input type="number" id="arrange" name="arrange" class="form-control" placeholder="Vị trí" value="{{$$LOWER_NAME$->arrange}}" aria-describedby="multicol-confirm-password2" />
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
                    <textarea name="short_description" id="short_description"  class="form-control" placeholder="Mô tả ngắn" cols="30" rows="10">{{$$LOWER_NAME$->short_description}}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="note">Ghi chú</label>
                    <textarea name="note" id="note"  class="form-control" placeholder="Ghi chú" cols="30" rows="10">{{$$LOWER_NAME$->note}}</textarea>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="ckfinder-input-image">Image</label>
                        <div class="input-group">
                            <input type="text" name="image" id="ckfinder-input-image" value="{{$$LOWER_NAME$->image}}"
                                   class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image" class="btn btn-primary">Chọn</a></span>
                        </div>
                    </div>
                    @if($$LOWER_NAME$->image)
                        <img src="{{$$LOWER_NAME$->image}}" width="100%" style="padding-top: 10px">
                    @endif
                </div>
                <div class="col-md-6 select2-primary">
                    <label class="form-label" for="hashtag">Hashtag</label>
                    <select id="hashtag" name="hashtag" class="select2 form-select" multiple>
                        <option value="en" @if($$LOWER_NAME$->hashtag == 'en') selected @endif>English</option>
                        <option value="fr" @if($$LOWER_NAME$->hashtag == 'fr') selected @endif>French</option>
                        <option value="de">German</option>
                        <option value="pt">Portuguese</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="description">Nội dung bài viết</label>
                    <textarea name="description" id="description"  class="form-control" placeholder="Nội dung bài viết" cols="30" rows="10">{{$$LOWER_NAME$->description}}</textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="source">Nguồn</label>
                    <input type="text" id="source" name="source" class="form-control" value="{{$$LOWER_NAME$->source}}" placeholder="Nguồn" />
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                <button type="reset" class="btn btn-label-secondary">Cancel</button>
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

    </script>
@endsection
@include('ckfinder::setup')

