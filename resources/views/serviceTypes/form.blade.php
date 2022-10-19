<form class="form-send-serviceType">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{ $serviceType->id ?? '' }}">

    <div class="row">
        <div class="col-12 col-sm-8 mb-3">
            <label for="nombre" style="font-size: 9pt">Nombre (*)</label>
            <input type="text" class="form-control" placeholder="Digite el nombre del servicio" name="nombre" id="nombre" required value="{{ $serviceType->tise_nombre ?? '' }}" autofocus tabindex="1">
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="valor" style="font-size: 9pt">Valor (*)</label>
            <input type="number" class="form-control" placeholder="Digite el valor" name="valor" id="valor" required value="{{ $serviceType->tise_valor ?? '' }}" tabindex="2">
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-8 mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="esCombo" onchange="toggleCombo()">
                <label class="form-check-label" for="esCombo">Es un combo de servicios</label>
            </div>
        </div>
    </div>

    <!-- Caja de nuevo detalle -->
    <div class="div" id="detail" style="border : 1px solid #B8DAFF; margin : 4px 4px 1px 4px; display : none">
        <div class="div" style="margin : 8px 8px 1px 8px;">
            <div class="row">
                <input type="hidden" class="form-control" id="totalAcum" value="0">
                <div class="col-12 col-sm-10 mb-3">
                    <select class="form-control select2" id="idTipoServ" required>
                        <option value="">Seleccione el servicio...</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}"> {{ $service->tise_nombre }},{{ $service->tise_valor }}</option>
                        @endforeach
                    </select>
                </div>
                <!--div class="col-3 col-sm-3 "-->
                <div class="col-12 col-sm-2 mb-3">
                    <button class="btn btn-primary btn-sm" onclick="addDetail()" type="button" id="addDetailButton">Agregar</button>
                </div>
            </div>
        </div>

        <!-- Tabla detalle combo-->
        <div class="card card-info mt-2">
            <div class="card-body p-0" style="display: block;">
                <div class="table-responsive">
                    <table class="table" id="detailTable">
                        <thead class="table-primary">
                            <tr>
                                <th>Id</th>
                                <th>Servicio</th>
                                <th>Valor</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="tbody_servicedet" name="tbody_servicedet">
                        </tbody>

                        <tfoot class="table-primary-foot" id="totalCombo">
                            
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- Fin tabla -->
    
        <div class="col-12 col-sm-2 mb-3">
            <label for="total" style="font-size: 8pt">Vlr. Total Detalle</label>
            <input type="text" class="form-control" placeholder="Subtotal" name="total" id="total" value="0" disabled>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="saveServiceType()" type="button" id="saveServiceTypeButton">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</form>
