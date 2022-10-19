@foreach ($roles as $role)
<tr id="tr_{{ $role->id }}">
    <td>
        {{ $role->id }}
    </td>
    <td>
        {{ $role->name }}
    </td>
    {{-- <td>
        {{ $role->guard_name }}
    </td> --}}
    <td>
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
            data-target="#modalGeneral"
            onclick="modalPermission({{ $role->permissions }}, 'Permisos del rol')">
            {{ count($role->permissions) }}
        </button>
        {{-- @foreach ($role->permissions as $permission)
            <span
                class="right badge badge-primary mt-2">{{ $permission->name }}</span>
        @endforeach --}}
    </td>
    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            @can('Formulario de roles')
                <button class="btn btn-info mr-1"
                    onclick="createRole({{ $role->id }},'true')" type="button">
                    <i class="fas fa-eye">
                    </i>
                </button>
            @endcan
            {{-- @if ($role->id != 1) --}}
            @can('Formulario de roles')
                <button class="btn btn-primary mr-1"
                    onclick="createRole({{ $role->id }},'false')" type="button">
                    <i class="fas fa-edit">
                    </i>
                </button>
            @endcan
            {{-- @endif --}}
            @can('Eliminar de roles')
                @if ($role->id != 1)
                    <button class="btn btn-danger"
                        onclick="deleteRole({{ $role->id }},'tr_{{ $role->id }}')"
                        type="button">
                        <i class="fas fa-trash">
                        </i>
                    </button>
                @endif
            @endcan
        </div>
    </td>
</tr>
@endforeach