<h6 class="fw-normal">2. Mô tả - Hình ảnh - Giới thiệu</h6>
<h6 class="fw-normal">I. Giá trị, Tầm nhìn, Sứ mệnh .... <a href="javascript:void(0);" class="btn btn-primary btn-add-values" data-type="values" data-boxinput="box-input-value" data-boxadd="info-values" style="padding: 0;"><i class="bx bx-plus"></i></a></h6>
<div class="box-values">
    <div class="info-values">
        @if($datas && isset($datas['values']))
            <?php $count_data= count($datas['values']); ?>
            @foreach ($datas['values'] as $key => $item)
                <div class="box-input-value">
                    <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
                        <div class="card accordion-item ">
                            <h2 class="accordion-header d-flex align-items-center">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-{{$key}}" aria-expanded="true">
                                    <i class="bx bx-bar-chart-alt-2 me-2"></i>
                                    <span class="title-box-{{$key}}">{{$item['title']}}</span>
                                </button>
                                <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$key}}" data-boxinput="box-input-value" style="@if($count_data == ($key+1)) display: block; @else display: none; @endif "><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
                            </h2>

                            <div id="box-{{$key}}" class="accordion-collapse collapse ">
                                <div class="container">
                                    <div class="row g-3">
                                        <div class="col-md-10">
                                            <label class="form-label" for="source">Tên </label>
                                            <input type="text" id="title_{{$key}}" name="introduce[values][{{$key}}][title]" class="form-control" placeholder="Tên" value="{{$item['title']}}" />
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label" for="source">Cỡ chữ tên</label>
                                            <input type="number" id="fontsize_{{$key}}" name="introduce[values][{{$key}}][fontsize]" class="form-control" placeholder="Cỡ chữ tên" value="{{$item['fontsize']}}" />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="note">Ghi chú</label>
                                            <textarea name="introduce[values][{{$key}}][note]" id="note_{{$key}}"  class="form-control" placeholder="Ghi chú" cols="30" rows="10">{{$item['note']}}</textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="note">Background</label>
                                            <input type="color" name="introduce[values][{{$key}}][bgcolor]" class="form-control" id="bgcolor" value="{{$item['bgcolor']}}" >
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="ckfinder-input-image">Icon image</label>
                                                <div class="input-group">
                                                    <input type="text" name="introduce[values][{{$key}}][image]" id="ckfinder-input-image-{{$key}}" value="{{$item['image']}}"
                                                           class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-{{$key}}" class="btn btn-primary">Chọn</a></span>
                                                </div>
                                                <div class="clearfix"></div>
                                                <img src="{{$item['image']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="note">Background icon</label>
                                            <input type="color" name="introduce[values][{{$key}}][bgcoloricon]" class="form-control" id="bgcoloricon" value="{{$item['bgcoloricon']}}" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    CKEDITOR.replace('note_{{$key}}',editor_config);
                    $("#ckfinder-popup-image-{{$key}}").on('click',function () {
                        selectFileWithCKFinder( 'ckfinder-input-image-{{$key}}' );
                    })
                    $('#title_{{$key}}').on('keyup',function () {
                        $(".title-box-{{$key}}").text($(this).val());
                    })
                </script>
            @endforeach
        @endif
    </div>
</div>
<h6 class="fw-normal">II. Sơ đồ tổ chức</h6>
<div class="box-treview">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label" for="ckfinder-input-image-introduce">Image</label>
            <div class="input-group">
                <input type="text" name="introduce[treeview]" id="ckfinder-input-image-introduce" value="{{$datas?$datas['treeview']:''}}"
                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-introduce" class="btn btn-primary">Chọn</a></span>
            </div>
            <div class="clearfix"></div>
            @if ($datas)
                <img src="{{$datas['treeview']}}" width="300">
            @endif

        </div>
    </div>
</div>
<h6 class="fw-normal">III. Sản phẩm</h6>
<div class="box-project">
    <div class="col-md-12">
        <label class="form-label" for="short_description">Mô tả sản phẩm</label>
        <textarea name="introduce[project]" id="short_description"  class="form-control" placeholder="Mô tả sản phẩm" cols="30" rows="10">{{$datas?$datas['project']:''}}</textarea>
    </div>
</div>
<h6 class="fw-normal">IV. Nguồn nhân lực</h6>
<div class="box-resource">
    <div class="col-md-12">
        <div class="col-md-12">
            <label class="form-label" for="description">Mô tả nguồn nhân lực</label>
            <textarea name="introduce[human_resource]" id="description"  class="form-control" placeholder="Nội dung bài viết" cols="30" rows="10">{{$datas?$datas['human_resource']:''}}</textarea>
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
    $(".btn-add-values").on('click',function () {
        var type = $(this).data('type');
        var boxInput = $(this).data('boxinput');
        var boxadd = $(this).data('boxadd');
        var lengBoxInput = $('.'+boxInput).length;
        $.ajax({
            type: "get",
            dataType: "html",
            url: '{{ route("admin.category.ajax-box") }}',
            data: {'type': type,'count':(lengBoxInput)},
            async: false,
            success: function (data) {
                if(data === 'false-load'){
                    // $('.'+boxadd).html('<h6 class="fw-normal">Loại box này chưa dựng data!</h6>');
                    // toastr.warning('Loại danh mục này không có dữ liệu thêm!');
                }else{
                    $(".remove-box").hide();
                    $(".box-input-value .accordion-item").removeClass('active');
                    $(".box-input-value .accordion-collapse").removeClass('show');
                    $('.'+boxadd).append(data);
                    toastr.success('Load dữ liệu thêm thành công!');
                }
            },
            error: function () {
                // _.alert(_.label("Unknown error."));
            }
        });
    });


    CKEDITOR.replace('description',editor_config);
    CKEDITOR.replace('short_description',editor_config);


    $("#ckfinder-popup-image-introduce").on('click',function () {
        selectFileWithCKFinder( 'ckfinder-input-image-introduce' );
    })

</script>
