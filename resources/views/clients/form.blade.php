{{-- @extends('layouts.modal')
@section('form') --}}
<form class="form-send-client" id="form-send-client" name="form-send-client" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="idClient" id="idClient" value="{{ $client->id ?? '' }}">
    <input type="hidden" class="form-control" name="idPerson" id="idPerson" value="{{ $person->id ?? '' }}">

    <div class="row">
        <div class="col-12 col-sm-12 mb-1" style="border:0 margin:auto;">
            <div class="card">
                <div class="card-body" style="background-color: #17A2B8">
                    <div class="row">
                        <div class="col-12 col-sm-12 mb-1" style="border:0 margin:auto; text-align: center;">
                            <img src = "{{ $client->clie_rutafoto ?? 'img/Employees/User.png' }}" alt = "Foto cliente" name="photoPers" id="photoPers" width="122" height="122" class="img-circle elevation-2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 mb-1" style="border:0 margin:auto; text-align: center;">
                            <label for="photo"><span>Cargar Imagen</span></label>
                            <input type="file" accept="image/*" name="photo" id="photo" onchange="imagePreview()">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="TipoId" style="font-size: 9pt">Tipo Id (*)</label>
            @php
                $selected = $person->pers_tipoid ?? '';
            @endphp
            <select class="form-control select2" name="TipoId" id="TipoId" onchange="inactivateFields()" required tabindex="1">
                <option value="CC" {{ $selected == 'CC' ? 'selected' : '' }}>CC</option>
                <option value="NIT" {{ $selected == 'NIT' ? 'selected' : '' }}>NIT</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="idCliente" style="font-size: 9pt">Id. Cliente (*)</label>
            <input type="number" min="0" class="form-control" placeholder="Digite Identificación" name="idCliente"
                id="idCliente" required value="{{ $person->pers_identif ?? '' }}" onchange="validExistPerson()" tabindex="2">
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 mb-3">
            <label for="rSocial" style="font-size: 9pt">Razón Social</label>
            <input type="text" class="form-control" placeholder="Digite la Razón Social" name="rSocial" id="rSocial" 
               value="{{ $person->pers_razonsocial ?? '' }}" disabled tabindex="3">
            <!--input type="hidden" class="form-control" placeholder="Razón Social" id="pers_razonsocial" required tabindex="3" value="{{-- $person->pers_razonsocial??'' --}}" -->
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="Apell1" style="font-size: 9pt">Primer Apellido</label>
            <input type="text" class="form-control" placeholder="Digite el Primer Apellido" name="Apell1" id="Apell1" value="{{ $person->pers_primerapell ?? '' }}" tabindex="4">
            <!--input type="hidden" class="form-control" name="Apell1" id="Apell1" value="{{-- $person->pers_primerapell??'' --}}"-->
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="Apell2" style="font-size: 9pt">Segundo Apellido</label>
            <input type="text" class="form-control" placeholder="Digite el Segundo Apellido" name="Apell2" id="Apell2" value="{{ $person->pers_segapell ?? '' }}" tabindex="5">
                <!--input type="hidden" class="form-control" name="Apell2" id="Apell2" value="{{-- $person->pers_segapell??'' --}}"-->
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="Nom1" style="font-size: 9pt">Primer Nombre</label>
            <input type="text" class="form-control" placeholder="Digite el Primer Nombre" name="Nom1" id="Nom1" value="{{ $person->pers_primernombre ?? '' }}" tabindex="6">
            <!--input type="hidden" class="form-control" placeholder="Primer Nombre" name="Nom1" id="Nom1" value="{{-- $person->pers_primernombre??'' --}}"-->
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="Nom2" style="font-size: 9pt">Segundo Nombre</label>
            <input type="text" class="form-control" placeholder="Digite el Segundo Nombre" name="Nom2" id="Nom2" value="{{ $person->pers_segnombre ?? '' }}" tabindex="7">
                <!--input type="hidden" class="form-control" placeholder="Segundo Nombre" name="Nom2" id="Nom2" value="{{-- $person->pers_segnombre??'' --}}"-->
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="eMail" style="font-size: 9pt">Email</label>
            <input type="email" class="form-control" placeholder="Email" name="eMail" id="eMail" value="{{ $person->pers_email ?? '' }}" tabindex="8">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="pais" style="font-size: 9pt">País</label>
            <select class="form-control select2" name="pais" id="pais" required tabindex="9">
                <option value="COL">COLOMBIA</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="dpto" style="font-size: 9pt">Departamento</label>
            @php
                $selected = $person->dpto_id ?? '';
            @endphp
            <select class="form-control select2" name="dpto" id="dpto" required onchange="showCities()" tabindex="9">
                @foreach ($states as $state)
                    <option value="{{ $state->id }}" {{ $selected == $state->id ? 'selected' : '' }}>{{ $state->dpto_nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="ciudad" style="font-size: 9pt">Ciudad</label>
            @php
                $selectCity = $person->ciud_id ?? '';
            @endphp
            <select class="form-control select2" name="ciudad" id="ciudad" required tabindex="10">

                @foreach ($cities as $city)
                    <option value="{{ $city['id'] }}" {{ $selectCity == $city['id'] ? 'selected' : '' }}>{{ $city['ciud_nombre'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="dir" style="font-size: 9pt">Direccion</label>
            <input type="text" class="form-control" placeholder="Digite la Dirección" name="dir" id="dir" value="{{ $person->pers_direccion ?? '' }}" tabindex="11">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="tel" style="font-size: 9pt">Teléfono(s)</label>
            <input type="text" class="form-control" placeholder="Digite el Teléfono" name="tel" id="tel" value="{{ $person->pers_telefono ?? '' }}" tabindex="12">
        </div>
        @can('Cambio de estado')
            <div class="col-12 col-sm-6 mb-3">
                <label for="estado" style="font-size: 9pt">Estado</label>
                <select class="form-control" name="estado" id="estado" required tabindex="13">
                    <option value="A">ACTIVO</option>
                    <option value="I">INACTIVO</option>
                </select>
            </div>
        @endcan
    </div>

    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="saveClient()" type="button" id="sendClientButton">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</form>
{{-- @endsection --}}
