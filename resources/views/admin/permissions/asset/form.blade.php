{{-- @extends('layouts.modal')
@section('form') --}}
    <form class="form-send-admin-permission">
        @csrf
        <input type="hidden" class="form-control" name="id" id="id" value="{{ $permission->id ?? ''}}">
        <div class="row">
            <div class="col-10">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nombre" name="name" id="name" required value="{{ $permission->name ?? ''}}">
                </div>
            </div>
            {{-- <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Guardian" name="guard_name" id="guard_name">
                </div>
            </div> --}}
            <div class="col-4">
                <button class="btn btn-success" onclick="sendPermission()" type="button"
                    id="sendPermissionButton">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </form>
{{-- @endsection --}}
