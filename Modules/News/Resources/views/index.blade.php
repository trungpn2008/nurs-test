@extends('Backend.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/libs/select2/select2.css" />
@endsection
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">News /</span> List
    </h4>
    <div class="box-content">
        <div class="table-list-content">
            @if(in_array('news.add',isset($perms['News'])?$perms['News']:[]) || $super == 1)
                <a href="{{route('admin.news.add')}}" class="btn btn-primary"><i class="bx bx-plus me-sm-2"></i>Tạo bài viết</a>
            @endif
            <div class="box-search">
                <form action="" method="get" id="form-search">
                    <div class="row">
                        <div class="col-12 col-sm-11 col-md-11 col-lg-11 col-xl-11">
                            <div class="row">
                                <div class="form-group col-sm-3 col-12 p-lr-5">
                                    <input type="text" name="keyword" class="form-control" placeholder="Tiêu đề bài viết" value="{{isset($search['keyword'])?$search['keyword']:''}}">
                                </div>
                                <div class="form-group col-sm-3 col-12 p-lr-5">
                                    <select id="category_action" name="category" class="form-select" data-allow-clear="true">
                                        <option value="">Chọn danh mục</option>

                                        @if(isset($search['category']))
                                            <option value="{{$search['category']}}" selected="selected">{{isset($category)?$category->title:''}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                            <button type="submit" form="form-search" class="btn btn-warning" style="padding: 7px 14px;"><i class="fa fa-search"></i>&nbsp;&nbsp;Tìm kiếm</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive text-nowrap">
                <form action="{{route('admin.action')}}" method="post" id="form-index-action">
                    @csrf
                    <input type="hidden" name="method" value=""/>
                    <input type="hidden" name="status" value=""/>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Danh mục</th>
                            <th>Người tạo</th>
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        {{--                    @dd($news,$news->builder())--}}
                        {{--                    @dd($news)--}}
                        @if (count($news))
                            @foreach ($news as $key =>$item)
                                <tr>
                                    <td><img src="{{$item->image}}" alt="{{$item->title}}" width="96" height="54"></td>
                                    <td>
                                        @if(in_array('news.edit',isset($perms['News'])?$perms['News']:[]) || $super == 1)
                                            <a href="{{route('admin.news.edit',['id'=>$item->id])}}">{{$item->title}}</a>
                                        @else
                                            {{$item->title}}
                                        @endif
                                    </td>
                                    <td>{{$item->cate_name}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->arrange}}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Unactive</span>
                                        @endif
                                    </td>
                                    <td>{{date('d/m/Y H:i',strtotime($item->created_at))}}</td>
                                    <td>{{date('d/m/Y H:i',strtotime($item->updated_at))}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded"></i></button>
                                            <div class="dropdown-menu">
                                                @if(in_array('news.edit',isset($perms['News'])?$perms['News']:[]) || $super == 1)
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.news.edit',['id'=>$item->id])}}"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                @endif
                                                @if(in_array('news.delete',isset($perms['News'])?$perms['News']:[]) || $super == 1)
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.news.delete',['id'=>$item->id])}}"><i
                                                            class="bx bx-trash me-1"></i> Delete</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">Không có bản ghi nào</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>


                    <div class="row mbm">
                        <div class="col-sm-3">
                            <span class="record-total">Tổng: {{ $news->total() }} bản ghi</span>
                        </div>
                        <div class="col-sm-6 text-center">
                            <div class="pagination-panel">
                                {{ $news->appends(Request::all())->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                        <div class="col-sm-3 text-right">
                        <span class="form-inline">
                            Hiển thị
                            <select name="per_page" class="form-control" data-target="#form-index-action">
                                @php $list = [10, 20, 50, 100, 200] @endphp
                                @foreach ($list as $num)
                                    <option
                                        value="{{ $num }}" {{ $num == $per_page ? 'selected' : '' }}>{{ $num }}</option>
                                @endforeach
                            </select>
                        </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="/libs/select2/select2.js"></script>
    <script>
        $(document).ready(function () {
            get_categorys({
                object: '#category_action',
                url: '{{ route("admin.category.ajax-get-category").'?type=news' }}',
                data_id: 'id',
                data_text: 'text',
                title_default: 'Chọn danh mục'
            });
            function get_categorys(options) {
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
        sidebarMenu('News', 'index');
    </script>
@endsection

