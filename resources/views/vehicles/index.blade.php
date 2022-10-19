@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de Vehículos')

@section('content_header')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">
@stop

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h1 class="card-title"><i class="fas fa-car"></i>  Listado de Vehículos</h1>
        </div>

        <div class="card-body">
            <div  class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-6 mb-2">
                        <button class="btn btn-primary" onclick="createVehicle()" type="button">Crear</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-12 col-md-12">
                        <div class="table-responsive">
                            <table id="vehicleTable" 
                                class="table table-bordered table-striped dataTable dtr-inline">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Id</th>
                                        <th>PLaca</th>
                                        <th>Propietario</th>
                                        <th>Características</th>
                                        <th>Año</th>
                                        <th>Observaciones</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_vehicle" name="tbody_vehicle">
                                    @foreach ($vehicles as $vehicle)
                                        <tr id="tr_{{ $vehicle->id }}"
                                            @if ($vehicle->vehi_estado == 'I') style="color:#e3342f" @endif>
                                            <td>{{ $vehicle->id }}</td>
                                            <td>{{ $vehicle->vehi_placa }}</td>
                                            <td>{{ $vehicle->Client->Person->pers_primernombre }} {{ $vehicle->Client->Person->pers_segnombre ?? '' }} 
                                                {{ $vehicle->Client->Person->pers_primerapell }} {{ $vehicle->Client->Person->pers_segapell ?? '' }} {{ $vehicle->Client->Person->pers_razonsocial ?? ''}}<br>
                                                {{ $vehicle->Client->Person->pers_tipoid }} {{ $vehicle->Client->Person->pers_identif }}
                                            </td>
                                            <td><b>TIPO:</b> {{ $vehicle->ModelsVehicle->VehicleType->tive_nombre }}<br>
                                                <b>MARCA:</b> {{ $vehicle->ModelsVehicle->Brands->vebr_marca }}<br>
                                                <b>MODELO:</b> {{ $vehicle->ModelsVehicle->vemo_modelo }}<br>
                                            </td>
                                            <td>{{ $vehicle->vehi_anio }}</td>
                                            <td>{{ $vehicle->vehi_obs }}</td>

                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-info mr-1"
                                                        onclick="createVehicle({{ $vehicle->id }}, true)" type="button"><i class="fas fa-eye"></i>
                                                    </button>
                                                    <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                    <button class="btn btn-primary mr-1"
                                                        onclick="createVehicle({{ $vehicle->id }}, false, {{ $vehicle->vehi_anio }})"
                                                        type="button"><i class="fas fa-edit"></i></button>
                                                    <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                    <button class="btn btn-danger"
                                                        onclick="deleteVehicle({{ $vehicle->id }}, 'tr_{{ $vehicle->id }}' )" type="button"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@include('layouts.modal')
{{-- @include('employees.form') --}}

@section('js')
    <script src="{{ asset('js/plugins/datatables/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/admin/validate.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/vehicle/functions.js') }}"></script>

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
