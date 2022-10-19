@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Lista de remisiones')

@section('content_header')

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">

    <h1>
       
    </h1>
@stop

@section('content')
    @include('layouts.alert')
    <form class="form-horizontal idRemissionReport" action="{{ route('reportRemissions') }}">
       <div class="card card-info">
            <div class="card-header">
                <h1 class="card-title"><b> Generación de reportes de remisiones</b></h1>
            </div>
    
            <div class="row pt-4 pl-4 pb-4 pr-4">
                <div class="col-md-3">
                    <div class="form-group">
                        <span class="info-box-text">Obras</span>
                        <select class="form-control select3" name="idConstruction" id="idConstruction">
                            <option selected></option>
                            @foreach ($constructions as $construction)
                                <option value="{{ $construction->id }}">{{ $construction->obra_nombre }}</option>
                            @endforeach


                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span class="info-box-text">Clientes</span>
                        <select class="form-control select3" name="idClient" id="idClient">
                            <option selected></option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->Person->pers_razonsocial }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <span class="info-box-text">Fecha inicial</span>
                    <input type="date" name="dateStart" class="form-control" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <span class="info-box-text">Fecha final</span>
                    <input type="date" name="dateEnd" class="form-control" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <span class="info-box-text">Estado</span>
                    <select class="form-control select3" name="stateInvoice" id="stateInvoice">
                        <option value="">Seleccionar un estado</option>
                        <option value="1">Con factura</option>
                        <option value="0">Sin factura</option>
                    </select>
                </div>
                <div class="col-md-3 ">
                    <span class="info-box-text">Acciones</span><br>
                    <button class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true" title="Buscar"></i></button>
                    <button class="btn btn-secondary btn-sm"><i class="fa fa-eraser" aria-hidden="true" title="Limpiar filtro"></i></button>
                    <a class="btn btn-danger btn-sm" onclick="downloadRemissionPdf()" target="_blank" title="Generar pdf"><i class="fa fa-file-pdf" aria-hidden="true"></i></a>

                </div>
            </div>
            <div class="card-body p-0 mr-4 ml-4 mb-4" style="display: block;">
                <div class="table-responsive">
                    <table class="table" id="table-report">
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Obra</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Número interno</th>
                                <th scope="col">Detalle</th>
                                {{-- <th scope="col">Suministro</th>
                                <th scope="col">Transporte</th> --}}
                                {{-- <th scope="col">Inv Inicial</th>
                                <th scope="col">- Vendido</th>
                                <th scope="col">+ Ingresado Manual</th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($remissions as $remission)
                                <tr class="text-center">
                                    <td> {{ $remission->id }}</td>
                                    <td> {{ $remission->Construction->obra_nombre }}</td>
                                    <td>{{ $remission->Construction->Client->Person->pers_razonsocial }}</td>
                                    <td>{{ $remission->remi_numfactura == '' ? 'Sin factura':'Con factura #'.$remission->remi_numfactura }}</td>
                                    <td>{{ $remission->num_remission  }}</td>
                                  
                                    <td>
                                        <a class="btn btn-success mb-2 btn-sm" onclick="detailRemission({{ $remission->id }})">
                                            Detalle
                                        </a>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                    {{-- <div class="offset-md-5"> {!! $materialInventory->links() !!} </div> --}}
                </div>
            </div>
        </div>
    </form>
@endsection
@include('layouts.modal')
@section('js')
    <script src="{{ asset('js/plugins/select2.min.js') }}">
    </script>
    <script src="{{ asset('js/report/functions.js') }}">
    </script>
    <script src="{{ asset('js/util.js') }}">
    </script>
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    {{--  <script src="{{ asset('js/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.colVis.min.js') }}"></script>  --}}
@endsection
