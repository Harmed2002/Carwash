{{-- @extends('layouts.modal')
@section('form') --}}
<form class="form-send-supplier">
    @csrf
    <input type="hidden" class="form-control" name="idPerson" id="idPerson" value="{{ $person['id'] ?? '' }}">
    <input type="hidden" class="form-control" name="idSupplier" id="idSupplier" value="{{ $supplier->id ?? '' }}">

    <div class="row">
        <div class="col-12 col-sm-4 mb-3">
            <label for="TipoId" style="font-size: 9pt">Tipo Id</label>
            @php
                $selected = $person->pers_tipoid ?? '';
            @endphp
            <select class="form-control select2" name="TipoId" id="TipoId" required onchange="inactivateFields()" tabindex="1">
                <option value="CC" {{ $selected == 'CC' ? 'selected' : '' }}>CC</option>
                <option value="NIT" {{ $selected === 'NIT' ? 'selected' : '' }}>NIT</option>
            </select>
        </div>
        <div class="col-12 col-sm-7 mb-3">
            <label for="idProv" style="font-size: 9pt">Identificación (*)</label>
            <input type="number" class="form-control" min="0" placeholder="Digite la Identificación" name="idProv" id="idProv" required
                value="{{ $person->pers_identif ?? '' }}" onkeyup="codeVerification()" onchange="validExistPerson()" tabindex="2">
        </div>
        <div class="col-12 col-sm-1 mb-3">
            <label for="idProv" style="font-size: 9pt">DV</label>
            <input type="number" class="form-control" name="digVerif" id="digVerif" value="{{ $supplier->codeVerification ?? '' }}" disabled>
            <!--input type="hidden" class="form-control codeVerification" name="supplier[codeVerification]" value="{{-- $supplier->codeVerification??'' --}}"-->
        </div>
        <div class="col-12 col-sm-12 mb-3">
            <label for="rSocial" style="font-size: 9pt">Razón Social</label>
            <input type="text" class="form-control" placeholder="Digite la Razón Social" name="rSocial" id="rSocial" value="{{ $person->pers_razonsocial ?? '' }}" disabled required tabindex="3">
            <!--input type="hidden" class="form-control" value="{{-- $person->pers_razonsocial??'' --}}" id="pers_razonsocial" name="person[pers_razonsocial]"-->
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="Apell1" style="font-size: 9pt">Primer Apellido</label>
            <input type="text" class="form-control" placeholder="Digite el Primer Apellido" name="Apell1" id="Apell1" value="{{ $person->pers_primerapell ?? '' }}" tabindex="4">
            <!--input type="hidden" class="form-control" placeholder="Primer Apellido" name="person[pers_primerapell]" id="Apell1" value="{{-- $person->pers_primerapell??'' --}}"-->
        </div>

        <div class="col-12 col-sm-6 mb-3">
            <label for="Apell2" style="font-size: 9pt">Segundo Apellido</label>
            <input type="text" class="form-control" placeholder="Digite el Segundo Apellido" name="Apell2" id="Apell2" value="{{ $person->pers_segapell ?? '' }}" tabindex="5">
            <!--input type="hidden" class="form-control" name="person[pers_segapell]" id="Apell2" value="{{-- $person->pers_segapell??'' --}}"-->
        </div>

        <div class="col-12 col-sm-6 mb-3">
            <label for="Nom1" style="font-size: 9pt">Primer Nombre</label>
            <input type="text" class="form-control" placeholder="Digite el Primer Nombre" name="Nom1" id="Nom1" value="{{ $person->pers_primernombre ?? '' }}" tabindex="6">
            <!--input type="hidden" class="form-control" name="person[pers_primernombre]" id="Nom1" value="{{-- $person->pers_primernombre??'' --}}" -->
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="Nom2" style="font-size: 9pt">Segundo Nombre</label>
            <input type="text" class="form-control" placeholder="Digite el Segundo Nombre" name="Nom2" id="Nom2" value="{{ $person->pers_segnombre ?? '' }}" tabindex="7">
            <!--input type="hidden" class="form-control" placeholder="Segundo Nombre" name="person[pers_segnombre]" id="Nom2" value="{{-- $person->pers_segnombre??'' --}}"-->
        </div>
        
        <div class="col-12 col-sm-6 mb-3">
            <label for="dir" style="font-size: 9pt">Dirección</label>
            <input type="text" class="form-control" placeholder="Digite la Dirección" name="dir" id="dir" value="{{ $person->pers_direccion ?? '' }}" tabindex="11">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="pais" style="font-size: 9pt">País</label>
            <select class="form-control select2" name="pais" id="pais" required tabindex="12">
                <option value="1">COLOMBIA</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="dpto" style="font-size: 9pt">Departamento (*)</label>
            @php
                $selected = $person->dpto_id ?? '';
            @endphp
            <select class="form-control select2" name="dpto" id="dpto" required onchange="showCities()" tabindex="10">
                <!--option value="">Seleccione Dpto...</option-->
                @foreach ($states as $state)
                    <option value="{{ $state->id }}" {{ $selected == $state->id ? 'selected' : '' }}>{{ $state->dpto_nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="ciudad" style="font-size: 9pt">Ciudad (*)</label>
            @php
                $selected = $person->ciud_id ?? '';
            @endphp
            <select class="form-control select2" name="ciudad" id="ciudad" required tabindex="9">
                <!--option value="">Seleccione Ciudad...</option-->
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" {{ $selected == $city->id ? 'selected' : '' }}>{{ $city->ciud_nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="tel" style="font-size: 9pt">Teléfono(s)</label>
            <input type="text" class="form-control" placeholder="Digite el Teléfono" name="tel" id="tel" value="{{ $person->pers_telefono ?? '' }}" tabindex="13">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="eMail" style="font-size: 9pt">Email</label>
            <input type="email" class="form-control" placeholder="Digite el Email" name="eMail" id="eMail" value="{{ $person->pers_email ?? '' }}" tabindex="14">
        </div>
        <div class="col-12 col-sm-12 mb-3">
            <label for="prov_codactividad" style="font-size: 9pt">Act. Económica</label>
            @php
                $selected = $supplier->id_codactividad ?? '';
            @endphp
            <select class="form-control select2" name="actEcon" id="actEcon" tabindex="8">
                @foreach ($economicacts as $economicact)
                    <option value="{{ $economicact->id }}" {{ $selected == $economicact->id ? 'selected' : '' }}>{{ $economicact->acte_nombre }}</option>
                @endforeach
            </select>
        </div>
        @can('Cambio de estado')
            <div class="col-12 col-sm-3 mb-3">
                <label for="estado" style="font-size: 9pt">Estado</label>
                @php
                    $selected = $person->pers_estado ?? '';
                @endphp
                <select class="form-control select2" name="estado" id="estado" required tabindex="15">
                    <option value="A" {{ $selected == 'A' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="I" {{ $selected == 'I' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>
        @endcan
    </div>

    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="sendSupplier()" type="button" id="sendSupplierButton">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</form>
{{-- @endsection --}}
