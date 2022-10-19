<form class="form-send-price-lists">
    {{-- @csrf
    {{ $priceList }} --}}
    <input type="hidden" class="form-control" name="id" id="id" value="{{ $priceList->id ?? '' }}">
    <div class="row">
        <div class="col-12 col-sm-4 mb-3">
            <label for="nombre" style="font-size: 9pt">Cliente</label>
            <select class="form-control select2 obra_idcliente"  onchange="searchContructionClient()">
                <option selected value="0">Selecciona un cliente</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">
                        {{ $client->Person->pers_razonsocial}} -{{ $client->Person->pers_identif }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="nombre" style="font-size: 9pt">Obra</label>
            @php
                $selectedObra = $priceList->id_obra ?? '';
            @endphp
            <select class="form-control select2 idObra"  name="id_obra" required {{ $selectedObra ? '':'disabled'}}>
                
                @foreach ($constructions as $construction)
                    <option value="{{ $construction->id }}"
                        {{ $selectedObra === $construction->id ? 'selected' : '' }}>{{ $construction->obra_nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="idMat" style="font-size: 8pt">Id. Material</label>
            @php
                $selectedMaterial = $priceList->id_material ?? '';
            @endphp
            <select class="form-control select2" id="id_material" required onchange="materialPriceList()" name="id_material">
                <option value="">Seleccione...</option>
                @foreach ($materials as $material)
                    <option value="{{ $material->id }}" {{ $selectedMaterial == $material->id ? 'selected' : '' }}>
                        {{ $material->mate_descripcion }} </option>
                @endforeach
            </select>
        </div>
        @can('Cambio de estado')
            <div class="col-12 col-sm-6 mb-3">
                <label for="estado" style="font-size: 9pt">Estado</label>
                @php
                    $selected = $priceList->priceList_estado ?? '';
                @endphp
                <select class="form-control" name="priceList_estado" id="priceList_estado">
                    <option value="A" {{ $selected == 'A' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="I" {{ $selected == 'I' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>
        @endcan
        @if (!isset($priceList->id))
            <div class="table-responsive">

                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>
                                Material
                            </th>
                            <th>
                                Unidad
                            </th>
                            <th>
                                Precio
                            </th>
                            <th>
                                Iva
                            </th>
                            <th>
                              
                            </th>
                        </tr>
                    </thead>

                    <tbody id="tbody_material_listPrice" name="tbody_material_listPrice">
                    </tbody>

                    <tfoot class="table-primary" id="totalPriceList">
                    </tfoot>
                </table>

            </div>
        @else
            <div class="col-12 col-sm-6 mb-3">
                <label for="unidad" style="font-size: 9pt">Unidad</label>
                <select class="form-control select2" name="id_unmedida">
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->unit_sigla }}</option>
                    @endforeach
                </select>

            </div>
            <div class="col-12 col-sm-6 mb-3">
                <label for="precio" style="font-size: 9pt">Precio</label>
                <input class="form-control"  name="precio"
                id="precio" type="number" min="0" placeholder="Precio" value="{{ $priceList->precio  ?? ''}}">
            </div>
            <div class="col-12 col-sm-6 mb-3">
                <label for="iva" style="font-size: 9pt">Iva</label>
                <input class="form-control"  name="iva"
                id="iva" type="number" min="0" placeholder="iva" value="{{ $priceList->iva  ?? ''}}">
            </div>


        @endif
    </div>
    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="savePriceList()" type="button"
                id="sendPriceListButton">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</form>
