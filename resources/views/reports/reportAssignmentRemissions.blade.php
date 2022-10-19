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
        width: 100%;
        page-break-inside: avoid;
        text-transform:uppercase;

    }

    .text-center {
        text-align: center;
    }

.ma-2{
    margin-top: 2px;
    margin-bottom: 2px;
    page-break-inside: avoid;
}

</style>
{{-- <head>Reporte {{ $date }}</head> --}}

<body>
    <div style="padding:0px 0px 10px 0px">
        <b> Fecha: </b>{{ $date }}<br>
        <b> Usuario: </b>{{ $user->name }}
        <br>
    </div>
    <header>
        Reporte de cantera
    </header>

    @foreach ($remissions as $remission)
    
    <caption class="ma-2"><b>Remisión #{{$remission->id}} - {{ $remission->remi_fecha }}</b></caption>
        <table  class="table">
            <thead class="table-primary">
                <tr>
                    <th>Obra</th>
                    <th>Ident cliente</th>
                    <th>Cliente</th>
                    <th>Ident sociedad</th>
                    <th>Sociedad</th>
                    <th>#Factura</th>
                    <th>Observación</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $remission->Construction->obra_nombre ?? '' }}</td>
                    <td>
                        {{ $remission->Construction->Client->clie_identif ?? '' }}
                    </td>
                    <td>
                        {{ $remission->Construction->Client->Person->pers_razonsocial ?? '' }}
                    </td>
                    <td> {{ $remission->Society->Person->pers_identif }}</td>
                    <td>{{ $remission->Society->Person->pers_razonsocial ?? '' }}</td>
         
                    <td>{{ $remission->remi_obs }}</td>
                </tr>
            </tbody>
        </table>
                @if (count($remission->detailRemissions) > 0)
                <caption class="ma-2"><b>Detalles de remisión #{{$remission->id}}</b> </caption>
                    <table class="table" style="margin-top:5px">
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th>
                                    Id Mat
                                </th>
                                <th>
                                    Material
                                </th>
                                <th>
                                    Cant
                                </th>
                                <th>
                                    Und
                                </th>
                     

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($remission->detailRemissions as $detail)
                                <tr >
                                    <td>
                                        {{ $detail->dtrm_idmaterial }}
                                    </td>
                                    <td>
                                        {{ $detail->Material->mate_descripcion }}
                                    </td>
                                    <td>
                                        {{ $detail->dtrm_cantdespachada }}
                                    </td>
                            
                                    <td>
                                        {{ $detail->Unit->unit_descripcion }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <br>
              @if (count($remission->remissionNovelties) > 0)
                <caption class="ma-2"><b>Detalles de novedades de remisión #{{ $remission->id }}</b></caption>
                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>
                                Id Mat
                            </th>
                            <th>
                                Material
                            </th>
                            <th>
                                Concepto
                            </th>
                            <th>
                                Valor
                            </th>
                            <th>
                                Observación
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($remission->remissionNovelties as $detail)
                            <tr>
                                <td>
                                    {{ $detail->rmnv_idmaterial }}
                                </td>
                                <td>
                                    {{ $detail->Material->mate_descripcion }}
                                </td>
                                <td>
                                    {{ $detail->RemissionConcNovelty->cncn_nombre }}
                                </td>
                                <td>
                                    {{ $detail->rmnv_nuevovalor }}
                                </td>
                                <td>
                                    {{ $detail->rmnv_obs }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
                <hr>
    @endforeach


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

{{--  --}}
