{{-- @extends('layouts.modal')
@section('form') --}}
<form class="form-send-employee" id="form-send-employee" name="form-send-employee" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="idEmpl" id="idEmpl" value="{{ $employee->id ?? '' }}">
    <input type="hidden" class="form-control" name="idPerson" id="idPerson" value="{{ $person->id ?? '' }}">
    <div class="row">
        <div class="col-12 col-sm-12 mb-1" style="border:0 margin:auto;">
            <div class="card">
                <div class="card-body" style="background-color: #17A2B8">
                    <div class="row">
                        <div class="col-12 col-sm-12 mb-1" style="border:0 margin:auto; text-align: center;">
                            <!--img src="img/Employees/User.png" alt="Foto empleado" name="photoEmpl" id="photoEmpl" width="122" height="122" class="img-circle elevation-2"-->
                            <img src = "{{ $employee->empl_rutafoto ?? 'img/Employees/User.png' }}" alt = "Foto empleado" name="photoPers" id="photoPers" width="122" height="122" class="img-circle elevation-2">
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
            <select class="form-control select2 TipoId" name="TipoId" id="TipoId" required onchange="inactivateFields()" tabindex="1">
                <option value="CC" {{ $selected == 'CC' ? 'selected' : '' }}>CC</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="idEmployee" style="font-size: 9pt">Identificación (*)</label>
            <input type="text" min="0" class="form-control idEmployee" placeholder="Digite Identificación" name="idEmployee" 
                id="idEmployee" required tabindex="2" value="{{ $person->pers_identif ?? '' }}" onchange="validExistPerson()">
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="Apell1" style="font-size: 9pt">Primer Apellido (*)</label>
            <input type="text" class="form-control" placeholder="Digite Primer Apellido" name="Apell1" id="Apell1" required tabindex="3" value="{{ $person->pers_primerapell ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="Apell2" style="font-size: 9pt">Segundo Apellido</label>
            <input type="text" class="form-control" placeholder="Digite Segundo Apellido" name="Apell2" id="Apell2" tabindex="4" value="{{ $person->pers_segapell ?? '' }}">
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="Nom1" style="font-size: 9pt">Primer Nombre (*)</label>
            <input type="text" class="form-control" placeholder="Digite Primer Nombre" name="Nom1" id="Nom1" required tabindex="5" value="{{ $person->pers_primernombre ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="Nom2" style="font-size: 9pt">Segundo Nombre</label>
            <input type="text" class="form-control" placeholder="Digite Segundo Nombre" name="Nom2" id="Nom2" tabindex="6" value="{{ $person->pers_segnombre ?? '' }}">
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="fInicio" style="font-size: 9pt">Fecha Inicio Lab.</label>
            <input type="date" class="form-control" placeholder="Digite Fecha de inicio" name="fInicio" id="fInicio" value="{{ $employee->empl_finicio ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="fFin" style="font-size: 9pt">Fecha Fin Lab.</label>
            <input type="date" class="form-control" placeholder="Digite Fecha de finalización" name="fFin" id="fFin" value="{{ $employee->empl_ffin ?? '' }}">
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="eMail" style="font-size: 9pt">Email</label>
            <input type="email" class="form-control" placeholder="Digite Email" name="eMail" id="eMail" value="{{ $person->pers_email ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="pais" style="font-size: 9pt">País</label>
            <select class="form-control select2" name="pais" id="pais" required>
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
            <select class="form-control select2" name="dpto" id="dpto" required onchange="showCities()">
                @foreach ($states as $state)
                    <option value="{{ $state->id }}" {{ $selected == $state->id ? 'selected' : '' }}>{{ $state->dpto_nombre }} </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="ciudad" style="font-size: 9pt">Ciudad</label>
            @php
                $selectCity = $person->ciud_id ?? '';
            @endphp
            <select class="form-control select2" name="ciudad" id="ciudad" required>
                @foreach ($cities as $city)
                    <option value="{{ $city['id'] }}" {{ $selectCity == $city['id'] ? 'selected' : '' }}>{{ $city['ciud_nombre'] }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="dir" style="font-size: 9pt">Direccion</label>
            <input type="text" class="form-control" placeholder="Digite Dirección" name="dir" id="dir" value="{{ $person->pers_direccion ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="tel" style="font-size: 9pt">Teléfono(s)</label>
            <input type="text" class="form-control" placeholder="Digite Teléfono" name="tel" id="tel" value="{{ $person->pers_telefono ?? '' }}">
        </div>
        @can('Cambio de estado')
            <div class="col-12 col-sm-6 mb-3">
                <label for="estado" style="font-size: 9pt">Estado</label>
                <select class="form-control" name="estado" id="estado" required>
                    <option value="A">ACTIVO</option>
                    <option value="I">INACTIVO</option>
                </select>
            </div>
        @endcan
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="cargo" style="font-size: 9pt">Cargo</label>
            @php
                $selected = $employee->empl_cargo ?? '';
            @endphp
            <select class="form-control select2" name="cargo" id="cargo" required>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}" {{ $selected == $position->id ? 'selected' : '' }}>{{ $position->posi_nombre }} </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-3 mb-3">
            <label for="tiposal" style="font-size: 9pt">Tipo Salario</label>
            @php
                $selected = $employee->empl_tiposalario ?? '';
            @endphp
            <select class="form-control" name="tiposal" id="tiposal" required>
                <option value="F" {{ $selected == 'F' ? 'selected' : '' }}>FIJO</option>
                <option value="V" {{ $selected == 'V' ? 'selected' : '' }}>VARIABLE</option>
            </select>
        </div>
        <div class="col-12 col-sm-3 mb-3">
            <label for="salario" style="font-size: 9pt">Salario</label>
            <input type="text" class="form-control" placeholder="Digite Salario" name="salario" id="salario" 
                value="{{ $employee->empl_vlrsalario ?? '' }}" onfocus="letFormat('1')" onblur="letFormat('2')">
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="saveEmployee()" type="button" id="sendEmployeeButton">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button-->
        </div>
    </div>
</form>
{{-- @endsection --}}
