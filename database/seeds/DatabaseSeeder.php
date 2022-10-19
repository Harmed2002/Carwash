<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        // DB::unprepared(file_get_contents(__DIR__ . '/sql/datos.sql')); 
        $this->call(DeleteTableSeeder::class);

        // $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        // $this->call(AdminTableSeeder::class);

        $this->call(UserRoleTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
    }
}
