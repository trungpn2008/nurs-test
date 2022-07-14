<h6 class="fw-normal">2. Mô tả - Hình ảnh - Tuyển dụng</h6>
<h6 class="fw-normal">I. Đào tạo và phát triển</h6>
<div class="box-training">
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label" for="short_description">Mô tả ngắn</label>
            <textarea name="recruitment[short_description]" id="short_description"  class="form-control" placeholder="Mô tả ngắn" cols="30" rows="10">{{$datas?$datas['short_description']:''}}</textarea>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="ckfinder-input-environment">Image</label>
                <div class="input-group">
                    <input type="text" name="recruitment[image]" id="ckfinder-input-environment" value="{{$datas?$datas['image']:''}}"
                           class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-environment" class="btn btn-primary">Chọn</a></span>
                </div>
                @if (isset($datas['image']))
                    <img src="{{$datas['image']}}" width="300">
                @endif
            </div>

        </div>
    </div>
</div>
<h6 class="fw-normal">I. Môi trường làm việc <a href="javascript:void(0);" class="btn btn-primary btn-add-environment" data-type="recruitment" data-boxinput="box-input-environment" data-boxadd="info-environment" style="padding: 0;"><i class="bx bx-plus"></i></a></h6>
<div class="box-environment">
    <div class="info-environment">
        @if(isset($datas['environment']))
            <?php $count_data= count($datas['environment']); ?>
            @foreach ($datas['environment'] as $key => $item)
                <div class="box-input-environment">
                    <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
                        <div class="card accordion-item">
                            <h2 class="accordion-header d-flex align-items-center">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-{{$key}}" aria-expanded="true">
                                    <i class="bx bx-bar-chart-alt-2 me-2"></i>
                                    <span class="title-box-{{$key}}">{{$item['title']}}</span>

                                </button>
                                <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$key}}" data-boxinput="box-input-environment" style="@if($count_data == ($key+1)) display: block; @else display: none; @endif "><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
                            </h2>

                            <div id="box-{{$key}}" class="accordion-collapse collapse">
                                <div class="container">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="source">Tên </label>
                                            <input type="text" id="title_{{$key}}" name="recruitment[environment][{{$key}}][title]" class="form-control" placeholder="Tên" value="{{$item['title']}}" />
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="ckfinder-input-image-{{$key}}">Icon image</label>
                                                <div class="input-group">
                                                    <input type="text" name="recruitment[environment][{{$key}}][image]" id="ckfinder-input-image-{{$key}}" value="{{$item['image']}}"
                                                           class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-{{$key}}" class="btn btn-primary">Chọn</a></span>
                                                </div>
                                                @if ($item['image'])
                                                    <img src="{{$item['image']}}" width="30">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="note">Mô tả</label>
                                            <textarea name="recruitment[environment][{{$key}}][note]" id="note_{{$key}}"  class="form-control" placeholder="Ghi chú" cols="30" rows="10">{{$item['note']}}</textarea>
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
    <div class="row g-3">
        <div class="col-md-12">
            <label class="form-label" for="short_environment">Mô tả ngắn</label>
            <textarea name="recruitment[short_environment]" id="short_environment"  class="form-control" placeholder="Mô tả ngắn" cols="30" rows="10">{{$datas?$datas['short_environment']:''}}</textarea>
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
    $(".btn-add-environment").on('click',function () {
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
                    $(".box-input-environment .accordion-item").removeClass('active');
                    $(".box-input-environment .accordion-collapse").removeClass('show');
                    $('.'+boxadd).append(data);
                    toastr.success('Load dữ liệu thêm thành công!');
                }
            },
            error: function () {
                // _.alert(_.label("Unknown error."));
            }
        });
    });

    CKEDITOR.replace('short_description',editor_config);
    CKEDITOR.replace('short_environment',editor_config);

    $("#ckfinder-popup-image-environment").on('click',function () {
        selectFileWithCKFinder( 'ckfinder-input-environment' );
    })
</script>
