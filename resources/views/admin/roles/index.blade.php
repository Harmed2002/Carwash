@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de roles')

@section('content_header')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">

@stop

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h1 class="card-title"><b> Listado de roles</b></h1>
        </div>

        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap4">
                @can('Formulario de roles')
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-2">
                            <button class="btn btn-primary" onclick="createRole()" type="button">
                                Crear
                            </button>
                        </div>
                    </div>
                @endcan

                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table" id="table-rols">
                                <thead class="table-primary">
                                    <tr>
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Nombre
                                        </th>
                                        {{-- <th>
                                            Guardían
                                        </th> --}}
                                        <th>
                                            Permisos
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_role" name="tbody_role">
                                    @foreach ($roles as $role)
                                        <tr id="tr_{{ $role->id }}">
                                            <td>
                                                {{ $role->id }}
                                            </td>
                                            <td>
                                                {{ $role->name }}
                                            </td>
                                            {{-- <td>
                                                {{ $role->guard_name }}
                                            </td> --}}
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#modalGeneral"
                                                    onclick="modalPermission({{ $role->permissions }}, 'Permisos del rol')">
                                                    {{ count($role->permissions) }}
                                                </button>
                                                {{-- @foreach ($role->permissions as $permission)
                                                    <span
                                                        class="right badge badge-primary mt-2">{{ $permission->name }}</span>
                                                @endforeach --}}
                                            </td>
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    @can('Formulario de roles')
                                                        <button class="btn btn-info mr-1 btn-sm"
                                                            onclick="createRole({{ $role->id }},'true')" type="button">
                                                            <i class="fas fa-eye">
                                                            </i>
                                                        </button>
                                                    @endcan
                                                    {{-- @if ($role->id != 1) --}}
                                                    @can('Formulario de roles')
                                                        <button class="btn btn-primary mr-1 btn-sm"
                                                            onclick="createRole({{ $role->id }},'false')" type="button">
                                                            <i class="fas fa-edit">
                                                            </i>
                                                        </button>
                                                    @endcan
                                                    {{-- @endif --}}
                                                    @can('Eliminar de roles')
                                                        @if ($role->id != 1)
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="deleteRole({{ $role->id }},'tr_{{ $role->id }}')"
                                                                type="button">
                                                                <i class="fas fa-trash">
                                                                </i>
                                                            </button>
                                                        @endif
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <divclass="offset-md-5">!!$roles->links()!!</div> --}}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@stop
@include('layouts.modal')
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/admin/validate.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
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
