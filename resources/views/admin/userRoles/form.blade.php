<form class="form-send-user-rol">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{$userRole->id??'' }}">
    <input type="hidden" class="form-control" name="id_role_ur" id="id_role_ur" value="{{ isset($userRole->role_id)?$userRole->role_id:'' }}">
    <input type="hidden" class="form-control" name="id_model_ur" id="id_model_ur" value="{{ isset($userRole->model_id)?$userRole->model_id:'' }}">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Usuarios</label>
                <select class="form-control select2" name="model_id" id="id_user_asoc">
                    @php
                        $selected = $userRole['model_id']??'';
                    @endphp
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $selected== $user->id ? 'selected' : ''}}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Roles</label>
                <select class="form-control select2" name="role_id[]" id="id_role_asoc" multiple="multiple">
                    @php
                    $selected =  $userRole['role_id']??'';
                @endphp
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{$selected == $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-6">
            <button class="btn btn-success" onclick="sendUserRole()" type="button" id="sendUserRoleButton">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>

</form>
