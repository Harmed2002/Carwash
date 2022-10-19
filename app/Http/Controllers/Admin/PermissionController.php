<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PermissionModel;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpFoundation\Response;


class PermissionController extends Controller {

    public function index(Request $request) {
        $user = Auth::user();

        if (!$user->can('Lista de permisos')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }
        $permissions = PermissionModel::listPermission();

        return view('admin.permissions.index', compact('permissions'));
    }
    public function form(Request $request)
    {
        $user = Auth::user();
        if (!$user->can('Formulario de permisos')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }
      
        $permission = PermissionModel::getPermission($request->idPermission);

        if (isset($request->show) && $request->show == 'true') {

            return view('admin.permissions.asset.show', compact('permission'));
        } else {

            return view('admin.permissions.asset.form', compact('permission'));
        }
    }
    public function save(Request $request) {
        $user = Auth::user();

        if (!$user->can('Guardar permisos')) {
            return view('paginateErrors.403');
        }

        $edit      = $request->id != 0 ? true : false;
        $data      = $request->all();
        $data['guard_name']='web';
        $validator = PermissionModel::getValidator($data, $edit);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); //get the data in all input formfields

        }

        PermissionModel::savePermission($data);
        $permissions = PermissionModel::listPermission();
        return view('admin.permissions.asset.trPermissions')->with('permissions', $permissions);
    }
    public function delete(Request $request) {
        $user = Auth::user();

        if (!$user->can('Eliminar permisos')) {
            return view('paginateErrors.403');
        }
        $permission = PermissionModel::getPermission($request->idPermission);
        $permission->delete();
    }
}
