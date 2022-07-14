<div class="box-input-value">
    <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
        <div class="card accordion-item active">
            <h2 class="accordion-header d-flex align-items-center">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-{{$count}}" aria-expanded="true">
                    <i class="bx bx-bar-chart-alt-2 me-2"></i>
                    <span class="title-box-{{$count}}">Box {{$count+1}}</span>
                </button>
                <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$count}}" data-boxinput="box-input-value" style="display: block;"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
            </h2>

            <div id="box-{{$count}}" class="accordion-collapse collapse show">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-md-10">
                            <label class="form-label" for="source">Tên </label>
                            <input type="text" id="title_{{$count}}" name="introduce[values][{{$count}}][title]" class="form-control" placeholder="Tên" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="source">Cỡ chữ tên</label>
                            <input type="number" id="fontsize_{{$count}}" name="introduce[values][{{$count}}][fontsize]" class="form-control" placeholder="Cỡ chữ tên" />
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="note">Ghi chú</label>
                            <textarea name="introduce[values][{{$count}}][note]" id="note_{{$count}}"  class="form-control" placeholder="Ghi chú" cols="30" rows="10"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="note">Background</label>
                            <input type="color" name="introduce[values][{{$count}}][bgcolor]" class="form-control" id="bgcolor" >
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="ckfinder-input-image-{{$count}}">Icon image</label>
                                <div class="input-group">
                                    <input type="text" name="introduce[values][{{$count}}][image]" id="ckfinder-input-image-{{$count}}" value=""
                                           class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-{{$count}}" class="btn btn-primary">Chọn</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="note">Background icon</label>
                            <input type="color" name="introduce[values][{{$count}}][bgcoloricon]" class="form-control" id="bgcoloricon" >
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
        $(this).closest('.box-input-value').remove();
        if(lengBoxInput >= 0){
            $('.btn-remove-box-'+lengBoxInput).show();
        }
    });
    CKEDITOR.replace('note_{{$count}}',editor_config);
    $("#ckfinder-popup-image-{{$count}}").on('click',function () {
        selectFileWithCKFinder( 'ckfinder-input-image-{{$count}}' );
    })
    $('#title_{{$count}}').on('keyup',function () {
        $(".title-box-{{$count}}").text($(this).val());
    })
</script>

