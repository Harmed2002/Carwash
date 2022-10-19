<p>
    <b>Nombre:</b> {{ $user->name }}<br>
    <b>Email:</b> {{ $user->email }}<br>
    <b>Usuario creación:</b> {{ $user->usua_creacion }}<br>
    <b>Roles:</b> 
    @foreach ($user->roles as $role)
    <span class="right badge badge-primary mt-2">{{ $role->name }}</span>   
    @endforeach
</p>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>