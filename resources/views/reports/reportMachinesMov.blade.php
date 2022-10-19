@php
$total = 0;
@endphp
@foreach ($machinesMovs as $key => $mov)
    <table>
        <thead class="table-primary">
            {{--  <tr ><th width="500px">HOLA</th></tr>  --}}
            <tr>
        
                <th width="170px" style="text-align:center"><b>Fecha</b></th>
                <th width="170px" style="text-align:center"><b>Maquina placa</b></th>
                <th width="100px" style="text-align:center"><b>Hora inicial</b></th>
                <th width="100px" style="text-align:center"><b>Hora final</b></th>
                <th width="100px" style="text-align:center"><b>Horas</b></th>
                <th width="100px" style="text-align:center"><b>Valor hora</b></th>
                <th width="100px" style="text-align:center"><b>Total dia</b></th>
                {{-- <th width="300px" style="text-align:center"><b>Observaciones</b></th>
            <th width="100px" style="text-align:center"><b>Gatos</b></th> --}}
            </tr>
        </thead>
        <tbody>
        
            <tr style="text-align:center">
                <td style="text-align:center">{{ $mov->mqmv_fecha }}</td>
                <td style="text-align:center">{{ $mov->Machine->maqn_placa }}</td>
                <td style="text-align:center">{{ $mov->mqmv_hinicio }}</td>
                <td style="text-align:center">{{ $mov->mqmv_hfin }}</td>
                <td style="text-align:center">
                    {{ (int) $mov->mqmv_hfin - (int) $mov->mqmv_hinicio }}
                </td>
                <td style="text-align:center">
                    {{ $mov->mqmv_vlrhora }}
                </td>
                <td style="text-align:center">
                    {{ $mov->mqmv_vlrhora * ((int) $mov->mqmv_hfin - (int) $mov->mqmv_hinicio) }}</td>
            </tr>
        </tbody>
    </table>
    @if ($mov->Machine->Tankmachines)
        @foreach ($mov->Machine->Tankmachines as $keyMachine => $tankMachine)
            @if ($tankMachine->tanq_fecha == $mov->mqmv_fecha)
                <table>
                    <thead class="table-primary">
                        <tr>
                            <th width="100px" style="text-align:center"><b>Fecha</b></th>
                            <th width="100px" style="text-align:center"><b>Maquina placa</b></th>
                            <th width="100px" style="text-align:center"><b>Acpm</b></th>
                            <th width="170px" style="text-align:center"><b>Valor galón</b></th>
                            <th width="170px" style="text-align:center"><b></b></th>
                            <th width="170px" style="text-align:center"><b></b></th>
                            <th width="100px" style="text-align:center"><b>Total tanqueo</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align:center">{{ $tankMachine->tanq_fecha }} </td>
                            <td style="text-align:center">{{ $mov->Machine->maqn_placa }} </td>
                            <td style="text-align:center">{{ $tankMachine->tanq_volumen }} </td>
                            <td style="text-align:center">{{ $tankMachine->Fuelsshopping->ccmb_vlrunidad }} </td>
                            <td></td>
                            <td></td>
                            <td style="text-align:center">{{ $tankMachine->tanq_volumen * $tankMachine->Fuelsshopping->ccmb_vlrunidad }} </td>
                        </tr>
                    </tbody>
                </table>
            @endif
        @endforeach
    @endif
@endforeach
