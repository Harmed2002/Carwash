<p>
    <b>Nombre:</b> {{ $role->name }}<br>
    <b>Permisos:</b> 
    @foreach ($role->permissions as $permission)
    <span class="right badge badge-primary mt-2">{{ $permission->name }}</span>   
    @endforeach


</p>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>