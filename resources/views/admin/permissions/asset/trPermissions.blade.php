@foreach ($permissions as $permission)
<tr id="tr_{{ $permission->id }}">
    <td>
        {{ $permission->name }}
    </td>
    <td>
        {{ $permission->guard_name }}
    </td>
    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createPermission({{ $permission->id }},'true')" type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            @if ($permission->id != 1)
                <button class="btn btn-primary mr-1"
                    onclick="createPermission({{ $permission->id}},'false')" type="button">
                    <i class="fas fa-edit">
                    </i>
                </button>
            @endif
            @if ($permission->id != 1)
                <button class="btn btn-danger"
                    onclick="deletePermission({{ $permission->id }},'tr_{{ $permission->id }}')"
                    type="button">
                    <i class="fas fa-trash">
                    </i>
                </button>
            @endif
        </div>
    </td>
</tr>
@endforeach