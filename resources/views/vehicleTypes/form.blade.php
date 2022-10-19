<form class="form-send-vehicleType">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{ $vehicleType->id ?? '' }}">

    <div class="row">
        <div class="col-12 col-sm-12 mb-3">
            <label for="nombre" style="font-size: 9pt">Nombre (*)</label>
            <input type="text" class="form-control" placeholder="Digite el nombre del tipo de vehículo" name="nombre" id="nombre" required value="{{ $vehicleType->tive_nombre ?? '' }}" autofocus tabindex="1">
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="saveVehicleType()" type="button" id="saveVehicleTypeButton">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</form>
