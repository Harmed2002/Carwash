
    <form class="form-send-role-permission">
        @csrf
        <input type="hidden" class="form-control" name="id" id="id" value="{{ $rolePermission->id??'' }}">
        <input type="hidden" class="form-control" name="id_role" id="id_role" value="{{ isset($rolePermission->role_id)?$rolePermission->role_id:'' }}">
        <input type="hidden" class="form-control" name="id_permission" id="id_permission" value="{{ isset($rolePermission->permission_id)?$rolePermission->permission_id:'' }}">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Roles</label>
                   <select class="form-control select2" name="role_id" id="id_role_asoc">
                       @php 
                        $selected =  $rolePermission->role_id ??'';
                       @endphp
                       @foreach($roles as $role)
                       <option value="{{ $role->id }}"  {{ $selected === $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                       @endforeach
                   </select>
                   {{-- permission_id --}}
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Permisos </label>
                   
                    <select class="form-control select2 multiple" name="permission_id[]" id="id_permission_asoc" multiple>
                        @php 
                        $selected = $rolePermission->role_id ??[];
                       @endphp
                        @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}" {{ $selected== $permission->id ? 'selected' : ''}}> {{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <button class="btn btn-success" onclick="sendRolePermission()" type="button" id="sendRolePermissionButton">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </form>

