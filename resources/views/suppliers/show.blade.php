
<b>Identificación:</b> {{ $supplier->Person->pers_tipoid }} {{ $supplier->Person->pers_identif}}<br>
<b>Razón social / Nombre:</b> 
    {{ $supplier->Person->pers_razonsocial }} {{ $supplier->Person->pers_primerapell }}
    {{ $supplier->Person->pers_segapell }} {{ $supplier->Person->pers_primernombre }}
    {{ $supplier->Person->pers_segnombre }}
<br>
<b>Dirección:</b> {{ $supplier->Person->pers_direccion }}<br>
<b>Departamento:</b> {{ $supplier->Person->City->State->dpto_nombre }} <b>Ciudad:</b> {{ $supplier->Person->City->ciud_nombre }}<br>
<b>Teléfono:</b> {{ $supplier->Person->pers_telefono }} <b>Email:</b> {{ $supplier->Person->pers_email }}
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>