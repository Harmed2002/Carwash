<b>Placa:</b> {{ $vehicle->vehi_placa }}
<br>
<b>Propietario:</b>
    {{ $vehicle->Client->Person->pers_primernombre . ' ' . $vehicle->Client->Person->pers_segnombre ?? '' . ' ' . $vehicle->Client->Person->pers_primerapell . ' ' . $vehicle->Client->Person->pers_segapell ?? '' . $vehicle->Client->Person->pers_razonsocial ?? ''}}
    {{ $vehicle->Client->Person->pers_tipoid }} {{ $vehicle->Client->Person->pers_identif }}
<br>
<b>Características:</b> {{ $vehicle->ModelsVehicle->VehicleType->tive_nombre }}
                        <b>Marca:</b> {{ $vehicle->ModelsVehicle->Brands->vebr_marca }}
                        <b>Modelo:</b> {{ $vehicle->ModelsVehicle->vemo_modelo }}
<br>
<b>Año:</b> {{ $vehicle->vehi_anio }}
<br>
<b>Observación:</b> {{ $vehicle->vehi_obs }}
<br>

<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>