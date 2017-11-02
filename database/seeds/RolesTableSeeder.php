<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert( ['name' => 'Admin', 'created_at' => Carbon::now() ] );
        DB::table('roles')->insert( ['name' => 'User', 'created_at' => Carbon::now() ] );

        factory('App\User', 10)->create();

    }
}
