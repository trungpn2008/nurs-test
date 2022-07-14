<div class="box-input-numbers">
    <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
        <div class="card accordion-item active">
            <h2 class="accordion-header d-flex align-items-center">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-{{$count}}" aria-expanded="true">
                    <i class="bx bx-bar-chart-alt-2 me-2"></i>
                    <span class="title-number-box-{{$count}}">Box {{$count+1}}</span>
                </button>
                <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$count}}" data-boxinput="box-input-numbers" style="display: block;"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
            </h2>

            <div id="box-{{$count}}" class="accordion-collapse collapse show">
                <div class="container">
                    <input type="hidden" name="number[{{$count}}][type]" value="number">
                    <input type="hidden" name="number[{{$count}}][number]" value="{{$count}}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="title_number_{{$count}}">Tên </label>
                            <input type="text" id="title_number_{{$count}}" name="number[{{$count}}][title]" class="form-control" placeholder="Tên" />
                        </div><div class="col-md-6">
                            <label class="form-label" for="subtitle_number_{{$count}}">Ký tự phụ </label>
                            <input type="text" id="subtitle_number_{{$count}}" name="number[{{$count}}][subtitle]" class="form-control" placeholder="Ký tự phụ" value="" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="number_{{$count}}">Số </label>
                            <input type="text" id="number_{{$count}}" name="number[{{$count}}][numbers]" class="form-control" placeholder="số" />
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="ckfinder-input-image-number-{{$count}}">Image</label>
                                <div class="input-group">
                                    <input type="text" name="number[{{$count}}][image]" id="ckfinder-input-image-number-{{$count}}" value=""
                                           class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-number-{{$count}}" class="btn btn-primary">Chọn</a></span>
                                </div>
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
    $("#ckfinder-popup-image-number-{{$count}}").on('click',function () {
        selectFileWithCKFinder( 'ckfinder-input-image-number-{{$count}}' );
    })
    $('#title_number_{{$count}}').on('keyup',function () {
        $(".title-number-box-{{$count}}").text($(this).val());
    })
</script>

