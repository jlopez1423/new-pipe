<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Client', 10)->create()->each(function( $client ){
            factory('App\Project', 5)->create( ['client_id' => $client->id ] )->each( function( $project ){
                DB::table('project_user')->insert( [ 'project_id'=> $project->id, 'user_id' => 1 ] );
                factory('App\Task', 10)->create( ['project_id' => $project->id ] )->each( function( $task ){
                    DB::table('task_user')->insert( ['task_id' => $task->id, 'user_id' => 11, 'created_at' => Carbon::now() ] );
                    DB::table('task_user')->insert( ['task_id' => $task->id, 'user_id' => 1, 'created_at' => Carbon::now() ] );
                });
            } );
        });
    }
}
