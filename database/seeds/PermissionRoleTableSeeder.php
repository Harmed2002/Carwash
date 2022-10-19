<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::where('id', '!=', 41)->get();
        $role = Role::findOrFail(1);

        foreach ($permissions as $permission){

            $role->givePermissionTo($permission->name);
        }
      

        $permissionsSuper = Permission::all();
        $roleSuper = Role::findOrFail(2);

        foreach ($permissionsSuper as $permission){

            $roleSuper->givePermissionTo($permission->name);
        }
      
    }
}
