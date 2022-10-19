@foreach ($userRoles as $userRole)
<tr id="tr_{{ $userRole->id }}">
    <td>
        {{ $userRole->user->name }}
    </td>
    <td>
        {{ $userRole->role->name }}
    </td>
    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createUserRole({{ $userRole->role_id }},{{ $userRole->model_id }}, true)" type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            @if ($userRole->id != 1)
                <button class="btn btn-primary mr-1"
                    onclick="createUserRole({{ $userRole->role_id }},{{ $userRole->model_id }},false)" type="button">
                    <i class="fas fa-edit">
                    </i>
                </button>
            @endif
            @if ($userRole->id != 1)
                <button class="btn btn-danger"
                    onclick="deleteUserRole({{ $userRole->user->id }},{{$userRole->role->id  }},'tr_{{ $userRole->id }}')"
                    type="button">
                    <i class="fas fa-trash">
                    </i>
                </button>
            @endif
        </div>
    </td>
</tr>
@endforeach