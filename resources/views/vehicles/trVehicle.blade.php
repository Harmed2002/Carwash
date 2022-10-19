@foreach ($vehicles as $vehicle)
    <tr id="tr_{{ $vehicle->id }}"
        @if ($vehicle->vehi_estado == 'I') style="color:#e3342f" @endif>
        <td>{{ $vehicle->id }}</td>
        <td>{{ $vehicle->vehi_placa }}</td>
        <td>{{ $vehicle->Client->Person->pers_primernombre }} {{ $vehicle->Client->Person->pers_segnombre ?? '' }} 
            {{ $vehicle->Client->Person->pers_primerapell }} {{ $vehicle->Client->Person->pers_segapell ?? '' }} {{ $vehicle->Client->Person->pers_razonsocial ?? ''}}<br>
            {{ $vehicle->Client->Person->pers_tipoid }} {{ $vehicle->Client->Person->pers_identif }}
        </td>
        <td><b>TIPO:</b> {{ $vehicle->ModelsVehicle->VehicleType->tive_nombre }}<br>
            <b>MARCA:</b> {{ $vehicle->ModelsVehicle->Brands->vebr_marca }}<br>
            <b>MODELO:</b> {{ $vehicle->ModelsVehicle->vemo_modelo }}<br>
        </td>
        <td>{{ $vehicle->vehi_anio }}</td>
        <td>{{ $vehicle->vehi_obs }}</td>

        <td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
                <button class="btn btn-info mr-1"
                    onclick="createVehicle({{ $vehicle->id }}, true)" type="button"><i class="fas fa-eye"></i>
                </button>
                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                <button class="btn btn-primary mr-1"
                    onclick="createVehicle({{ $vehicle->id }}, false, '{{ $vehicle->Client->Person->pers_tipoid }}')"
                    type="button"><i class="fas fa-edit"></i></button>
                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                <button class="btn btn-danger"
                    onclick="deleteVehicle({{ $vehicle->id }}, 'tr_{{ $vehicle->id }}' )" type="button"><i class="fas fa-trash"></i></button>
            </div>
        </td>        
    </tr>
@endforeach