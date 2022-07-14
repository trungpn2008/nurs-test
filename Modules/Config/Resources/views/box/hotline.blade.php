<div class="box-input-hotlines">
    <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
        <div class="card accordion-item active">
            <h2 class="accordion-header d-flex align-items-center">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-{{$count}}" aria-expanded="true">
                    <i class="bx bx-bar-chart-alt-2 me-2"></i>
                    <span class="title-hotline-box-{{$count}}">Box {{$count+1}}</span>
                </button>
                <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$count}}" data-boxinput="box-input-hotlines" style="display: block;"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
            </h2>

            <div id="box-{{$count}}" class="accordion-collapse collapse show">
                <div class="container">
                    <input type="hidden" name="hotline[{{$count}}][type]" value="hotline">
                    <input type="hidden" name="hotline[{{$count}}][number]" value="{{$count}}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="title_hotline_{{$count}}">Tên </label>
                            <input type="text" id="title_hotline_{{$count}}" name="hotline[{{$count}}][title]" class="form-control" placeholder="Tên" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="phone_hotline_{{$count}}">SĐT </label>
                            <input type="text" id="phone_hotline_{{$count}}" name="hotline[{{$count}}][phone]" class="form-control" placeholder="SĐT" />
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
    $('#title_hotline_{{$count}}').on('keyup',function () {
        $(".title-hotline-box-{{$count}}").text($(this).val());
    })
</script>

