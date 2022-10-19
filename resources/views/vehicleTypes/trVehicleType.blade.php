@foreach ($vehicleTypes as $vehicleType)
    <tr id="tr_{{ $vehicleType->id }}"
        @if ($vehicleType->tive_estado == 'I') style="color:#e3342f" @endif>
        <td>{{ $vehicleType->id }}</td>
        <td>{{ $vehicleType->tive_nombre }}</td>

        <td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
                <button class="btn btn-info mr-1" onclick="createVehicleType({{ $vehicleType->id }}, true)" type="button"><i class="fas fa-eye"></i></button>
                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                <button class="btn btn-primary mr-1" onclick="createVehicleType({{ $vehicleType->id }}, false)" type="button"><i class="fas fa-edit"></i></button>
                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                <button class="btn btn-danger" onclick="deleteVehicleType({{ $vehicleType->id }},'tr_{{ $vehicleType->id }}')" type="button"><i class="fas fa-trash"></i></button>
            </div>
        </td>
    </tr>
@endforeach