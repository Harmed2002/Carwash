@foreach ($suppliers as $supplier)
                                    
<tr id="tr_supplier{{ $supplier->id }}"
    @if ($supplier->prov_estado == 'I') style="color:#e3342f" @endif>
    <td>
        {{ $supplier->id }}
    </td>
    <td>
        {{ $supplier->Person->pers_razonsocial }}<br>
        {{ $supplier->Person->pers_tipoid }} :      {{ $supplier->Person->pers_identif }}
    </td>
    <td>
        {{ $supplier->Person->City->State->dpto_nombre }} -  {{ $supplier->Person->City->ciud_nombre }}<br>
        {{ $supplier->Person->pers_direccion }}
    </td>
    <td>
        {{ $supplier->Person->pers_primernombre .' '. $supplier->Person->pers_segnombre.' '.$supplier->Person->pers_primerapell .' '.$supplier->Person->pers_segapell  ?? '' }}<br>
        TEL: {{ $supplier->Person->pers_telefono }}<br>

        {{ $supplier->Person->pers_email }}
    </td>
    {{-- <td>
        {{ $supplier->prov_estado }}
    </td> --}}

    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createSupplier({{ $supplier->id }}, true)"
                type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn btn-primary mr-1"
                onclick="createSupplier({{ $supplier->id }},false,'{{ $supplier->Person->pers_tipoid }}')"
                type="button">
                <i class="fas fa-edit">
                </i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn btn-danger"
                onclick="deleteSupplier({{ $supplier->id }},'tr_{{ $supplier->id }}')"
                type="button">
                <i class="fas fa-trash">
                </i>
            </button>
        </div>
    </td>
</tr>
@endforeach