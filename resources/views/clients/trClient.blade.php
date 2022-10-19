@foreach ($clients as $client)
<tr id="tr_{{ $client->id }}"
    @if ($client->client_estado == 'I') style="color:#e3342f" @endif>
    <td>
        {{ $client->id }}
    </td>
    <td>
        {{ $client->Person->pers_primernombre .' '. $client->Person->pers_segnombre.' '.$client->Person->pers_primerapell .' '.$client->Person->pers_segapell  ?? '' }}
    </td>
    <td>
       {{ $client->Person->pers_razonsocial }}
    </td>
    <td>
        {{ $client->Person->pers_tipoid }} {{ $client->Person->pers_identif }}
    </td>
    <td>
        {{ $client->Person->pers_direccion }} <br>
        {{ $client->Person->City->ciud_nombre }} - {{ $client->Person->State->dpto_nombre }}
    </td>
    <td>                                       
        <b>TEL: </b>{{ $client->Person->pers_telefono }}<br>
        <b>EMAIL: </b>{{ $client->Person->pers_email }}
                                  
    </td>

    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createClient( {{ $client->id }},true)" type="button">
                <i class="fas fa-eye"></i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn btn-primary mr-1"
                onclick="createClient({{ $client->id }},false,'{{ $client->Person->pers_tipoid }}')"
                type="button">
                <i class="fas fa-edit"></i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn btn-danger"
                onclick="deleteClient({{ $client->id }},'tr_{{ $client->id }}')"
                type="button">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </td>
</tr>
@endforeach