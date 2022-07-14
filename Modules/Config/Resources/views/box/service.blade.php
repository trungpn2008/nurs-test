<div class="box-input-service">
    <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
        <div class="card accordion-item active">
            <h2 class="accordion-header d-flex align-items-center">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-service-{{$count}}" aria-expanded="true">
                    <i class="bx bx-bar-chart-alt-2 me-2"></i>
                    <span class="title-service-box-{{$count}}">Box {{$count+1}}</span>
                </button>
                <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$count}}" data-boxinput="box-input-service" style="display: block;"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
            </h2>

            <div id="box-service-{{$count}}" class="accordion-collapse collapse show">
                <div class="container">
                    <input type="hidden" name="number[{{$count}}][type]" value="service">
                    <input type="hidden" name="number[{{$count}}][number]" value="{{$count}}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="title_service_{{$count}}">Tên </label>
                            <input type="text" id="title_service_{{$count}}" name="service[{{$count}}][title]" class="form-control" placeholder="Tên" />
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="ckfinder-input-image-service-{{$count}}">Icon image</label>
                                <div class="input-group">
                                    <input type="text" name="service[{{$count}}][image]" id="ckfinder-input-image-service-{{$count}}" value=""
                                           class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-service-{{$count}}" class="btn btn-primary">Chọn</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="link_service_{{$count}}">Link </label>
                            <input type="text" id="link_service_{{$count}}" name="service[{{$count}}][link]" class="form-control" placeholder="Link" />
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="text_service_{{$count}}">Mô tả </label>
                            <input type="text" id="text_service_{{$count}}" name="service[{{$count}}][text]" class="form-control" placeholder="Mô tả" />
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
    $("#ckfinder-popup-image-service-{{$count}}").on('click',function () {
        selectFileWithCKFinder( 'ckfinder-input-image-service-{{$count}}' );
    })
    $('#title_service_{{$count}}').on('keyup',function () {
        $(".title-service-box-{{$count}}").text($(this).val());
    })
</script>

