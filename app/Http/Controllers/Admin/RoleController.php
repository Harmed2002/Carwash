<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PermissionModel;
use Illuminate\Http\Request;

use App\Models\Admin\RoleModel;
use  Auth;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller {
    public function index(Request $request) {
        $user = Auth::user();
        if (!$user->can('Lista de roles')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }
        $roles = RoleModel::listRole();
        $permissions = PermissionModel:: listPermission();
        return view('admin.roles.index', compact('roles','permissions'));
    }
    public function form(Request $request)
    {
        $user = Auth::user();
        if (!$user->can('Formulario de roles')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }

        $role= RoleModel::getRole($request->idRole);
       
        if (isset($request->show) && $request->show == 'true') {

            return view('admin.roles.asset.show', compact('role'));
        } else {
            $permissions = Permission::all();
            return view('admin.roles.asset.form', compact('role','permissions'));
        }
    }
    public function save(Request $request) {
        $user = Auth::user();
        if (!$user->can('Guardar roles')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }

        $edit      = $request->id != 0 ? true : false;
        $data      = [];
        $data['id']     = $request->id;
        $data['name']      = $request->name;
        // $data["guard_name"]="web";
        $validator = RoleModel::getValidator($data, $edit);

        if ($validator->fails()) {
      
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); //get the data in all input formfields

        }

        $role =RoleModel::saveRole($data);
        $roleSync = RoleModel::getRole($role->id);
    
        $roleSync->permissions()->sync($request->input('permissions', []));
        $roles = RoleModel::listRole();

        return view('admin.roles.asset.trRoles')->with('roles', $roles);
    }
    function delete(Request $request) {
        $user = Auth::user();
        if (!$user->can('Eliminar roles')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }
        $role = RoleModel::getRole($request->idRole);
        $role->delete();
    }
}
