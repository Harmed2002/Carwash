@extends('adminlte::page')

@section('title', 'Listado de usuario')

@section('content_header')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')

   <div class="card card-info">
        <div class="card-header">
            <h1 class="card-title"><b>Listado de usuarios</b></h1>
        </div>

        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-6 mb-2">
                        @can('Formulario de usuarios')
                            <button class="btn btn-primary" onclick="createUser()" type="button">
                                Crear
                            </button>
                        @endcan
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-12 col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="table-user-admin">
                                <thead class="table-primary">
                                    <tr>
                                        <th>
                                            Nombre
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Roles
                                        </th>
                                        <th>
                                            Usuario creación
                                        </th>
                                        <th>
                                            Fecha creación
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_user" name="tbody_user">
                                    @foreach ($users as $user)
                                        <tr id="tr_{{ $user->id }}">
                                            <td>
                                                {{ $user->name }}
                                            </td>
                                            <td>
                                                {{ $user->email }}
                                            </td>

                                            <td>
                                                @foreach ($user->roles as $role)
                                                    <span class="right badge badge-primary mt-2">{{ $role->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ $user->usua_creacion }}
                                            </td>
                                            <td>
                                                {{ $user->created_at }}
                                            </td>
                                            <td>

                                                @can('Formulario de usuarios')
                                                    <button class="btn btn-info mr-1 btn-sm"
                                                        onclick="createUser({{ $user->id }}, 'true' )" type="button">
                                                        <i class="fas fa-eye">
                                                        </i>
                                                    </button>
                                                @endcan
                                                @can('Formulario de usuarios')
                                                    @if ($userAuth->id != $user->id)
                                                        <button class="btn btn-primary mr-1 btn-sm"
                                                            onclick="createUser({{ $user->id }},'false' )" type="button">
                                                            <i class="fas fa-edit">
                                                            </i>
                                                        </button>
                                                    @endif
                                                @endcan
                                                @can('Eliminar de usuarios')
                                                    @if ($userAuth->id != $user->id)
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="deleteUser({{ $user->id }},'tr_{{ $user->id }}')"
                                                            type="button">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                        </button>
                                                    @endif
                                                @endcan

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="offset-md-5"> {!! $users->links() !!} </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@include('layouts.modal')
{{-- @include('admin.users.asset.form') --}}
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
