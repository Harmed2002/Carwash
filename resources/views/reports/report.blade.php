<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

{{-- <head>Reporte de cantera</head> --}}
<style>
    .page-break {
        page-break-after: always;
    }

    @page {
        margin: 0cm 0cm;
        font-family: Arial;

    }

    body {
        margin: 3cm 2cm 2cm;

    }

    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 1cm;
        background-color: #343a40;
        color: white;
        text-align: center;
        line-height: 25px;
    }

    .table .thead-dark th {
        color: #fff;
        background-color: #343a40;
        border-color: #32383e;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
        text-align: center;
    }

    .table td,
    .table th {
        padding: 0.20rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
        font-size: 12px;
    }

    th {
        text-align: inherit;
    }

    *,
    ::after,
    ::before {
        box-sizing: border-box;
    }

    th {
        display: table-cell;
        vertical-align: inherit;
        font-weight: bold;
        text-align: -internal-center;
    }

    table {
        border-collapse: collapse;
    }

    table {
        border-collapse: separate;
        text-indent: initial;
        border-spacing: 2px;
        text-align: center;
        text-transform:uppercase;
    }

    /* footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
            background-color:#343a40;
            color: white;
            text-align: center;
            line-height: 10px;
        } */

</style>
{{-- <head>Reporte {{ $date }}</head> --}}
<body>
    <div style="padding:0px 0px 10px 0px">
    <b> Fecha: </b>{{ $date }}<br>
    <b> Usuario: </b>{{ $user->name}}
    <br>
    </div>
     <header>
        Reporte de cantera

      
    </header> 

    <table class="table" id="table-inventory">
        <thead class="thead-dark">

            <tr>

                <th scope="col">Vehiculo</th>
                <th scope="col">Placa</th>
                <th scope="col">Origen</th>
                <th scope="col">Volumén</th>
                <th scope="col">Unidad</th>


                <th scope="col">Remisión</th>
                <th scope="col">Usuario</th>
                <th scope="col">Fecha</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($inventories as $inventory)
                <tr>

                    <td>
                        {{ $inventory->Machine->MachineType->tmaq_nombre ?? '' }}</td>
                    <td>{{ $inventory->Machine->maqn_placa ?? '' }}</td>
                    <td>
                        {{ $inventory->MachineCub->MachineType->tmaq_nombre ?? '' }}
                        <b>{{ $inventory->MachineCub->maqn_placa ?? 'Carrotaque' }}</b>
                    </td>
                    <td> {{ $inventory->tanq_volumen }}</td>
                    <td>{{ $inventory->tanq_unidad }}</td>


                    <td>{{ $inventory->Fuelsshopping->ccmb_numremision ?? '' }}</td>
                    <td>{{ $inventory->User->name ?? '' }}</td>
                    <td>{{ $inventory->created_at ?? '' }}</td>


                </tr>
            @endforeach
        </tbody>
    </table>

</body>
{{-- <footer>
    <h1>Sistema cantera</h1>
</footer> --}}

</html>
<script type="text/php">
    if (isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(270, 730, "Pagina $PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }
    </script>