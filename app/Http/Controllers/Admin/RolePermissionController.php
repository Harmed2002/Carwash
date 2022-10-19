<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PermissionModel;
use App\Models\Admin\RoleModel;
use App\Models\Admin\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use  Auth;

class RolePermissionController extends Controller {
    public function index(Request $request) {
        $user = Auth::user();
        if (!$user->can('Lista de asociación de rol y permisos')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }
        $rolePermissions  = RolePermission::paginate(5);
        $roles = RoleModel::listRole();
        $permissions = PermissionModel::listPermission();

        return view('admin.rolePermissions.index', compact('rolePermissions', 'roles', 'permissions'));
    }
    public function form(Request $request) {

        $user = Auth::user();
        if (!$user->can('Formulario de asociación de rol y permisos')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }
        $rolePermission  = RolePermission::where('permission_id', $request->permission_id)
            ->where('role_id', $request->role_id)->first();
        $roles = RoleModel::listRole();
        $permissions = PermissionModel::listPermission();


        if (isset($request->show) && $request->show == 'true') {

            return view('admin.rolePermissions.show', compact('rolePermission'));
        } else {

            return view('admin.rolePermissions.form', compact('rolePermission', 'permissions', 'roles'));
        }
    }


    public function save(Request $request) {

        $user = Auth::user();
        if (!$user->can('Guardar asociación de rol y permisos')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }
        $rolePermission  = RolePermission::find($request->id);

        if (is_null($rolePermission)) {

            foreach ($request->permission_id as $permission) {

                DB::table('role_has_permissions')->insert([
                    [
                        'permission_id' => $permission,
                        'role_id' => $request->role_id
                    ],

                ]);
            }
        } else {

            DB::update('update role_has_permissions set permission_id=?,role_id=? where permission_id = ?  AND role_id =?', [$request->permission_id, $request->role_id, $request->id_permission, $request->id_role]);
        }


        $rolePermissions  = RolePermission::orderBy('id','DESC')->paginate(7);

        return view('admin.rolePermissions.trRolePermission')->with('rolePermissions', $rolePermissions);
    }
    function delete(Request $request) {
        $user = Auth::user();
        if (!$user->can('Eliminar asociación de rol y permisos')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }
        DB::delete('delete from role_has_permissions where permission_id = ? and  role_id = ?', [$request->id_permission, $request->id_role]);
        // $rolePermission  =RolePermission::where('permission_id',$request->id_permission)->where('role_id',$request->id_role)->first();
        // dd($rolePermission );
        // $rolePermission->delete();
    }
}
