<div class="box-input-valure">
    <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
        <div class="card accordion-item active">
            <h2 class="accordion-header d-flex align-items-center">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-valure-{{$count}}" aria-expanded="true">
                    <i class="bx bx-bar-chart-alt-2 me-2"></i>
                    <span class="title-valure-box-{{$count}}">Box {{$count+1}}</span>
                </button>
                <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$count}}" data-boxinput="box-input-valure" style="display: block;"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
            </h2>

            <div id="box-valure-{{$count}}" class="accordion-collapse collapse show">
                <div class="container">
                    <input type="hidden" name="number[{{$count}}][type]" value="valure">
                    <input type="hidden" name="number[{{$count}}][number]" value="{{$count}}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="title_valure_{{$count}}">Tên </label>
                            <input type="text" id="title_valure_{{$count}}" name="valure[{{$count}}][title]" class="form-control" placeholder="Tên" />
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="ckfinder-input-image-valure-{{$count}}">Icon image</label>
                                <div class="input-group">
                                    <input type="text" name="valure[{{$count}}][image]" id="ckfinder-input-image-valure-{{$count}}" value=""
                                           class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-valure-{{$count}}" class="btn btn-primary">Chọn</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="text_valure_{{$count}}">Mô tả </label>
{{--                            <input type="text" id="text_valure_{{$count}}" name="valure[{{$count}}][text]" class="form-control" placeholder="Mô tả" />--}}
                            <textarea id="text_valure_{{$count}}" name="valure[{{$count}}][text]" class="form-control" placeholder="Mô tả"  cols="30" rows="3"></textarea>
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
    $("#ckfinder-popup-image-valure-{{$count}}").on('click',function () {
        selectFileWithCKFinder( 'ckfinder-input-image-valure-{{$count}}' );
    })
    $('#title_valure_{{$count}}').on('keyup',function () {
        $(".title-valure-box-{{$count}}").text($(this).val());
    })
</script>

