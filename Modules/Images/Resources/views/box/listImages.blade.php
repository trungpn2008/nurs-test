<div class="box-input-list-image">
    <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
        <div class="card accordion-item active">
            <h2 class="accordion-header d-flex align-items-center">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-{{$count}}" aria-expanded="true">
                    <i class="bx bx-bar-chart-alt-2 me-2"></i>
                    <span class="title-list_image-box-{{$count}}">Box {{$count+1}}</span>
                </button>
                <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$count}}" data-boxinput="box-input-list-image" style="display: block;"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
            </h2>

            <div id="box-{{$count}}" class="accordion-collapse collapse show" style="padding: 10px 0;">
                <div class="container">
                    <input type="hidden" name="list_image[{{$count}}][type]" value="listImages">
                    <input type="hidden" name="list_image[{{$count}}][number]" value="{{$count}}">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label" for="title_list_image_{{$count}}">Tên </label>
                            <input type="text" id="title_list_image_{{$count}}" name="list_image[{{$count}}][title]" class="form-control" placeholder="Tên" />
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="subtitle_list_image_{{$count}}">Note </label>
                            <input type="text" id="note_list_image_{{$count}}" name="list_image[{{$count}}][note]" class="form-control" placeholder="note" value="" />
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="ckfinder-input-image-list_image-{{$count}}">Image</label>
                                <div class="input-group">
                                    <input type="text" name="list_image[{{$count}}][image]" id="ckfinder-input-image-list_image-{{$count}}" value=""
                                           class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-list_image-{{$count}}" class="btn btn-primary">Chọn</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                                <label class="form-label" for="check_{{$count}}">Check</label>
                                <div class="form-check form-switch mb-2" style="padding-top: 5px;">
                                    <input class="form-check-input" name="list_image[{{$count}}][check]" type="checkbox" id="check_{{$count}}" >
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
    $("#ckfinder-popup-image-list_image-{{$count}}").on('click',function () {
        selectFileWithCKFinder( 'ckfinder-input-image-list_image-{{$count}}' );
    })
    $('#title_list_image_{{$count}}').on('keyup',function () {
        $(".title-list_image-box-{{$count}}").text($(this).val());
    })
</script>

