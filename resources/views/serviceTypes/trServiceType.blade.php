@foreach ($serviceTypes as $serviceType)
    <tr id="tr_{{ $serviceType->id }}"
        @if ($serviceType->tise_estado == 'I') style="color:#e3342f" @endif>
        <td>{{ $serviceType->id }}</td>
        <td>{{ $serviceType->tise_nombre }}</td>
        <td>{{ number_format($serviceType->tise_valor) }}</td>

        <td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
                <button class="btn btn-info mr-1" onclick="createServiceType({{ $serviceType->id }}, true)" type="button"><i class="fas fa-eye"></i></button>
                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                <button class="btn btn-primary mr-1" onclick="createServiceType({{ $serviceType->id }}, false)" type="button"><i class="fas fa-edit"></i></button>
                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                <button class="btn btn-danger" onclick="deleteServiceType({{ $serviceType->id }},'tr_{{ $serviceType->id }}')" type="button"><i class="fas fa-trash"></i></button>
            </div>
        </td>
    </tr>
@endforeach