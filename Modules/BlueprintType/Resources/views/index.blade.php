@extends('Backend.layouts.master')

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">Blueprint Type /</span> List
    </h4>
    <div class="box-content">
        <div class="table-list-content">
            @if(in_array('blueprinttype.add',isset($perms['BlueprintType'])?$perms['BlueprintType']:[]) || $super == 1)
                <a href="{{route('admin.blueprinttype.add')}}" class="btn btn-primary"><i class="bx bx-plus me-sm-2"></i>Tạo blueprint type</a>
            @endif

            <div class="box-search">
                <form action="" method="get" id="form-search">
                    <div class="row">
                        <div class="col-12 col-sm-11 col-md-11 col-lg-11 col-xl-11">
                            <div class="form-group col-sm-3 col-12">
                                <input type="text" name="keyword" class="form-control" placeholder="Tiêu đề" value="{{isset($search['keyword'])?$search['keyword']:''}}">
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
                            <th>Stt</th>
                            <th>Tiêu đề</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @if (count($blueprinttypes))
                            @foreach ($blueprinttypes as $key =>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @if(in_array('blueprinttype.edit',isset($perms['BlueprintType'])?$perms['BlueprintType']:[]) || $super == 1)
                                            <a href="{{route('admin.blueprinttype.edit',['id'=>$item->id])}}">{{$item->title}}</a>
                                        @else
                                            {{$item->title}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Unactive</span>
                                        @endif</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded"></i></button>
                                            <div class="dropdown-menu">
                                                @if(in_array('blueprinttype.edit',isset($perms['BlueprintType'])?$perms['BlueprintType']:[]) || $super == 1)
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.blueprinttype.edit',['id'=>$item->id])}}"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                @endif
                                                @if(in_array('blueprinttype.delete',isset($perms['BlueprintType'])?$perms['BlueprintType']:[]) || $super == 1)
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.blueprinttype.delete',['id'=>$item->id])}}"><i
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
                            <span class="record-total">Tổng: {{ $blueprinttypes->total() }} bản ghi</span>
                        </div>
                        <div class="col-sm-6 text-center">
                            <div class="pagination-panel">
                                {{ $blueprinttypes->appends(Request::all())->onEachSide(1)->links('pagination::bootstrap-4') }}
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
    <script>
        sidebarMenu('BlueprintType', 'index');
    </script>
@endsection