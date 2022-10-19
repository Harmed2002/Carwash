<tr id="priceList{{ $count }}">
    <td>
        <input class="form-control" value="{{ $material['mate_descripcion'] }}" disabled>
        <input class="form-control" value="{{ $material['id'] }}" name="priceLists[{{ $count }}][id_material]"
            id="id_material_{{ $count }}" type="hidden">

    </td>
    <td>
        <select class="form-control select2" name="priceLists[{{ $count }}][id_unmedida]">
            @foreach ($units as $unit)
                <option value="{{ $unit->id }}">{{ $unit->unit_sigla }}</option>
            @endforeach
        </select>
   
    </td>
    <td>
        <input class="form-control" value="" name="priceLists[{{ $count }}][precio]"
            id="precio_{{ $count }}" type="number" min="0">
    </td>
    <td>
        <input class="form-control" value="19" name="priceLists[{{ $count }}][iva]" id="iva_{{ $count }}" type="number" min="0">
    </td>
    <td>
        <button class="btn btn-danger" onclick="deletePriceListTable('priceList{{ $count }}')"
            type="button">
            <i class="fas fa-trash">
            </i>
        </button>
    </td>

</tr>
