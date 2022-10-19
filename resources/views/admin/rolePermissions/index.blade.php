@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de usuario')

@section('content_header')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
    <h1>
        Listado de roles asociados a permisos
    </h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary" onclick="createRolePermission()" type="button">
                    Crear
                </button>
                <br>
                <div class="card card-info mt-2">
                    <div class="card-body p-0" style="display: block;">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-primary">
                                    <tr>
                                        <th>
                                            Rol
                                        </th>
                                        <th>
                                            Permiso
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_rolePermisions" name="tbody_rolePermisions">
                                    @foreach ($rolePermissions as $key => $rolePermission)
                                        <tr id="tr_{{ $key }}">
                                            <td>
                                                {{ $rolePermission->role->name }}
                                            </td>

                                            <td>
                                                @foreach ($rolePermission->role->permissions as $permission)
                                                <span class="right badge badge-primary">{{ $permission->name }}</span>   
                                                @endforeach
                                            </td>
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-info mr-1"
                                                        onclick="createRolePermission({{ $rolePermission->permission_id }},{{ $rolePermission->role_id }}, 'true')"
                                                        type="button">
                                                        <i class="fas fa-eye">
                                                        </i>
                                                    </button>
                                                    @if ($rolePermission->id != 1)
                                                        <button class="btn btn-primary mr-1"
                                                            onclick="createRolePermission({{ $rolePermission->permission_id }},{{ $rolePermission->role_id }},'false')"
                                                            type="button">
                                                            <i class="fas fa-edit">
                                                            </i>
                                                        </button>
                                                    @endif
                                                    @if ($rolePermission->id != 1)
                                                        <button class="btn btn-danger"
                                                            onclick="deleteRolePermission({{ $rolePermission->role->id }},{{ $rolePermission->permission->id }},'tr_{{ $key }}')"
                                                            type="button">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="offset-md-5"> {!! $rolePermissions->links() !!} </div>
                           
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                </br>
            </div>
        </div>
    </section>
@stop
@include('layouts.modal')
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}">
    </script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}">
    </script>
    <script src="{{ asset('js/admin/validate.js') }}">
    </script>
    <script src="{{ asset('js/admin/admin.js') }}">
    </script>

    <script src="{{ asset('js/plugins/select2.min.js') }}">
    </script>
    <script src="{{ asset('js/util.js') }}">
    </script>
@stop
