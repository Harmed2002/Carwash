<?php

namespace App\Models\Admin;

use Validator;
// app includes

use Spatie\Permission\Models\Role;
// use App\Models\Admin\RoleSystem;

/**
 * Querys for Role Table
 */
class RoleModel {

    /**
     * Get all roles
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Roles
     */
    public static function listRole($paginate = 8, $search = null) {

        $role = Role::query();
        // $role->whereNull('deleted_at');
        // $role->orderBy('name');
        // if ($search) {
        //     $role->where(function ($sbQuery) use ($search) {
        //         $sbQuery->where('name', 'LIKE', "%$search%");
        //     });
        // }

        return $role->get();
    }

    /**
     * get a role by id
     * @param integer $role id from database
     * @return Object Role FormRole
     */
    public static function getRole($idRole) {
        $role = Role::find($idRole);

        return $role;
    }

    /**
     * get validator for roles
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data, $edit = false) {

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            // 'guard_name' => ['required', 'string', 'max:255'],
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
     * save role
     * @param type $data information from form
     * @return Object Role
     */
    public static function saveRole($data) {
      
        $role = Role::find($data['id']);
  
        if ($role) {
            $role->update($data);
        } else {
            // dd( is_array($data));
            $role = new Role;
            $role->name = $data['name'];
            $role->guard_name = 'web';
            $role->save();
            
            
            // create($data);
        }
        return $role;
    }
}
