@foreach ($rolePermissions as $key=> $rolePermission)
<tr id="tr_{{ $key }}">
    <td>
        {{ $rolePermission->role->name }}
    </td>

    <td>
        {{ $rolePermission->permission->name }}
    </td>
    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createRolePermission({{ $rolePermission->permission_id}},{{ $rolePermission->role_id }}, true)" type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            @if ($rolePermission->id != 1)
                <button class="btn btn-primary mr-1"
                    onclick="createRolePermission({{ $rolePermission->permission_id}},{{ $rolePermission->role_id }}, false )" type="button">
                    <i class="fas fa-edit">
                    </i>
                </button>
            @endif
            @if ($rolePermission->id != 1)
                <button class="btn btn-danger"
                    onclick="deleteRolePermission({{$rolePermission->role->id }},{{ $rolePermission->permission->id }},'tr_{{$key }}')"
                    type="button">
                    <i class="fas fa-trash">
                    </i>
                </button>
            @endif
        </div>
    </td>
</tr>
@endforeach