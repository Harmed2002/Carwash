<?php

use Illuminate\Database\Seeder;

class DeleteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::delete("delete from Roles");
        DB::statement("ALTER TABLE Roles AUTO_INCREMENT =  1");
        // DB::delete("delete from Users");
        // DB::statement("ALTER TABLE Users AUTO_INCREMENT =  1");
        DB::delete("delete from Permissions");
        DB::statement("ALTER TABLE Permissions AUTO_INCREMENT =  1");
        DB::delete("delete from model_has_roles");
        DB::statement("ALTER TABLE model_has_roles AUTO_INCREMENT =  1");
        DB::delete("delete from role_has_permissions");
        DB::statement("ALTER TABLE role_has_permissions AUTO_INCREMENT =  1");
    }
}
