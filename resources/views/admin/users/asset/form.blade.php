{{-- @extends('layouts.modal')
@section('form') --}}
    <form class="form-send-admin-user">
        @csrf
        <input type="hidden" class="form-control" name="id" id="id" value="{{ $user->id ??'' }}">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" placeholder="Nombre (*)" name="name" id="name" required value="{{ $user->name ?? ''}}" autocomplete="off" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="Email (*)" name="email" id="email" value="{{ $user->email ?? ''}}" autocomplete="off" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" class="form-control" placeholder="Contraseña (*)" name="password" id="password" value=""
                        autocomplete="off" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Confirmar contraseña</label>
                    <input type="password" class="form-control" placeholder="Confirmar contraseña (*)"
                        name="password_confirmed" id="password_confirmed" autocomplete="off" value="">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Roles</label>
                    <select name="roles[]" id="roles" class="form-control select2" multiple="multiple" required >
                        @foreach($roles as $id => $roles)
                            <option value="{{ $roles->id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($roles->id)) ? 'selected' : '' }}>{{ $roles->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> 
            <div class="col-6">
                <button class="btn btn-success" onclick="sendUser()" type="button" id="sendUserButton">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </form>
{{-- @endsection --}}
