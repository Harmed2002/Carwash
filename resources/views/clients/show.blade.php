<b>Identificación:</b> {{ $client->Person->pers_tipoid }} {{ $client->Person->pers_identif }}
<br>
<b>Nombre/razón social:</b>
    {{ $client->Person->pers_primerapell }} {{ $client->Person->pers_segapell }} 
    {{ $client->Person->pers_primernombre }} {{ $client->Person->pers_segnombre }}
    {{ $client->Person->pers_razonsocial }}
<br>
<b>Dirección:</b> {{ $client->Person->pers_direccion }}
<br>
<b>Departamento:</b> {{ $client->Person->State->dpto_nombre }} <b>Ciudad:</b> {{ $client->Person->City->ciud_nombre }}
<br>
<b>Teléfono:</b> {{ $client->Person->pers_telefono }} <b>Email:</b> {{ $client->Person->pers_email }}
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>