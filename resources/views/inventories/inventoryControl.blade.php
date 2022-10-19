@extends('adminlte::page')
<!-- , ['iFrameEnabled' =>
true] -->
@section('title', ' Control de inventario')

@section('content_header')

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">

@stop

@section('content')
    @include('layouts.alert')
    <form class="form-horizontal" action="{{ route('inventoryControl') }}">
        <div class="card card-info ">
            <div class="card-header">
                <h1 class="card-title"><b> Control de inventario</b></h1>
            </div>
            {{--  <div class="row pt-4 pl-4 pb-4 pr-4">
                <div class="col-md-4">
                    <div class="form-group">
                        <span class="info-box-text">Tipo origen del tanqueo</span>
                        <select class="form-control select3" name="typeProduction" id="typeProduction">
                            <option selected></option>
                            <option value="I">INVENTARIO</option>
                            <option value="S">VENDIDO</option>
                            <option value="E">INGRESO MANUAL</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <span class="info-box-text">Acciones</span><br>
                    <button class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <button class="btn btn-secondary btn-sm"><i class="fa fa-eraser" aria-hidden="true"></i></button>

                </div>
            </div>  --}}
            <div class="card-body p-0 mr-6 ml-3 mb-4 mt-2" style="display: block;">
                <div class="table-responsive">
                    <table class="table" id="table-inventory-control">
                        <thead class="table-primary">
                            <tr class="text-center">
                                {{-- <th >dog</th> --}}
                                <th>Fecha</th>
                                <th>Tipo de movimiento</th>
                                <th>Material</th>
                                <th>Inv Inicial</th>
                                <th>- Vendido</th>
                                <th>+ Ingresado Manual</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materialInventory as $material)
                                <tr>
                                    <td class="text-center">{{ $material->created_at }}</td>
                                    <td class="text-center">
                                        @if ($material->typeProduction == 'S')
                                            SALIDA
                                        @elseif ($material->typeProduction == 'I')
                                            INVENTARIO
                                        @else
                                            ENTRADA
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $material->Commodity->matp_descripcion }}</td>
                                    <td class="text-center">
                                        @if ($material->typeProduction == 'I')
                                            {{ $material->prod_volumen }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($material->typeProduction == 'S')
                                            {{ $material->prod_volumen }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($material->typeProduction == 'E')
                                            {{ $material->prod_volumen }}
                                        @endif
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
@stop
