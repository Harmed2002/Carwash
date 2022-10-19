@foreach ($positions as $position)
    <tr id="tr_{{ $position->id }}"
        @if ($position->position_estado == 'I') style="color:#e3342f" @endif>
        <td>{{ $position->id }}</td>
        <td>{{ $position->posi_nombre }}</td>

        <td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
                <button class="btn btn-info mr-1" onclick="createPosition({{ $position->id }}, true)" type="button"><i class="fas fa-eye"></i></button>
                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                <button class="btn btn-primary mr-1" onclick="createPosition({{ $position->id }}, false)" type="button"><i class="fas fa-edit"></i></button>
                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                <button class="btn btn-danger" onclick="deletePosition({{ $position->id }},'tr_{{ $position->id }}')" type="button"><i class="fas fa-trash"></i></button>
            </div>
        </td>
    </tr>
@endforeach