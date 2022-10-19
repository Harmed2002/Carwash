<form class="form-send-vehicle">
    @csrf
    <!--input type="hidden" class="form-control" name="idPerson" id="idPerson" value="{{-- $person['id']??'' --}}"-->
    <input type="hidden" class="form-control" name="idVehicle" id="idVehicle" value="{{ $vehicle->id ?? '' }}">

    <div class="row">
        <div class="col-12 col-sm-4 mb-3">
            <label for="placa" style="font-size: 9pt">Placa (*)</label>
            <input type="text" class="form-control" placeholder="Digite la Placa" name="placa" id="placa" required value="{{ $vehicle->vehi_placa ?? '' }}" autofocus tabindex="1">
        </div>
        <div class="col-12 col-sm-8 mb-3">
            <label for="idProp" style="font-size: 9pt">Propietario (*)</label>
            @php
                $selected = $vehicle->id_propietario ?? '';
            @endphp
            <select class="form-control select2" name="prop" id="prop" required tabindex="2">
                <option value="">Seleccione un Propietario</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $selected == $client->id ? 'selected' : '' }}>
                        {{ $client->person->pers_primerapell . ' ' . $client->person->pers_segapell . ' ' . $client->person->pers_primernombre . ' ' . $client->person->pers_segnombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-10 mb-3">
            <label for="modelo" style="font-size: 9pt">Modelo (*)</label>
            @php
                $selected = $vehicle->id_modelo ?? '';
            @endphp
            <select class="form-control select2" name="modelo" id="modelo" required tabindex="3">
                <option value="">Seleccione un modelo de vehículo</option>
                @foreach ($models as $model)
                    <option value="{{ $model->id }}" {{ $selected == $model->id ? 'selected' : '' }}>
                        {{ $model->VehicleType->tive_nombre . ' ' . $model->Brands->vebr_marca . ' ' . $model->vemo_modelo }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-2 mb-3">
            <label for="year" style="font-size: 9pt">Año (*)</label>
            @php
                $selected = $vehicle->vehi_anio ?? '';
            @endphp
            <select class="form-control select2" id="year" name="year" value="{{ $vehicle->vehi_anio ?? '' }}" required tabindex="4"></select>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 col-sm-12 mb-3">
            <label for="obs" style="font-size: 9pt">Observaciones</label>
            <textarea id="obs" name="obs" rows="5" cols="101" maxlength="250"  
                style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  tabindex="5">{{ $vehicle->vehi_obs ?? '' }}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="saveVehicle()" type="button" id="saveVehicleButton">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</form>
