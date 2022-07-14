@extends('Backend.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/libs/select2/select2.css" />
@endsection
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">Config /</span> General
    </h4>
    <div class="box-content">
        <div class="card mb-4">
            <h5 class="card-header">Config chung</h5>
            <form class="card-body" id="form-config-general" method="post" action="{{route('admin.config.updateHome',['type'=>$type])}}" enctype="application/x-www-form-urlencoded">
                @csrf
                <input type="hidden" name="type" value="config-general">
                <h6 class="fw-normal">1. Thông tin cấu hình</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="company_site">Tên site</label>
                        <input type="text" id="company_site" name="company_site" class="form-control" placeholder="Tên site" value="{{isset($value['company_site'])?$value['company_site']:''}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="company_trademark">Thương hiệu</label>
                        <input type="text" id="company_trademark" name="company_trademark" class="form-control" placeholder="Thương hiệu" value="{{isset($value['company_trademark'])?$value['company_trademark']:''}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="company_name">Công ty</label>
                        <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Công ty" value="{{isset($value['company_name'])?$value['company_name']:''}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="company_tax_number">Mã số thuế</label>
                        <input type="text" id="company_tax_number" name="company_tax_number" class="form-control" placeholder="Mã số thuế" value="{{isset($value['company_tax_number'])?$value['company_tax_number']:''}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="company_issue">Nơi cấp</label>
                        <input type="text" id="company_issue" name="company_issue" class="form-control" placeholder="Nơi cấp" value="{{isset($value['company_issue'])?$value['company_issue']:''}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="company_email">Email</label>
                        <input type="text" id="company_email" name="company_email" class="form-control" placeholder="Email" value="{{isset($value['company_email'])?$value['company_email']:''}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="company_phone">Phone</label>
                        <input type="text" id="company_phone" name="company_phone" class="form-control" placeholder="Phone" value="{{isset($value['company_phone'])?$value['company_phone']:''}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="company_address">Địa chỉ</label>
                        <input type="text" id="company_address" name="company_address" class="form-control" placeholder="Địa chỉ" value="{{isset($value['company_address'])?$value['company_address']:''}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="company_location">Vị trí</label>
                        <input type="text" id="company_location" name="company_location" class="form-control" placeholder="Vị trí" value="{{isset($value['company_location'])?$value['company_location']:''}}" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-recruitment_form">Mẫu đơn tuyển dụng</label>
                            <div class="input-group">
                                <input type="text" name="recruitment_form" id="ckfinder-input-recruitment_form" value="{{isset($value['recruitment_form'])?$value['recruitment_form']:''}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-recruitment_form" class="btn btn-primary">Chọn</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="iframe-view"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="company_description">Mô tả</label>
                        <textarea name="company_description" id="company_description" placeholder="Mô tả" cols="30" rows="5">{{isset($value['company_description'])?$value['company_description']:''}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Hot lines <a href="javascript:void(0);" class="btn btn-primary btn-add-js" data-type="hotline" data-boxinput="box-input-hotlines" data-boxadd="box-hotlines" style="padding: 0;"><i class="bx bx-plus"></i></a></label>
                        <div class="box-hotlines">
                            @if (isset($value['hotline']))
                                <?php $count_hotline= count($value['hotline']); ?>
                                @foreach ($value['hotline'] as $key => $item)
                                    <div class="box-input-hotlines">
                                        <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
                                            <div class="card accordion-item">
                                                <h2 class="accordion-header d-flex align-items-center">
                                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-hotline-{{$key}}" aria-expanded="true">
                                                        <i class="bx bx-bar-chart-alt-2 me-2"></i>
                                                        <span class="title-hotline-box-{{$key}}">{{isset($item['title'])?$item['title']:''}}</span>
                                                    </button>
                                                    <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$key}}" data-boxinput="box-input-hotlines" style="@if($count_hotline == ($key+1)) display: block; @else display: none; @endif"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
                                                </h2>

                                                <div id="box-hotline-{{$key}}" class="accordion-collapse collapse">
                                                    <div class="container">
                                                        <input type="hidden" name="hotline[{{$key}}][type]" value="hotline">
                                                        <input type="hidden" name="hotline[{{$key}}][number]" value="{{$key}}">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="title_hotline_{{$key}}">Tên </label>
                                                                <input type="text" id="title_hotline_{{$key}}" name="hotline[{{$key}}][title]" class="form-control" placeholder="Tên" value="{{isset($item['title'])?$item['title']:''}}" />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="phone_hotline_{{$key}}">SĐT </label>
                                                                <input type="text" id="phone_hotline_{{$key}}" name="hotline[{{$key}}][phone]" class="form-control" placeholder="SĐT" value="{{isset($item['phone'])?$item['phone']:''}}" />
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
                                        $('#title_hotline_{{$key}}').on('keyup',function () {
                                            $(".title-hotline-box-{{$key}}").text($(this).val());
                                        })
                                    </script>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Chi nhánh <a href="javascript:void(0);" class="btn btn-primary btn-add-js" data-type="branch" data-boxinput="box-input-branchs" data-boxadd="box-branchs" style="padding: 0;"><i class="bx bx-plus"></i></a></label>
                        <div class="box-branchs">
                            @if (isset($value['branch']))
                                <?php $count_branch= count($value['branch']); ?>
                                @foreach ($value['branch'] as $key => $item)
                                    <div class="box-input-branchs">
                                        <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
                                            <div class="card accordion-item">
                                                <h2 class="accordion-header d-flex align-items-center">
                                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-branch-{{$key}}" aria-expanded="true">
                                                        <i class="bx bx-bar-chart-alt-2 me-2"></i>
                                                        <span class="title-branch-box-{{$key}}">{{isset($item['title'])?$item['title']:''}}</span>
                                                    </button>
                                                    <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$key}}" data-boxinput="box-input-branchs" style="@if($count_branch == ($key+1)) display: block; @else display: none; @endif"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
                                                </h2>

                                                <div id="box-branch-{{$key}}" class="accordion-collapse collapse">
                                                    <div class="container">
                                                        <input type="hidden" name="branch[{{$key}}][type]" value="branch">
                                                        <input type="hidden" name="branch[{{$key}}][number]" value="{{$key}}">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="title_branch_{{$key}}">Tên </label>
                                                                <input type="text" id="title_branch_{{$key}}" name="branch[{{$key}}][title]" class="form-control" placeholder="Tên" value="{{isset($item['title'])?$item['title']:''}}" />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="phone_branch_{{$key}}">SĐT </label>
                                                                <input type="text" id="phone_branch_{{$key}}" name="branch[{{$key}}][phone]" class="form-control" placeholder="SĐT" value="{{isset($item['phone'])?$item['phone']:''}}" />
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label" for="address_branch_{{$key}}">Địa chỉ </label>
                                                                <input type="text" id="address_branch_{{$key}}" name="branch[{{$key}}][address]" class="form-control" placeholder="Địa chỉ" value="{{isset($item['address'])?$item['address']:''}}" />
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
                                        $('#title_branch_{{$key}}').on('keyup',function () {
                                            $(".title-branch-box-{{$key}}").text($(this).val());
                                        })
                                    </script>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Những con số <a href="javascript:void(0);" class="btn btn-primary btn-add-js" data-type="numbers" data-boxinput="box-input-numbers" data-boxadd="box-numbers" style="padding: 0;"><i class="bx bx-plus"></i></a></label>
                        <div class="box-numbers">
                            @if (isset($value['number']))
                                <?php $count_number= count($value['number']); ?>
                                @foreach ($value['number'] as $key => $item)
                                    <div class="box-input-numbers">
                                        <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
                                            <div class="card accordion-item">
                                                <h2 class="accordion-header d-flex align-items-center">
                                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-number-{{$key}}" aria-expanded="true">
                                                        <i class="bx bx-bar-chart-alt-2 me-2"></i>
                                                        <span class="title-number-box-{{$key}}">{{isset($item['title'])?$item['title']:''}}</span>
                                                    </button>
                                                    <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$key}}" data-boxinput="box-input-numbers" style="@if($count_number == ($key+1)) display: block; @else display: none; @endif"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
                                                </h2>

                                                <div id="box-number-{{$key}}" class="accordion-collapse collapse">
                                                    <div class="container">
                                                        <input type="hidden" name="number[{{$key}}][type]" value="number">
                                                        <input type="hidden" name="number[{{$key}}][number]" value="{{$key}}">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="title_number_{{$key}}">Tên </label>
                                                                <input type="text" id="title_number_{{$key}}" name="number[{{$key}}][title]" class="form-control" placeholder="Tên" value="{{isset($item['title'])?$item['title']:''}}" />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="subtitle_number_{{$key}}">Ký tự phụ </label>
                                                                <input type="text" id="subtitle_number_{{$key}}" name="number[{{$key}}][subtitle]" class="form-control" placeholder="Ký tự phụ" value="{{isset($item['subtitle'])?$item['subtitle']:''}}" />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="number_{{$key}}">Số </label>
                                                                <input type="text" id="number_{{$key}}" name="number[{{$key}}][numbers]" class="form-control" placeholder="số" value="{{isset($item['numbers'])?$item['numbers']:''}}" />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="ckfinder-input-image-number-{{$key}}">Image</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="number[{{$key}}][image]" id="ckfinder-input-image-number-{{$key}}" value="{{isset($item['image'])?$item['image']:''}}"
                                                                               class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-number-{{$key}}" class="btn btn-primary">Chọn</a></span>
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
                                        $("#ckfinder-popup-image-number-{{$key}}").on('click',function () {
                                            selectFileWithCKFinder( 'ckfinder-input-image-number-{{$key}}' );
                                        })
                                        $('#title_number_{{$key}}').on('keyup',function () {
                                            $(".title-number-box-{{$key}}").text($(this).val());
                                        })
                                    </script>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Giá trị công ty <a href="javascript:void(0);" class="btn btn-primary btn-add-js" data-type="valure" data-boxinput="box-input-valure" data-boxadd="box-valure" style="padding: 0;"><i class="bx bx-plus"></i></a></label>
                        <div class="box-valure">
                            @if (isset($value['valure']))
                                <?php $count_valure= count($value['valure']); ?>
                                @foreach ($value['valure'] as $key => $item)
                                    <div class="box-input-valure">
                                        <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
                                            <div class="card accordion-item">
                                                <h2 class="accordion-header d-flex align-items-center">
                                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-valure-{{$key}}" aria-expanded="true">
                                                        <i class="bx bx-bar-chart-alt-2 me-2"></i>
                                                        <span class="title-valure-box-{{$key}}">{{isset($item['title'])?$item['title']:''}}</span>
                                                    </button>
                                                    <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$key}}" data-boxinput="box-input-valure" style="@if($count_valure == ($key+1)) display: block; @else display: none; @endif"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
                                                </h2>

                                                <div id="box-valure-{{$key}}" class="accordion-collapse collapse">
                                                    <div class="container">
                                                        <input type="hidden" name="number[{{$key}}][type]" value="valure">
                                                        <input type="hidden" name="number[{{$key}}][number]" value="{{$key}}">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="title_valure_{{$key}}">Tên </label>
                                                                <input type="text" id="title_valure_{{$key}}" name="valure[{{$key}}][title]" class="form-control" placeholder="Tên" value="{{isset($item['title'])?$item['title']:''}}" />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="ckfinder-input-image-valure-{{$key}}">Icon image</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="valure[{{$key}}][image]" id="ckfinder-input-image-valure-{{$key}}" value="{{isset($item['image'])?$item['image']:''}}"
                                                                               class="form-control"><span class="input-group-btn">
                            <a id="ckfinder-popup-image-valure-{{$key}}" class="btn btn-primary">Chọn</a></span>
                                                                    </div>
                                                                    @if(isset($item['image']))
                                                                        <img src="{{$item['image']}}" width="100">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label" for="text_valure_{{$key}}">Mô tả </label>
{{--                                                                <input type="text" id="text_valure_{{$key}}" name="valure[{{$key}}][text]" class="form-control" placeholder="Mô tả" value="{{isset($item['text'])?$item['text']:''}}" />--}}
                                                                <textarea name="valure[{{$key}}][text]" id="text_valure_{{$key}}" class="form-control" placeholder="Mô tả" cols="30" rows="3">{{isset($item['text'])?$item['text']:''}}</textarea>
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
                                        $("#ckfinder-popup-image-valure-{{$key}}").on('click',function () {
                                            selectFileWithCKFinder( 'ckfinder-input-image-valure-{{$key}}' );
                                        })
                                        $('#title_valure_{{$key}}').on('keyup',function () {
                                            $(".title-valure-box-{{$key}}").text($(this).val());
                                        })
                                    </script>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dịch vụ <a href="javascript:void(0);" class="btn btn-primary btn-add-js" data-type="service" data-boxinput="box-input-service" data-boxadd="box-service" style="padding: 0;"><i class="bx bx-plus"></i></a></label>
                        <div class="box-service">
                            @if (isset($value['service']))
                                <?php $count_service= count($value['service']); ?>
                                @foreach ($value['service'] as $key => $item)
                                    <div class="box-input-service">
                                        <div class="accordion mt-3 accordion-header-primary" id="accordionWithIcon">
                                            <div class="card accordion-item">
                                                <h2 class="accordion-header d-flex align-items-center">
                                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#box-service-{{$key}}" aria-expanded="true">
                                                        <i class="bx bx-bar-chart-alt-2 me-2"></i>
                                                        <span class="title-service-box-{{$key}}">{{isset($item['title'])?$item['title']:''}}</span>
                                                    </button>
                                                    <a href="javascript:void(0);" class="remove-box btn-remove-box-{{$key}}" data-boxinput="box-input-service" style="@if($count_service == ($key+1)) display: block; @else display: none; @endif"><span class="badge badge-center rounded-pill bg-danger" style="padding: 10px"><i class="bx bx-x"></i></span></a>
                                                </h2>

                                                <div id="box-service-{{$key}}" class="accordion-collapse collapse">
                                                    <div class="container">
                                                        <input type="hidden" name="number[{{$key}}][type]" value="service">
                                                        <input type="hidden" name="number[{{$key}}][number]" value="{{$key}}">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="title_service_{{$key}}">Tên </label>
                                                                <input type="text" id="title_service_{{$key}}" name="service[{{$key}}][title]" class="form-control" placeholder="Tên" value="{{isset($item['title'])?$item['title']:''}}" />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="ckfinder-input-image-service-{{$key}}">Icon image</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="service[{{$key}}][image]" id="ckfinder-input-image-service-{{$key}}" value="{{isset($item['image'])?$item['image']:''}}"
                                                                               class="form-control"><span class="input-group-btn">
                            <a id="ckfinder-popup-image-service-{{$key}}" class="btn btn-primary">Chọn</a></span>
                                                                    </div>
                                                                    @if(isset($item['image']))
                                                                        <img src="{{$item['image']}}" width="100">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label" for="link_service_{{$key}}">Link </label>
                                                                <input type="text" id="link_service_{{$key}}" name="service[{{$key}}][link]" class="form-control" placeholder="Link" value="{{isset($item['link'])?$item['link']:''}}" />
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label" for="text_service_{{$key}}">Mô tả </label>
                                                                <input type="text" id="text_service_{{$key}}" name="service[{{$key}}][text]" class="form-control" placeholder="Mô tả" value="{{isset($item['text'])?$item['text']:''}}" />
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
                                        $("#ckfinder-popup-image-service-{{$key}}").on('click',function () {
                                            selectFileWithCKFinder( 'ckfinder-input-image-service-{{$key}}' );
                                        })
                                        $('#title_service_{{$key}}').on('keyup',function () {
                                            $(".title-service-box-{{$key}}").text($(this).val());
                                        })
                                    </script>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <h6 class="fw-normal">2. Hình ảnh</h6>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-image">Logo</label>
                            <div class="input-group">
                                <input type="text" name="logo" id="ckfinder-input-image" value="{{isset($value['logo'])?$value['logo']:''}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image" class="btn btn-primary">Chọn</a></span>
                            </div>
                        </div>
                        {{--                            <img src="{{$config->image}}" width="100%" style="padding-top: 10px">--}}
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-image-introduce">Ảnh Giới thiệu</label>
                            <div class="input-group">
                                <input type="text" name="image_introduce" id="ckfinder-input-image-introduce" value="{{isset($value['image_introduce'])?$value['image_introduce']:''}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-introduce" class="btn btn-primary">Chọn</a></span>
                            </div>
                        </div>
                        {{--                            <img src="{{$config->image}}" width="100%" style="padding-top: 10px">--}}
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-image-number">Ảnh Nền những con số</label>
                            <div class="input-group">
                                <input type="text" name="image_number" id="ckfinder-input-image-number" value="{{isset($value['image_number'])?$value['image_number']:''}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-number" class="btn btn-primary">Chọn</a></span>
                            </div>
                        </div>
                        {{--                            <img src="{{$config->image}}" width="100%" style="padding-top: 10px">--}}
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-image-footer">Ảnh Footer</label>
                            <div class="input-group">
                                <input type="text" name="image_footer" id="ckfinder-input-image-footer" value="{{isset($value['image_footer'])?$value['image_footer']:''}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-footer" class="btn btn-primary">Chọn</a></span>
                            </div>
                        </div>
                        {{--                            <img src="{{$config->image}}" width="100%" style="padding-top: 10px">--}}
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-image-page">Ảnh mặc định trang con</label>
                            <div class="input-group">
                                <input type="text" name="image_page" id="ckfinder-input-image-page" value="{{isset($value['image_page'])?$value['image_page']:''}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-page" class="btn btn-primary">Chọn</a></span>
                            </div>
                        </div>
                        {{--                            <img src="{{$config->image}}" width="100%" style="padding-top: 10px">--}}
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="text_image_page">Text phụ trang con</label>
                        <input type="text" id="text_image_page" name="text_image_page" class="form-control" placeholder="Phone" value="{{isset($value['text_image_page'])?$value['text_image_page']:''}}" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="ckfinder-input-image-bct">Ảnh đăng ký BCT</label>
                            <div class="input-group">
                                <input type="text" name="image_bct" id="ckfinder-input-image-bct" value="{{isset($value['image_bct'])?$value['image_bct']:''}}"
                                       class="form-control"><span class="input-group-btn">
                                <a id="ckfinder-popup-image-bct" class="btn btn-primary">Chọn</a></span>
                            </div>
                        </div>
                        {{--                            <img src="{{$config->image}}" width="100%" style="padding-top: 10px">--}}
                    </div>
                </div>
                <div class="row g-3">
                    <h6 class="fw-normal">3. Social</h6>
                    <div class="col-md-6">
                        <label class="form-label" for="facebook">Facebook</label>
                        <input type="text" name="facebook" id="facebook" placeholder="Facebook" class="form-control" value="{{isset($value['facebook'])?$value['facebook']:''}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="youtube">Youtube</label>
                        <input type="text" name="youtube" id="youtube" placeholder="Mô tả" class="form-control" value="{{isset($value['youtube'])?$value['youtube']:''}}" />
                    </div>
                </div>
                <div class="row g-3">
                    <h6 class="fw-normal">4. Nhúng</h6>
                    <div class="col-md-6">
                        <label class="form-label" for="company_description_footer">Nội dung Footer</label>
                        <textarea name="company_description_footer" id="company_description_footer" placeholder="Nội dung Footer" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="code_header">Mã nhúng header</label>
                        <textarea name="code_header" id="code_header" placeholder="Mã nhúng header" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="code_body">Mã nhúng body</label>
                        <textarea name="code_body" id="code_body" placeholder="Mã nhúng body" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="code_footer">Mã nhúng footer</label>
                        <textarea name="code_footer" id="code_footer" placeholder="Mã nhúng footer" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" form="form-config-general" class="btn btn-primary me-sm-3 me-1">Submit</button>
                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
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
    <script src="/libs/select2/select2.js"></script>
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
        $(".btn-add-js").on('click',function () {
            var type = $(this).data('type');
            var boxInput = $(this).data('boxinput');
            var boxadd = $(this).data('boxadd');
            var lengBoxInput = $('.'+boxInput).length;
            $.ajax({
                type: "get",
                dataType: "html",
                url: '{{ route("admin.config.ajax-get-box-config") }}',
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
        var mySec = 1000;
        var myEvent;
        $(document).ready(function () {
            if($("#company_location").val()){
                $(".iframe-view").html('<iframe src="'+GoogleMapsURLToEmbedURL($("#company_location").val())+'" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>')
            }
            $("#company_location").on('change',function (e) {
                clearTimeout(myEvent);
                url_location = $(this).val();
                myEvent = setTimeout(function(){
                    $(".iframe-view").html('<iframe src="'+GoogleMapsURLToEmbedURL(url_location)+'" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>');
                }, mySec);
            });
            function GoogleMapsURLToEmbedURL(GoogleMapsURL)
            {
                var coords = /\@([0-9\.\,\-a-zA-Z]*)/.exec(GoogleMapsURL);
                var coords2 = /\!1s([0-9a-zA-z\:\.\,]*)/.exec(GoogleMapsURL);
                if(coords!=null)
                {
                    var coordsArray = coords[1].split(',');
                    return "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.767410027492!2d"+coordsArray[1]+"!3d"+coordsArray[0]+"!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2"+coords2[0]+"!2sAsahi%20Japan!5e0!3m2!1svi!2s!4v1646939153883!5m2!1svi!2s";
                }
            }
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
        CKEDITOR.replace('company_description',editor_config);

        $("#ckfinder-popup-image").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-image' );
        })
        $("#ckfinder-popup-image-introduce").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-image-introduce' );
        })
        $("#ckfinder-popup-image-number").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-image-number' );
        })
        $("#ckfinder-popup-image-footer").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-image-footer' );
        })
        $("#ckfinder-popup-image-page").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-image-page' );
        })
        $("#ckfinder-popup-image-bct").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-image-bct' );
        })
        $("#ckfinder-popup-recruitment_form").on('click',function () {
            selectFileWithCKFinder( 'ckfinder-input-recruitment_form' );
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
        sidebarMenu('Config', 'index-general');
    </script>
@endsection
@include('ckfinder::setup')

