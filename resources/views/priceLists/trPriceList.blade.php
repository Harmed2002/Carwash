@foreach ($priceLists as $priceList)
<tr id="tr_{{ $priceList->id }}"  @if ($priceList->priceList_estado == 'I') style="color:#e3342f" @endif>
    <td>
        {{ $priceList->id }}
    </td>
    <td>
        {{ $priceList->Material->mate_descripcion }}
    </td>
    <td>
        {{ $priceList->Construction->obra_nombre }}
    </td>
    <td>
        {{ $priceList->precio }}
    </td>
    <td>
        {{ $priceList->iva }}
    </td>
    <td>
        {{ $priceList->created_at }}
    </td>
    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createPriceList({{ $priceList->id}},true)" type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn btn-primary mr-1"
                onclick="createPriceList({{ $priceList->id }},false)" type="button">
                <i class="fas fa-edit">
                </i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn btn-danger"
                onclick="deletePriceList({{ $priceList->id }},'tr_{{ $priceList->id }}')"
                type="button">
                <i class="fas fa-trash">
                </i>
            </button>
        </div>
    </td>
</tr>
@endforeach