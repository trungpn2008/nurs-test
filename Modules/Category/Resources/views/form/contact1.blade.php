<h6 class="fw-normal">2. Mô tả - Hình ảnh - Liên hệ</h6>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="short_description">Mô tả ngắn</label>
        <textarea name="short_description" id="short_description"  class="form-control" placeholder="Mô tả ngắn" cols="30" rows="10"></textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="note">Ghi chú</label>
        <textarea name="note" id="note"  class="form-control" placeholder="Ghi chú" cols="30" rows="10"></textarea>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="ckfinder-input-image">Image</label>
            <div class="input-group">
                <input type="text" name="image" id="ckfinder-input-image" value=""
                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image" class="btn btn-primary">Chọn</a></span>
            </div>
        </div>

    </div>
    <div class="col-md-6 select2-primary">
        <label class="form-label" for="hashtag">Hashtag</label>
        <select id="hashtag" name="hashtag" class="select2 form-select" multiple>
            <option value="en" selected>English</option>
            <option value="fr" selected>French</option>
            <option value="de">German</option>
            <option value="pt">Portuguese</option>
        </select>
    </div>
    <div class="col-md-12">
        <label class="form-label" for="description">Nội dung bài viết</label>
        <textarea name="description" id="description"  class="form-control" placeholder="Nội dung bài viết" cols="30" rows="10"></textarea>
    </div>
    <div class="col-md-12">
        <label class="form-label" for="source">Nguồn</label>
        <input type="text" id="source" name="source" class="form-control" placeholder="Nguồn" />
    </div>
</div>
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
</script>
