<tr>
    <td><input value = "{{ $detail['id'] }}" name = "details[{{ $count }}][id]" style = "width: 50px; border:0; background-color: #ffffff;" readonly></td>
    <td><input value = "{{ $detail['servicio'] }}" name = "details[{{ $count }}][servicio]" style = "width: 400px; border:0; background-color: #ffffff;" readonly></td>
    <td><input value = "{{ $detail['valor'] }}"  name = "details[{{ $count }}][valor]" style = "width: 80px; border:0; background-color: #ffffff;" readonly></td>
    
    <td class="text-right py-0 align-middle">
        <button class="btn btn-danger" onclick="deleteRow(this)" type="button"><i class="fas fa-trash"></i></button>
    </td>
</tr>
