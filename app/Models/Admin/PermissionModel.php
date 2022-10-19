<?php

namespace App\Models\Admin;

use Validator;
// app includes
use Spatie\Permission\Models\Permission;
// use App\Models\Admin\Permission;

/**
 * Querys for Permission Table
 */
class PermissionModel {

    /**
     * Get all permissions
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Permissions
     */
    public static function listPermission($paginate = 10, $search = null) {

        $permission = Permission::query();
        // $permission->whereNull('deleted_at');
        // $permission->orderBy('name');

        // if ($search) {
        //     $permission->where(function ($sbQuery) use ($search) {
        //         $sbQuery->where('name', 'LIKE', "%$search%");
        //     });
        // }
        // $paginate ? $permission->paginate($paginate)
        return  $permission->get();
    }

    /**
     * get a permission by id
     * @param integer $permission id from database
     * @return Object Permission FormPermission
     */
    public static function getPermission($idPermission) {
        $permission = Permission::find($idPermission);

        return $permission;
    }

    /**
     * get validator for permissions
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data, $edit = false) {

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'guard_name' => ['required', 'string', 'max:255'],
        ]);



        // 'reputationNotes',
        $niceNames = array(
            'name' => 'Name',
            'guard_name' => 'Guard name'
        );

        $validator->setAttributeNames($niceNames);

        return $validator;
    }

    /**
     * save permission
     * @param type $data information from form
     * @return Object PermissionFormPermission
     */
    public static function savePermission($data) {
        $permission = Permission::find($data['id']);
        if ($permission) {
            $permission->update($data);
        } else {
            $permission = Permission::create($data);
        }
        return $permission;
    }
}
