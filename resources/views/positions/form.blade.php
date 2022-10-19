<form class="form-send-position">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{ $position->id ?? '' }}">

    <div class="row">
        <div class="col-12 col-sm-12 mb-3">
            <label for="nombre" style="font-size: 9pt">Nombre (*)</label>
            <input type="text" class="form-control" placeholder="Digite el nombre del cargo" name="nombre" id="nombre" required value="{{ $position->posi_nombre ?? '' }}" autofocus tabindex="1">
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="savePosition()" type="button" id="savePositionButton">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</form>
