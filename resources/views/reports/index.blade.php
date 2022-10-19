@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Reportes de tanqueo')

@section('content_header')

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">

@stop

@section('content')
    @include('layouts.alert')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info mt-2">
                    <div class="card-header">
                        <h1 class="card-title"><b>Reportes de tanqueo</b></h1>
                    </div>
                    <div class="card-body p-0" style="display: block;">
                        <form class="form-horizontal form-report" action="{{ route('reports') }}">
                            <div class="row pt-4 pl-4 pb-4 pr-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <span class="info-box-text">Tipo origen del tanqueo</span>
                                        <select class="form-control select3" name="tanq_origen" id="tanq_origen_inventory">
                                            <option selected></option>
                                            <option value="CT">CT - CARROTANQUE</option>
                                            <option value="CB">CB - CUBITANQUE</option>
                                            <option value="ES">EX - EXTERNO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <span class="info-box-text">Vehiculo tanqueado (Placa)</span>
                                    <select class="form-control select3" name="search" id="search">
                                        <option value=""></option>
                                        @foreach ($machines as $machine)
                                            <option value="{{ $machine->maqn_placa }}">{{ $machine->maqn_placa }} -
                                                {{ $machine->MachineType->tmaq_nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" name="search" class="form-control" placeholder="Vehiculo tanqueado (Placa)"
                                autocomplete="off"> --}}
                                </div>
                                <div class="col-md-4">
                                    <span class="info-box-text">Vehiculo origen del tanqueado (Placa)</span>
                                    <select class="form-control select3" name="searchOrigin" id="searchOrigin">
                                        <option value=""></option>
                                        @foreach ($machines as $machine)
                                            <option value="{{ $machine->maqn_placa }}">{{ $machine->maqn_placa }} -
                                                {{ $machine->MachineType->tmaq_nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" name="searchOrigin" class="form-control" value="" autocomplete="off"
                                placeholder="Origen del tanqueado (Placa)"> --}}
                                </div>
                                <div class="col-md-4">
                                    <span class="info-box-text">Unidad</span>
                                    <select class="form-control select3" name="tanq_unidad" id="tanq_unidad">
                                        <option value="LT">LT - LITRO</option>
                                        <option value="MC">MC - METRO CUBICO </option>
                                        <option value="Gl">GL - GALONES </option>
                                    </select>
                                    {{-- <input type="" name="dateEnd" class="form-control datepicker" autocomplete="off"> --}}
                                </div>
                                <div class="col-md-3">
                                    <span class="info-box-text">Fecha inicial</span>
                                    <input type="date" name="dateStart" class="form-control datepicker" autocomplete="off">
                                </div>
                                <div class="col-md-3">
                                    <span class="info-box-text">Fecha final</span>
                                    <input type="date" name="dateEnd" class="form-control datepicker" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <span class="info-box-text mb-4">Acción</span><br>
                                    <button class="btn btn-primary btn-sm"><i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                    <button class="btn btn-secondary btn-sm"><i class="fa fa-eraser"
                                            aria-hidden="true"></i></button>
                                    <a class="btn btn-danger btn-sm" onclick="downloadPdf()" target="_blank"><i
                                            class="fa fa-file-pdf" aria-hidden="true"></i></a>

                                    {{--  --}}
                                </div>
                                {{-- href="{{ route('reportDocument',['tanq_origen'=>$request->tanq_origen,'search'=>$request->search,'searchOrigin'=>$request->searchOrigin,'tanq_unidad'=>$request->tanq_unidad,'dateStart'=>$request->dateStart,'dateEnd'=>$request->dateEnd]) }} --}}
                                {{-- </div> --}}
                            </div>
                        </form>
                    </div>
                {{--  </div>
                <div class="col-md-12">
                    <div class="card card-info mt-2 ">  --}}
                        <hr>
                        <div class="card-body p-0 pt-2 pl-4 pr-4 pb-4">
                            <div class="table-responsive">
                                <table class="table" id="table-report-tanking">
                                    <thead class="table-primary">
                                        <tr class="text-center">
                                            <th>Vehiculo</th>
                                            <th>Placa</th>
                                            <th>Origen</th>
                                            <th>Volumén</th>
                                            <th>Unidad</th>
                                            <th>Remisión</th>
                                            <th>Usuario</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inventories as $inventory)
                                            <tr class="text-center">

                                                <td>
                                                    {{ $inventory->Machine->MachineType->tmaq_nombre ?? '' }}
                                                </td>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@section('js')

    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/inventory/functions.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.colVis.min.js') }}"></script>

@endsection
