<div class="box-input-image-blueprint">
    <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
        <div class="card accordion-item active">
            <h2 class="accordion-header d-flex align-items-center">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-{{$count}}" aria-expanded="true">
                    <i class="bx bx-bar-chart-alt-2 me-2"></i>
                    <span class="title-blueprint-box-{{$count}}">Box {{$count+1}}</span>
                </button>
                <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$count}}" data-boxinput="box-input-image-blueprint" style="display: block;"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
            </h2>

            <div id="box-{{$count}}" class="accordion-collapse collapse show">
                <div class="container">
                    <input type="hidden" name="blueprint[{{$count}}][type]" value="Blueprint">
                    <input type="hidden" name="blueprint[{{$count}}][number]" value="{{$count}}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="title_blueprint_{{$count}}">Tên </label>
                            <input type="text" id="title_blueprint_{{$count}}" name="blueprint[{{$count}}][title]" class="form-control" placeholder="Tên" />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="blueprint_id_{{$count}}">Loại</label>
                            <div class="">
                                <select id="blueprint_id_{{$count}}" name="blueprint[{{$count}}][blueprint_id]" class="form-select" data-allow-clear="true">
                                    <option value="">Chọn loại</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label" for="arrange_{{$count}}">Sắp xếp </label>
                            <input type="number" id="arrange_{{$count}}" name="blueprint[{{$count}}][arrange]" class="form-control" placeholder="Tên" />
                        </div>
                        <div class="col-md-1">
                            <label class="form-label" for="status-{{$count}}">Trạng thái</label>
                            <div class="form-check form-switch mb-2" style="padding-top: 5px;">
                                <input class="form-check-input" name="blueprint[{{$count}}][status]" type="checkbox" id="status-{{$count}}" checked >
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label" for="ckfinder-input-image-blueprint-{{$count}}">Image</label>
                                <div class="input-group">
                                    <input type="text" name="blueprint[{{$count}}][image]" id="ckfinder-input-image-blueprint-{{$count}}" value=""
                                           class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-blueprint-{{$count}}" class="btn btn-primary">Chọn</a></span>
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
    CKEDITOR.replace('note_{{$count}}',editor_config);
    $("#ckfinder-popup-image-blueprint-{{$count}}").on('click',function () {
        selectFileWithCKFinder( 'ckfinder-input-image-blueprint-{{$count}}' );
    })
    $('#title_blueprint_{{$count}}').on('keyup',function () {
        $(".title-blueprint-box-{{$count}}").text($(this).val());
    })
    blueprintType({
        object: '#blueprint_id_{{$count}}',
        url: '{{ route("admin.blueprinttype.ajax-get") }}',
        data_id: 'id',
        data_text: 'text',
        title_default: 'Chọn loại'
    });

</script>

