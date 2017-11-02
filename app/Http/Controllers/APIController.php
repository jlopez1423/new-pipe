<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;

class APIController extends Controller
{
    private $client_id;
    private $client_secret;
    private $access_token;

    public function __construct()
    {
        $call = $this->workZoneAuth();
    }

    public function workZoneAuth()
    {

    }

    public function statusByProject()
    {

    }

    public function time(Request $request)
    {
        \DB::enableQueryLog();

        if ( $start_date = $request->input('start_date') && $end_date = $request->input('end_date') )
        {
            $query = \App\Client::with([ 'projects.tasks.time' => function( $query ) use ( $request ) {
                $query->where('time.created_at', '>=', Carbon::parse( $request->input('start_date') )->toDateTimeString()  );
                $query->where('time.created_at', '<=', Carbon::parse( $request->input('end_date') )->toDateTimeString()  );
            }]);

        }
        else
        {
            $query = \App\Client::with([ 'projects.tasks.time' => function( $query ){
                $query->where('time.created_at', '>=', Carbon::parse("30 days ago")->toDateTimeString() );
            }]);
        }

        $clients = $query->get();
        $total_hours = 0.00;

        foreach( $clients as $client )
        {
            $total_client_time = 0.00;

            foreach( $client->projects as $project )
            {
                $total_project_time = 0.00;

                foreach( $project->tasks as $task )
                {
                    $total_task_time = 0.00;

                    foreach( $task->time as $time )
                    {
                        $total_task_time += $time['hours'];
                    }

                    $task->total_time = $total_task_time;
                    $total_project_time += $total_task_time;
                }

                $project->total_time = $total_project_time;
                $total_client_time += $total_project_time;
            }

            $client->total_time = $total_client_time;
            $total_hours += $total_client_time;
        }
        return response()->json([
            "total_time" => $total_hours,
            "clients" => $clients
        ]);
    }



}
