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
<head><title>Reporte de remisiones {{ $date }}</title></head>

<body>
    <div style="padding:0px 0px 10px 0px">
        <b> Fecha: </b>{{ $date }}<br>
        <b> Usuario: </b>{{ $user->name }}
        <br>
    </div>
    <header>
        Reporte de remisiones


    </header>

    <table class="table" id="table-inventory">
        <thead class="table-primary">
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">Obra</th>
                <th scope="col">Cliente</th>
                <th scope="col" colspan="10">Detalle</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($remissions as $remission)
                <tr class="text-center">
                    <td> {{ $remission->id }}</td>
                    <td> {{ $remission->Construction->obra_nombre }}</td>
                    <td>{{ $remission->Construction->Client->Person->pers_razonsocial }}</td>
                    <td>   <table class="table">
                        <thead class="table-primary">
                            <tr>
                                <th>
                                    Material
                                </th>
                                <th>
                                    Cant
                                </th>
                                <th>
                                    Und
                                </th>
                                <th>
                                    P/U
                                </th>
                                <th>
                                    SUBTOTAL
                                </th>
                                <th>
                                    Suministro
                                </th>
                                <th>
                                    Transporte
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($remission->detailRemissions as $detail)
                                {{-- {{ $detail->Material->mate_descripcion }} --}}
                                <tr>

                                    <td>
                                        {{ $detail->Material->mate_descripcion }}
                                    </td>
                                    <td>
                                        {{ $detail->dtrm_cantdespachada }}
                                    </td>
                                    <td>
                                        {{ $detail->Unit->unit_descripcion }}
                                    </td>
                                    <td>
                                        {{ $detail->dtrm_precio }}
                                    </td>
                                    <td>
                                        {{ $detail->dtrm_cantdespachada * $detail->dtrm_precio }}
                                    </td>
                                    <td>
                                        {{ ($detail->dtrm_cantdespachada * $detail->dtrm_precio * $remission->Construction->obra_porcsuministro) / 100 }}
                                    </td>
                                    <td>
                                        {{ ($detail->dtrm_cantdespachada * $detail->dtrm_precio * $remission->Construction->obra_porctransporte) / 100 }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
</td>
                    {{-- <td>

                        @foreach ($remission->detailRemissions as $detail)
                            <tr>
                                <td>
                                    {{ $detail->Material->mate_descripcion }}
                                </td>
                                <td>
                                    {{ $detail->dtrm_cantdespachada }}
                                </td>
                                <td>
                                    {{ $detail->Unit->unit_sigla }}
                                </td>
                                <td>
                                    {{ $detail->dtrm_precio }}
                                </td>
                                <td>
                                    {{ $detail->dtrm_cantdespachada * $detail->dtrm_precio }}
                                </td>
                                <td>
                                    {{ ($detail->dtrm_cantdespachada * $detail->dtrm_precio * $remission->Construction->obra_porcsuministro) / 100 }}
                                </td>
                                <td>
                                    {{ ($detail->dtrm_cantdespachada * $detail->dtrm_precio * $remission->Construction->obra_porctransporte) / 100 }}
                                </td>
                            <tr>
                        @endforeach
                    </td> --}}

                </tr>
            @endforeach
            {{-- @foreach ($remission->detailRemissions as $detail)
             
                <tr>

                    <td>
                        {{ $detail->Material->mate_descripcion }}
                    </td>
                    <td>
                        {{ $detail->dtrm_cantdespachada }}
                    </td>
                    <td>
                        {{ $detail->Unit->unit_descripcion }}
                    </td>
                    <td>
                        {{ $detail->dtrm_precio }}
                    </td>
                    <td>
                        {{ $detail->dtrm_cantdespachada * $detail->dtrm_precio }}
                    </td>
                    <td>
                        {{ ($detail->dtrm_cantdespachada * $detail->dtrm_precio * $remission->Construction->obra_porcsuministro) / 100 }}
                    </td>
                    <td>
                        {{ ($detail->dtrm_cantdespachada * $detail->dtrm_precio * $remission->Construction->obra_porctransporte) / 100 }}
                    </td>
                </tr>
            @endforeach --}}

        </tbody>

    </table>

</body>

</html>
<script type="text/php">
    if (isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(270, 730, "Pagina $PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }
    </script>
