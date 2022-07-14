@extends('Backend.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/libs/select2/select2.css" />
@endsection
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">Projects /</span> Edit
    </h4>
    <div class="box-content">
        <div class="card mb-4">
            <h5 class="card-header">Sửa dự án</h5>
            <form class="card-body" id="form-project" method="post" action="" enctype="application/x-www-form-urlencoded">
                @csrf
                <h6 class="fw-normal">1. Thông tin cấu hình</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="title">Tiêu đề <span style="color: red">*</span></label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Tiêu đề" value="{{$projects->title}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="category_action_project">Danh mục <span style="color: red">*</span></label>
                        <div class="">
                            <select id="category_action_project" name="category_id" class="form-select" data-allow-clear="true">
                                <option value="">Chọn danh mục</option>
                                @if($projects->category_id)
                                    <option value="{{$projects->category_id}}" selected>{{$category->title}}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="address">Địa chỉ <span style="color: red">*</span></label>
                        <input type="text" id="address" name="address" class="form-control" placeholder="Địa chỉ" value="{{$projects->address}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="location_url">Link chỉ đường</label>
                        <input type="text" id="location_url" name="location_url" class="form-control" placeholder="Link chỉ đường" value="{{$projects->location_url}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="arrange">Sắp xếp</label>
                        <input type="text" id="arrange" name="arrange" class="form-control" placeholder="Sắp xếp" value="{{$projects->arrange}}" />
                    </div>
                    <div class="col-md-1">
                        <label class="form-label" for="hot">Hot</label>
                        <div class="form-check form-switch mb-2" style="padding-top: 5px;">
                            <input class="form-check-input" name="hot" type="checkbox" id="hot" @if($projects->hot == 1) checked @endif>
                        </div>
                    </div>
                    <hr class="my-4 mx-n4" />
                    <h6 class="fw-normal">2. Ưu đãi - ảnh dự án</h6>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-image">Ảnh dự án <span style="color: red">*</span></label>
                            <div class="input-group">
                                <input type="text" name="image" id="ckfinder-input-image" value="{{$projects->image}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image" class="btn btn-primary">Chọn</a></span>
                            </div>
                            @if (!empty($projects->image))
                                <img src="{{$projects->image}}" width="300">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-image-sale">Ảnh ưu đãi</label>
                            <div class="input-group">
                                <input type="text" name="image_sale" id="ckfinder-input-image-sale" value="{{\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Sale')}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-sale" class="btn btn-primary">Chọn</a></span>
                            </div>
                        </div>
                        @if (!empty(\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Sale')))
                            <img src="{{\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Sale')}}" width="300">
                        @endif
                    </div>
                    <hr class="my-4 mx-n4" />
                    <h6 class="fw-normal">3. Tổng quan</h6>
                    <div class="col-md-6">
                        <label class="form-label" for="info">Mô tả tổng quan</label>
                        <textarea name="info" id="info" class="form-control" placeholder="Mô tả tổng quan" cols="30" rows="10">{{$projects->info}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-image-info">Ảnh tổng quan</label>
                            <div class="input-group">
                                <input type="text" name="image_info" id="ckfinder-input-image-info" value="{{\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Overview')}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-info" class="btn btn-primary">Chọn</a></span>
                            </div>
                        </div>
                        @if (!empty(\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Overview')))
                            <img src="{{\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Overview')}}" width="300">
                        @endif
                    </div>
                    <hr class="my-4 mx-n4" />
                    <h6 class="fw-normal">4. Vị trí</h6>
                    <div class="col-md-6">
                        <label class="form-label" for="location">Mô tả vị trí</label>
                        <textarea name="location" id="location" class="form-control" placeholder="Mô tả vị trí" cols="30" rows="10">{{$projects->location}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-image-location">Ảnh vị trí</label>
                            <div class="input-group">
                                <input type="text" name="image_location" id="ckfinder-input-image-location" value="{{\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Location')}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-location" class="btn btn-primary">Chọn</a></span>
                            </div>
                        </div>
                        @if (!empty(\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Location')))
                            <img src="{{\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Location')}}" width="300">
                        @endif
                    </div>
                    <hr class="my-4 mx-n4" />
                    {{--                    @dd($project_data)--}}
                    <h6 class="fw-normal">5. Tiện ích <a href="javascript:void(0);" class="btn btn-primary btn-add-js" data-type="utilities" data-boxinput="box-input-image-ulitites" data-boxadd="box-image-utilities" style="padding: 0;"><i class="bx bx-plus"></i></a></h6>
                    <div class="col-md-12">
                        <div class="box-image-utilities">
                            @if(isset($project_data['utilities']))
                                <?php $count_utilities= count($project_data['utilities']); ?>
                                @foreach($project_data['utilities'] as $key => $item)
                                    <div class="box-input-image-ulitites">
                                        <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
                                            <div class="card accordion-item">
                                                <h2 class="accordion-header d-flex align-items-center">
                                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-utilities-{{$key}}" aria-expanded="true">
                                                        <i class="bx bx-bar-chart-alt-2 me-2"></i>
                                                        <span class="title-utilities-box-{{$key}}">{{$item['title']}}</span>
                                                    </button>
                                                    <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$key}}" data-boxinput="box-input-image-ulitites" style="@if($count_utilities == ($key+1)) display: block; @else display: none; @endif "><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
                                                </h2>

                                                <div id="box-utilities-{{$key}}" class="accordion-collapse collapse">
                                                    <div class="container">
                                                        <input type="hidden" name="utilities[{{$key}}][type]" value="Utilities">
                                                        <input type="hidden" name="utilities[{{$key}}][number]" value="{{$key}}">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="title_utilities_{{$key}}">Tên </label>
                                                                <input type="text" id="title_utilities_{{$key}}" name="utilities[{{$key}}][title]" class="form-control" placeholder="Tên" value="{{$item['title']}}" />
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label class="form-label" for="arrange_{{$key}}">Sắp xếp </label>
                                                                <input type="number" id="arrange_{{$key}}" name="utilities[{{$key}}][arrange]" class="form-control" placeholder="Tên" value="{{$item['arrange']}}" />
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-label" for="status-{{$key}}">Trạng thái</label>
                                                                <div class="form-check form-switch mb-2" style="padding-top: 5px;">
                                                                    <input class="form-check-input" name="utilities[{{$key}}][status]" type="checkbox" id="status-{{$key}}" @if(isset($item['status']) && $item['status'] == 'on') checked @endif >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="ckfinder-input-image-utilities-{{$key}}">Image</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="utilities[{{$key}}][image]" id="ckfinder-input-image-utilities-{{$key}}" value="{{\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Utilities',$key)}}"
                                                                               class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-utilities-{{$key}}" class="btn btn-primary">Chọn</a></span>
                                                                    </div>
                                                                    @if (!empty(\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Utilities',$key)))
                                                                        <img src="{{\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Utilities',$key)}}" width="300">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $("#ckfinder-popup-image-utilities-{{$key}}").on('click',function () {
                                            selectFileWithCKFinder( 'ckfinder-input-image-utilities-{{$key}}' );
                                        })
                                        $('#title_utilities_{{$key}}').on('keyup',function () {
                                            $(".title-utilities-box-{{$key}}").text($(this).val());
                                        })
                                    </script>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="utilities_left">Mô tả tiện ích</label>
                        <textarea name="utilities_left" id="utilities_left"  class="form-control" placeholder="Mô tả vị trí(trái)" cols="30" rows="10">{{$projects->utilities_left}}</textarea>
                    </div>
                    <div class="col-md-6 hidden">
                        <label class="form-label" for="utilities_right">Mô tả tiện ích(phải)</label>
                        <textarea name="utilities_right" id="utilities_right"  class="form-control" placeholder="Mô tả vị trí(phải)" cols="30" rows="10">{{$projects->utilities_right}}</textarea>
                    </div>
                    <hr class="my-4 mx-n4" />
                    <h6 class="fw-normal">6. Mặt bằng <a href="javascript:void(0);" class="btn btn-primary btn-add-js" data-type="blueprint" data-boxinput="box-input-image-blueprint" data-boxadd="box-image-blueprint" style="padding: 0;"><i class="bx bx-plus"></i></a></h6>
                    <div class="col-md-12">
                        <div class="box-image-blueprint">
                            @if(isset($project_data['blueprint']))
                                <?php $count_blueprint= count($project_data['blueprint']); ?>
                                @foreach($project_data['blueprint'] as $key => $item)
                                    <div class="box-input-image-blueprint">
                                        <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
                                            <div class="card accordion-item">
                                                <h2 class="accordion-header d-flex align-items-center">
                                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-blueprint-{{$key}}" aria-expanded="true">
                                                        <i class="bx bx-bar-chart-alt-2 me-2"></i>
                                                        <span class="title-blueprint-box-{{$key}}">{{$item['title']}}</span>
                                                    </button>
                                                    <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$key}}" data-boxinput="box-input-image-blueprint" style="@if($count_blueprint == ($key+1)) display: block; @else display: none; @endif"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
                                                </h2>

                                                <div id="box-blueprint-{{$key}}" class="accordion-collapse collapse">
                                                    <div class="container">
                                                        <input type="hidden" name="blueprint[{{$key}}][type]" value="Blueprint">
                                                        <input type="hidden" name="blueprint[{{$key}}][number]" value="{{$key}}">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="title_blueprint_{{$key}}">Tên </label>
                                                                <input type="text" id="title_blueprint_{{$key}}" name="blueprint[{{$key}}][title]" class="form-control" placeholder="Tên" value="{{$item['title']}}" />
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label" for="blueprint_id_{{$key}}">Loại</label>
                                                                <div class="">
                                                                    <select id="blueprint_id_{{$key}}" name="blueprint[{{$key}}][blueprint_id]" class="form-select" data-allow-clear="true">
                                                                        <option value="">Chọn loại</option>
                                                                        @foreach ($blueprinttype as $bt)
                                                                            <option value="{{$bt->id}}" @if ($bt->id == $item['blueprint_id']) selected @endif>{{$bt->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-label" for="arrange_{{$key}}">Sắp xếp </label>
                                                                <input type="number" id="arrange_{{$key}}" name="blueprint[{{$key}}][arrange]" class="form-control" placeholder="Tên" value="{{$item['arrange']}}" />
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-label" for="status-{{$key}}">Trạng thái</label>
                                                                <div class="form-check form-switch mb-2" style="padding-top: 5px;">
                                                                    <input class="form-check-input" name="blueprint[{{$key}}][status]" type="checkbox" id="status-{{$key}}"  @if(isset($item['status']) && $item['status'] == 'on') checked @endif >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="ckfinder-input-image-blueprint-{{$key}}">Image</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="blueprint[{{$key}}][image]" id="ckfinder-input-image-blueprint-{{$key}}" value="{{\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Blueprint',$key,$item['blueprint_id'])}}"
                                                                               class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-blueprint-{{$key}}" class="btn btn-primary">Chọn</a></span>
                                                                    </div>
                                                                    @if (!empty(\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Blueprint',$key,$item['blueprint_id'])))
                                                                        <img src="{{\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Blueprint',$key,$item['blueprint_id'])}}" width="300">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $("#ckfinder-popup-image-blueprint-{{$key}}").on('click',function () {
                                            selectFileWithCKFinder( 'ckfinder-input-image-blueprint-{{$key}}' );
                                        })
                                        $('#title_blueprint_{{$key}}').on('keyup',function () {
                                            $(".title-blueprint-box-{{$key}}").text($(this).val());
                                        })
                                    </script>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <hr class="my-4 mx-n4" />
                    <h6 class="fw-normal">7. Lý do chọn mua <a href="javascript:void(0);" class="btn btn-primary btn-add-js" data-type="reasonbuy" data-boxinput="box-input-reason-buy" data-boxadd="box-image-reason-buy" style="padding: 0;"><i class="bx bx-plus"></i></a></h6>
                    <div class="col-md-12">
                        <div class="box-image-reason-buy">
                            @if(isset($project_data['reasonbuy']))
                                <?php $count_reasonbuy= count($project_data['reasonbuy']); ?>
                                @foreach($project_data['reasonbuy'] as $key => $item)
                                    <div class="box-input-reason-buy">
                                        <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
                                            <div class="card accordion-item">
                                                <h2 class="accordion-header d-flex align-items-center">
                                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-reasonbuy-{{$key}}" aria-expanded="true">
                                                        <i class="bx bx-bar-chart-alt-2 me-2"></i>
                                                        <span class="title-box-{{$key}}">Box {{$key+1}}</span>
                                                    </button>
                                                    <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$key}}" data-boxinput="box-input-reason-buy" style="@if($count_reasonbuy == ($key+1)) display: block; @else display: none; @endif"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
                                                </h2>

                                                <div id="box-reasonbuy-{{$key}}" class="accordion-collapse collapse">
                                                    <div class="container">
                                                        <div class="row g-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label" for="title_{{$key}}">Nội dung</label>
                                                                <textarea name="reasonbuy[{{$key}}][title]" id="title_{{$key}}" class="form-control" placeholder="Nội dung" cols="30" rows="3">{{$item['title']}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <hr class="my-4 mx-n4" />
                    <h6 class="fw-normal">8. Thứ viện ảnh <a href="javascript:void(0);" class="btn btn-primary btn-add-js" data-type="imagelib" data-boxinput="box-input-image-library" data-boxadd="box-image-library" style="padding: 0;"><i class="bx bx-plus"></i></a></h6>
                    <div class="col-md-12">
                        <div class="box-image-library">
                            @if(isset($project_data['library']))
                                <?php $count_library= count($project_data['library']); ?>
                                @foreach($project_data['library'] as $key => $item)
                                    <div class="box-input-image-library">
                                        <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
                                            <div class="card accordion-item">
                                                <h2 class="accordion-header d-flex align-items-center">
                                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-library-{{$key}}" aria-expanded="true">
                                                        <i class="bx bx-bar-chart-alt-2 me-2"></i>
                                                        <span class="title-imagelib-box-{{$key}}">{{$item['title']}}</span>
                                                    </button>
                                                    <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$key}}" data-boxinput="box-input-image-library" style="@if($count_library == ($key+1)) display: block; @else display: none; @endif"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
                                                </h2>

                                                <div id="box-library-{{$key}}" class="accordion-collapse collapse">
                                                    <div class="container">
                                                        <input type="hidden" name="library[{{$key}}][type]" value="Library">
                                                        <input type="hidden" name="library[{{$key}}][number]" value="{{$key}}">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="title_imagelib_{{$key}}">Tên </label>
                                                                <input type="text" id="title_imagelib_{{$key}}" name="library[{{$key}}][title]" class="form-control" placeholder="Tên" value="{{$item['title']}}" />
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label class="form-label" for="arrange_{{$key}}">Sắp xếp </label>
                                                                <input type="number" id="arrange_{{$key}}" name="library[{{$key}}][arrange]" class="form-control" placeholder="Tên" value="{{$item['arrange']}}" />
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-label" for="status-{{$key}}">Trạng thái</label>
                                                                <div class="form-check form-switch mb-2" style="padding-top: 5px;">
                                                                    <input class="form-check-input" name="library[{{$key}}][status]" type="checkbox" id="status-{{$key}}" @if(isset($item['status']) && $item['status'] == 'on') checked @endif >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="ckfinder-input-image-library-{{$key}}">Image</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="library[{{$key}}][image]" id="ckfinder-input-image-library-{{$key}}" value="{{\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Library',$key)}}"
                                                                               class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-library-{{$key}}" class="btn btn-primary">Chọn</a></span>
                                                                    </div>
                                                                    @if (!empty(\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Library',$key)))
                                                                        <img src="{{\Modules\Projects\Http\Controllers\ProjectsController::getImage($projects->id,'Library',$key)}}" width="300">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $("#ckfinder-popup-image-library-{{$key}}").on('click',function () {
                                            selectFileWithCKFinder( 'ckfinder-input-image-library-{{$key}}' );
                                        })
                                        $('#title_imagelib_{{$key}}').on('keyup',function () {
                                            $(".title-imagelib-box-{{$key}}").text($(this).val());
                                        })
                                    </script>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" form="form-project" class="btn btn-primary me-sm-3 me-1">Submit</button>
                    <a href="{{route('admin.projects.index')}}" class="btn btn-label-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="/libs/cleavejs/cleave.js"></script>
    <script src="/libs/cleavejs/cleave-phone.js"></script>
    <script src="/libs/moment/moment.js"></script>
    <script src="/libs/flatpickr/flatpickr.js"></script>
    <script src="/js/form-layouts.js"></script>
    <script src="/js/ckfinder/ckfinder.js"></script>
    <script src="/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
    <script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>
    <script>
        $(".remove-box").on('click',function () {
            var boxInput = $(this).data('boxinput');
            var lengBoxInput = $('.'+boxInput).length - 2;
            $(this).closest('.'+boxInput).remove();
            if(lengBoxInput >= 0){
                $('.'+boxInput+' .btn-remove-box-'+lengBoxInput).show();
            }
        });
        $(document).ready(function () {
            getCategorys({
                object: '#category_action_project',
                url: '{{ route("admin.category.ajax-get-category").'?type=project' }}',
                data_id: 'id',
                data_text: 'text',
                title_default: 'Chọn danh mục'
            });
            function getCategorys(options) {
                $(options.object).select2({
                    ajax: {
                        url: options.url,
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                keyword: params.term,
                            }
                            return query;
                        },
                        processResults: function(json, params) {
                            var results = [{
                                id: '',
                                text: options.title_default
                            }];

                            for (i in json.data) {
                                var item = json.data[i];
                                results.push({
                                    id: item[options.data_id],
                                    text: item[options.data_text]
                                });
                            }
                            return {
                                results: results,
                            };
                        },
                        minimumInputLength: 3,
                    }
                });
            }
        });

        $(".btn-add-js").on('click',function () {
            var type = $(this).data('type');
            var boxInput = $(this).data('boxinput');
            var boxadd = $(this).data('boxadd');
            var lengBoxInput = $('.'+boxInput).length;
            $.ajax({
                type: "get",
                dataType: "html",
                url: '{{ route("admin.projects.ajax-get-box") }}',
                data: {'type': type,'count':(lengBoxInput)},
                async: false,
                success: function (data) {
                    if(data === 'false-load'){
                        // $('.'+boxadd).html('<h6 class="fw-normal">Loại box này chưa dựng data!</h6>');
                        // toastr.warning('Loại danh mục này không có dữ liệu thêm!');
                    }else{
                        $("."+boxInput+" .remove-box").hide();
                        $("."+boxInput+" .accordion-item").removeClass('active');
                        $("."+boxInput+" .accordion-collapse").removeClass('show');
                        $('.'+boxadd).append(data);
                        toastr.success('Load dữ liệu thêm thành công!');
                    }
                },
                error: function () {
                    // _.alert(_.label("Unknown error."));
                }
            });
        });

        var editor_config = {
            language: 'vi',
            removeButtons : 'Underline,Subscript,Superscript',

            // Set the most common block elements.
            format_tags : 'p;h1;h2;h3;pre',

            // Simplify the dialog windows.
            removeDialogTabs : 'image:advanced;link:advanced',
            fillEmptyBlocks : false,
            tabSpaces : 0,
            forcePasteAsPlainText : true,
            basicEntities : false,
            entities_latin : false,
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
            {{--filebrowserImageBrowseUrl: "{{ route('ckfinder_browser') }}?type=Images",--}}
            {{--filebrowserFlashBrowseUrl: "{{ route('ckfinder_browser') }}?type=Flash",--}}
            {{--filebrowserUploadUrl     : "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files",--}}
            {{--filebrowserImageUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Images",--}}
            {{--filebrowserFlashUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Flash",--}}
            {{--        filebrowserBrowseUrl: '{{ url('/kcfinder/browse.php?type=image') }}',--}}

        };
        CKEDITOR.replace('utilities_left',editor_config);
        CKEDITOR.replace('utilities_right',editor_config);
        CKEDITOR.replace('info',editor_config);
        CKEDITOR.replace('location',editor_config);

        $("#ckfinder-popup-image").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-image' );
        })
        $("#ckfinder-popup-image-sale").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-image-sale' );
        })
        $("#ckfinder-popup-image-location").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-image-location' );
        })
        $("#ckfinder-popup-image-info").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-image-info' );
        })
        function selectFileWithCKFinder( elementId ) {
            CKFinder.modal( {
                chooseFiles: true,
                top:200,
                width: 800,
                height: 600,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files.first();
                        var output = $("#"+elementId);
                        output.val(file.getUrl()) ;
                    } );

                    finder.on( 'file:choose:resizedImage', function( evt ) {
                        var output = $("#"+elementId);
                        output.val(evt.data.resizedUrl);
                    } );
                }
            } );
        }
        function blueprintType(options) {
            $(options.object).select2({
                ajax: {
                    url: options.url,
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            keyword: params.term,
                        }
                        return query;
                    },
                    processResults: function(json, params) {
                        var results = [{
                            id: '',
                            text: options.title_default
                        }];

                        for (i in json.data) {
                            var item = json.data[i];
                            results.push({
                                id: item[options.data_id],
                                text: item[options.data_text]
                            });
                        }
                        return {
                            results: results,
                        };
                    },
                    minimumInputLength: 3,
                }
            });
        }
        const formAuthentication = document.querySelector('#form-project');

        document.addEventListener('DOMContentLoaded', function (e) {
            (function () {
                // Form validation for Add new record
                if (formAuthentication) {
                    const fv = FormValidation.formValidation(formAuthentication, {
                        fields: {
                            title: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter title'
                                    },
                                    stringLength: {
                                        min: 6,

                                        message: 'The title must be more than 6 and less than 255 characters long'
                                    }
                                }
                            },
                            category_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please select your category id'
                                    }
                                }
                            },
                            address: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter address'
                                    },
                                    stringLength: {
                                        min: 6,
                                        max:255,
                                        message: 'The address must be more than 6 and less than 255 characters long'
                                    }
                                }
                            },
                            image: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter image'
                                    }
                                }
                            },
                            // image_sale: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: 'Please enter image_sale'
                            //         }
                            //     }
                            // },
                            // info: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: 'Please enter info'
                            //         }
                            //     }
                            // },
                            // image_info: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: 'Please enter image info'
                            //         }
                            //     }
                            // },
                            // location: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: 'Please enter location'
                            //         }
                            //     }
                            // },
                            // image_location: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: 'Please enter image location'
                            //         }
                            //     }
                            // },
                            // utilities_left: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: 'Please enter utilities left'
                            //         }
                            //     }
                            // },
                            // utilities_right: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: 'Please enter utilities right'
                            //         }
                            //     }
                            // }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap5: new FormValidation.plugins.Bootstrap5({
                                // Use this for enabling/changing valid/invalid class
                                // eleInvalidClass: '',
                                eleValidClass: '',
                                rowSelector: function (field, ele) {
                                    // field is the field name & ele is the field element
                                    switch (field) {
                                        case 'title':
                                        case 'category_id':
                                        case 'address':
                                        case 'image':
                                        // case 'image_sale':
                                        case 'info':
                                        case 'image_info':
                                        case 'location':
                                        // case 'image_location':
                                        case 'utilities_left':
                                        case 'utilities_right':
                                        default:
                                            return '.row';
                                    }
                                }
                            }),
                            submitButton: new FormValidation.plugins.SubmitButton(),
                            // Submit the form when all fields are valid
                            defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                            autoFocus: new FormValidation.plugins.AutoFocus()
                        },
                        init: instance => {
                            instance.on('plugins.message.placed', function (e) {
                                //* Move the error message out of the `input-group` element
                                if (e.element.parentElement.classList.contains('input-group')) {
                                    // `e.field`: The field name
                                    // `e.messageElement`: The message element
                                    // `e.element`: The field element
                                    e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                                }
                                //* Move the error message out of the `row` element for custom-options
                                if (e.element.parentElement.parentElement.classList.contains('custom-option')) {
                                    e.element.closest('.row').insertAdjacentElement('afterend', e.messageElement);
                                }
                            });
                        }
                    });
                }
            })();
        });
        sidebarMenu('Projects', 'add');
    </script>
@endsection
@include('ckfinder::setup')
