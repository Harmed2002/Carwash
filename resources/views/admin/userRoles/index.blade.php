@extends('layouts.app')
<!-- , ['iFrameEnabled' => true] -->


@section('content_header')
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
    <h1>
        Listado de usarios asociado a roles
    </h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary" onclick="createUserRole()" type="button">
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
                                            Usuarios
                                        </th>
                                        <th>
                                            Roles
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_userRole" name="tbody_userRole">
                                    @foreach ($userRoles as $userRole)
                                        <tr id="tr_{{ $userRole->id }}">
                                            <td>
                                                {{ $userRole->user->name }}
                                            </td>
                                            <td>
                                                {{ $userRole->role->name }}
                                            </td>
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-info mr-1"
                                                        onclick="createUserRole({{ $userRole->role_id }},{{ $userRole->model_id }}, true)" type="button">
                                                        <i class="fas fa-eye">
                                                        </i>
                                                    </button>
                                                    @if ($userRole->id != 1)
                                                        <button class="btn btn-primary mr-1"
                                                            onclick="createUserRole({{ $userRole->role_id }},{{ $userRole->model_id }},false)" type="button">
                                                            <i class="fas fa-edit">
                                                            </i>
                                                        </button>
                                                    @endif
                                                    @if ($userRole->id != 1)
                                                        <button class="btn btn-danger"
                                                            onclick="deleteUserRole({{ $userRole->user->id }},{{$userRole->role->id  }},'tr_{{ $userRole->id }}')"
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
                            <div class="offset-md-5"> {!! $userRoles->links() !!} </div>
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
