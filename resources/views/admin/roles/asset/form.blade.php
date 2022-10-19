{{-- @extends('layouts.modal')
@section('form') --}}
    <form class="form-send-admin-role">
        @csrf
        <input type="hidden" class="form-control" name="id" id="id" value="{{ $role->id ?? '' }}">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" placeholder="Nombre" name="name" id="name" required value="{{ $role->name ??'' }}">
                </div>
            </div>
            {{-- <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Guardian" name="guard_name" id="guard_name">
                </div>
            </div> --}}
            <div class="col-12">
                <div class="form-group">
                    <label>Permisos</label>   
                    <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple" required placeholder="'hpña">
                        @foreach($permissions as $id => $permissions)
                            <option value="{{ $permissions->id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($permissions->id)) ? 'selected' : '' }}>{{ $permissions->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> 
            <div class="col-6">
                <button class="btn btn-success" onclick="sendRole()" type="button" id="sendRoleButton">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </form>
{{-- @endsection --}}
