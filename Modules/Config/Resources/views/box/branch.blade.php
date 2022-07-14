<div class="box-input-branchs">
    <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
        <div class="card accordion-item active">
            <h2 class="accordion-header d-flex align-items-center">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-{{$count}}" aria-expanded="true">
                    <i class="bx bx-bar-chart-alt-2 me-2"></i>
                    <span class="title-branch-box-{{$count}}">Box {{$count+1}}</span>
                </button>
                <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$count}}" data-boxinput="box-input-branchs" style="display: block;"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
            </h2>

            <div id="box-{{$count}}" class="accordion-collapse collapse show">
                <div class="container">
                    <input type="hidden" name="branch[{{$count}}][type]" value="branch">
                    <input type="hidden" name="branch[{{$count}}][number]" value="{{$count}}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="title_branch_{{$count}}">Tên </label>
                            <input type="text" id="title_branch_{{$count}}" name="branch[{{$count}}][title]" class="form-control" placeholder="Tên" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="phone_branch_{{$count}}">SĐT </label>
                            <input type="text" id="phone_branch_{{$count}}" name="branch[{{$count}}][phone]" class="form-control" placeholder="SĐT" />
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="address_branch_{{$count}}">Địa chỉ </label>
                            <input type="text" id="address_branch_{{$count}}" name="branch[{{$count}}][address]" class="form-control" placeholder="Địa chỉ" />
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
    $('#title_branch_{{$count}}').on('keyup',function () {
        $(".title-branch-box-{{$count}}").text($(this).val());
    })
</script>

