@extends('Backend.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/libs/select2/select2.css" />
@endsection
@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">Roles /</span> List
    </h4>
    <div class="box-content">
        <div class="card mb-4">
        <h5 class="card-header">Sửa quyền</h5>
        <form class="card-body" id="form-roles" method="post" action="" enctype="application/x-www-form-urlencoded">
            @csrf
            <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#info" aria-controls="navs-justified-home" aria-selected="true">Info</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#permission" aria-controls="navs-justified-profile" aria-selected="false">Permission</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#user-permission" aria-controls="navs-justified-messages" aria-selected="false">User permission <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1">3</span></button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="info" role="tabpanel">
                        <h6 class="fw-normal">1. Thông tin cấu hình</h6>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="title">Tiêu đề</label>
                                <input type="text" id="title" name="title" class="form-control" placeholder="Tiêu đề" value="{{$role->title}}" />
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="prioritized">Ưu tiên</label>
                                <input type="number" id="prioritized" name="prioritized" class="form-control" placeholder="Ưu tiên" value="{{$role->prioritized}}" />
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="description">Mô tả</label>
                                <textarea name="description" id="description"  class="form-control" placeholder="Mô tả" cols="30" rows="10">{{$role->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="permission" role="tabpanel">
                        <h5>Role Permissions</h5>
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody class="data-role-permission">
                                <tr>
                                    <td class="text-nowrap">Administrator Access <i class="bx bx-info-circle bx-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system"></i></td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAll" />
                                            <label class="form-check-label" for="selectAll">
                                                Select All
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @foreach ($permissions as $key => $item)
                                    <tr>
                                        <td class="text-nowrap">{{$key}}</td>
                                        <td>
                                            <div class="d-flex">
                                                @foreach ($item as $item2)
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox" id="{{$item2['action']}}" name="permission[{{$key}}][]" value="{{$item2['action']}}" @if (isset($selectPermissions[$key]) && in_array($item2['action'],$selectPermissions[$key]) == true))
                                                            checked="checked"
                                                        @endif />
                                                        <label class="form-check-label" for="{{$item2['action']}}">
                                                            {{$item2['title']}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="user-permission" role="tabpanel">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="user_action">Nhân viên</label>
                                <select id="user_action" data-role="{{$id}}">
                                    <option value="">Tìm kiếm theo tên hoặc email nhân viên</option>
                                </select>
                            </div>
                        </div>
                        <h5 class="mt-4">Nhân viên</h5>
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <thead>
                                    <tr>
                                        <th>Nhân viên</th>
                                        <th>Email</th>
                                        <th>Quyền thêm</th>
                                        <th>Phân quyền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($UserRolePermissions as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>@if (empty($item->permission))
                                                    <span class="badge rounded-pill bg-danger">No</span>
                                                @else
                                                    <span class="badge rounded-pill bg-success">Yes</span>
                                            @endif</td>
                                            <td>
                                                <a href="javascript:void(0);" data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn-user-permission" data-id="{{$item->urp_id}}"><i class="bx bx-copy"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1" form="form-roles">Submit</button>
                <a href="{{route('admin.roles.index')}}" class="btn btn-label-secondary">Back</a>
            </div>
            <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                    <div class="modal-content p-3 p-md-5">
                        <button type="button" class="btn-close btn-pinned btn-close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-body">
                            <div class="text-center mb-4">
                                <h3 class="role-title">Append permission</h3>
                                <p>Set append role user permissions</p>
                            </div>
                            <div class="form-add-role-user">

                            </div>

                        </div>
                    </div>
                </div>
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
        $(document).ready(function () {
            get_users({
                object: '#user_action',
                url: '{{ route("admin.roles.ajax-get-users") }}',
                data_id: 'id',
                data_text: 'text',
                title_default: 'Chọn nhân viên'
            });
            function get_users(options) {
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
            $('#user_action').on("select2:selecting", function(e) {
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: '{{ route("admin.roles.ajax-add-role-user") }}',
                    data: {"_token": "{{ csrf_token() }}", 'role': $(this).data('role'),'user':e.params.args.data.id},
                    async: false,
                    success: function (data) {
                        if(data.success === true){
                            toastr.success(data.msg);
                        }else{
                            toastr.error(data.msg);
                        }
                    },
                    error: function () {
                        // _.alert(_.label("Unknown error."));
                    }
                });
                // console.log(e.params.args.data.id,$(this).data('role'),$(this).data('rolepermission'));
            });

            $('.btn-user-permission').click(function() {
                var id = $(this).data('id');
                $.get('{{ route('admin.roles.ajax-form-role-user-permission') }}', {
                    id: id,
                }, function(data) {
                    console.log(data);
                    $('.form-add-role-user').html(data);
                });
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
        CKEDITOR.replace('description',editor_config);
        const formAuthentication = document.querySelector('#form-roles');

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
                                        min: 3,
                                        max:255,
                                        message: 'The title must be more than 3 and less than 255 characters long'
                                    }
                                }
                            },
                            prioritized: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter your prioritized'
                                    },
                                    stringLength: {
                                        min: 1,
                                        message: 'The title must be more than 1'
                                    },
                                    regexp: {
                                        regexp: /^[0-9]+$/,
                                        message: 'The title can only consist of number'
                                    }
                                }
                            }
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
                                        case 'prioritized':
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
            const selectAll = document.querySelector('#selectAll'),
                checkboxList = document.querySelectorAll('.data-role-permission [type="checkbox"]');
            selectAll.addEventListener('change', t => {
                checkboxList.forEach(e => {
                    e.checked = t.target.checked;
                });
            });
        });
        sidebarMenu('Roles', 'role');
    </script>
@endsection

