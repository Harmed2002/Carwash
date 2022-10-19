<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\RoleModel;
use App\Models\Admin\UserModel;
use App\Models\Admin\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

// $role->syncPermissions($permissions);
// $permission->syncRoles($roles);
// $role->revokePermissionTo($permission);
// $permission->removeRole($role);

class UserRolController extends Controller {
    public function index(Request $request) {

        $user = Auth::user();
        if (!$user->can('Lista de asociación de usuario y roles')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }
        $userRoles = UserRole::paginate(10);
        return view('admin.userRoles.index', compact('userRoles'));
    }

    public function form(Request $request) {

        $user = Auth::user();
        if (!$user->can('Formulario de asociación de usuario y roles')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }

        $userRole = UserRole::where('role_id', $request->role_id)
            ->where('model_id', $request->model_id)->first();

        $users = UserModel::listUsers();
        $roles = RoleModel::listRole();

        if (isset($request->show) && $request->show == 'true') {
            return view('admin.userRoles.show', compact('userRole'));
        } else {

            return view('admin.userRoles.form', compact('userRole', 'users', 'roles'));
        }
    }

    public function save(Request $request) {
        $user = Auth::user();
        if (!$user->can('Guardar de asociación de usuario y roles')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }

        $userRole = UserRole::find($request->id);

        if (is_null($userRole)) {

            foreach ($request->role_id as $role)
                DB::table('model_has_roles')->insert([
                    [
                        'model_id' => $request->model_id,
                        'role_id' => $role,
                        'model_type' => 'App\\Models\\Admin\\User'
                    ],

                ]);
        } else {

            DB::update('update model_has_roles set model_id=?,role_id=? where model_id = ?  AND role_id =?', [$request->model_id, $request->role_id, $request->id_model, $request->id_role]);
        }

        $userRoles = UserRole::orderBy('id','DESC')->paginate(7);

        return view('admin.userRoles.trUserRole')->with('userRoles', $userRoles);
    }
    function delete(Request $request) {
        $user = Auth::user();
        if (!$user->can('Eliminar asociación de usuario y roles')) {
            // compact('permissions')
            return view('paginateErrors.403');
        }
        // $role = RoleModel::getRole($request->idRole);
        DB::delete('delete from model_has_roles where model_id = ? and  role_id = ?', [$request->id_user, $request->id_role]);
        // $role->delete();
    }
}
