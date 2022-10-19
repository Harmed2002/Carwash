@foreach ($users as $user)
    <tr id="tr_{{ $user->id }}">
        <td>
            {{ $user->name }}
        </td>
        <td>
            {{ $user->email }}
        </td>
        <td>
            @foreach ($user->roles as $role)
                {{ $role->name }},
            @endforeach
        </td>
        <td>
            {{ $user->usua_creacion }}
        </td>
        <td>
            {{ $user->created_at }}
        </td>
        <td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
                <button class="btn btn-info mr-1"
                    onclick="createUser({{ $user->id }}, 'true' )" type="button">
                    <i class="fas fa-eye">
                    </i>
                </button>
                @if ($userAuth->id != $user->id)
                    <button class="btn btn-primary mr-1"
                        onclick="createUser({{ $user->id}},'false' )" type="button">
                        <i class="fas fa-edit">
                        </i>
                    </button>
                @endif
                @if ($userAuth->id != $user->id)
                    <button class="btn btn-danger"
                        onclick="deleteUser({{ $user->id }},'tr_{{ $user->id }}')"
                        type="button">
                        <i class="fas fa-trash">
                        </i>
                    </button>
                @endif
            </div>
        </td>
    </tr>
@endforeach
