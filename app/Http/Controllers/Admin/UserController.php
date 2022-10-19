<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\RoleModel;
use App\Models\Admin\UserModel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class UserController extends Controller {
    public function index(Request $request) {
        $user = Auth::user();
        if (!$user->can('Lista de usuarios')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }
        $users = UserModel::listUsers();
        return view('admin.users.index', compact('users'));
        // return view('admin.users.asset.indexLoad', compact('users'));
    }
    public function form(Request $request) {
        $roles =  Role::all();
        $user = Auth::user();
        if (!$user->can('Formulario de usuarios')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }
        $user = UserModel::getUser($request->idUser);
        

        if (isset($request->show) && $request->show == 'true') {

            return view('admin.users.asset.show', compact('user'));
        } else {

            return view('admin.users.asset.form', compact('user','roles'));
        }

    }
    public function save(Request $request) {
      
        $user = Auth::user();
        if (!$user->can('Guardar usuarios')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }

        $edit      = $request->id != 0 ? true : false;
        $data      = $request->all();
        $data["usua_creacion"] = Auth::user()->name;
        $validator = UserModel::getValidator($data, $edit);

        if ($validator->fails()) {

        return response()->json(array('errors' =>$validator->errors()),500);

        }

        $user = UserModel::saveUser($data);
        $userSync = UserModel::getUser($user->id);
    
        $userSync->roles()->sync($request->input('roles', []));

        // Codigo para actualización
        $users  = UserModel::listUsers();

        return view('admin.users.asset.trUsers')->with('users', $users);

        // return response()->json($user);
    }
    public function delete(Request $request) {
        $user = Auth::user();
        if (!$user->can('Eliminar usuarios')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }
        $user = UserModel::getUser($request->idUser);
        $user->delete();
    }
}
