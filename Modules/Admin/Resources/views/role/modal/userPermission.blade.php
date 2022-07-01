<!-- Add role form -->
<form id="addRoleUserPermissionForm" class="row g-3" method="post" action="{{route('admin.roles.add-user-permission')}}">
    @csrf
    <input type="hidden" name="user_role_permission" value="{{$id}}">
    <div class="col-12">
        <h5>Role Permissions</h5>
        <!-- Permission table -->
        <div class="table-responsive">
            <table class="table table-flush-spacing">
                <tbody class="data-user-permission">
                <tr>
                    <td class="text-nowrap">Administrator Access <i class="bx bx-info-circle bx-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system"></i></td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAllModal" />
                            <label class="form-check-label" for="selectAllModal">
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
                                        <input class="form-check-input" type="checkbox" id="user-{{$item2['action']}}" name="userPermission[{{$key}}][]" value="{{$item2['action']}}" @if (isset($selectPermissions[$key]) && in_array($item2['action'],$selectPermissions[$key]) == true))
                                               checked="checked"
                                            @endif />
                                        <label class="form-check-label" for="user-{{$item2['action']}}">
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
        <!-- Permission table -->
    </div>
    <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary me-sm-3 me-1" form="addRoleUserPermissionForm">Submit</button>
        <button type="reset" class="btn btn-label-secondary btn-close-modal" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
    </div>
</form>
<script>
    $(".btn-close-modal").on('click',function () {
        $('.form-add-role-user').html('');
    })

    const selectAllModal = document.querySelector('#selectAllModal'),
        checkboxListModal = document.querySelectorAll('.data-user-permission [type="checkbox"]');
    selectAllModal.addEventListener('change', t => {
        checkboxListModal.forEach(e => {
            e.checked = t.target.checked;
        });
    });
</script>
<!--/ Add role form -->



