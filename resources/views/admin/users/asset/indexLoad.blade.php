<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de usuario')

@section('content_header')

@stop

@section('content')
   
@stop
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
<link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
<h3>
    Listado de usuarios
</h3>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary" onclick="createUser({{ null }},{{ null }})" type="button">
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
                                        Nombre
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Rol
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
                                                {{ $role->name }},
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $user->usuacreacion }}
                                        </td>
                                        <td>
                                            {{ $user->created_at }}
                                        </td>
                                        <td class="text-right py-0 align-middle">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-info mr-1"
                                                    onclick="showUser({{ $user }})" type="button">
                                                    <i class="fas fa-eye">
                                                    </i>
                                                </button>
                                                @if ($userAuth->id != $user->id)
                                                    <button class="btn btn-primary mr-1"
                                                        onclick="editUser({{ $user }})" type="button">
                                                        <i class="fas fa-edit">
                                                        </i>
                                                    </button>
                                                @endif
                                                @if ($userAuth->id != $user->id)
                                                    <button class="btn btn-danger"
                                                        onclick="deleteUser({{ $user->id }},'tr_{{ $user->id }}')"
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
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            </br>
        </div>
    </div>
</section>
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
    <script src="{{ asset('js/util.js') }}">
    </script>
@stop