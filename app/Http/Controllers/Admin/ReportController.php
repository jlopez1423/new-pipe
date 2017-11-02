<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ReportController extends \App\Http\Controllers\Controller
{

    /**
     * Response token from Workzone for API calls
     */
    public $workzone_access_token;

    public function auth()
    {
        $client = new Client( [
            'base_uri' => 'https://three29.sharedwork.com/',
            'verify' => false
        ] );

        if ( ! $this->workzone_access_token )
        {
            try {

                $auth = $client->request('POST', '/api/token', [
                    'form_params' => [
                        'client_id' => env('WORKZONE_CLIENT_ID'),
                        'client_secret' => env('WORKZONE_SECRET'),
                        'grant_type' => 'client_credentials'
                    ]
                ]);

                $response = json_decode( $auth->getBody()->getContents() );
                $this->workzone_access_token = $response->access_token;

            } catch (ClientException $e) {
                echo Psr7\str($e->getRequest());
                echo Psr7\str($e->getResponse());
            }
        }

        return true;

    }


    public function timeByProject(Request $request)
    {
        if ( $this->auth() )
        {
            $client = new Client( [
                'base_uri' => 'https://three29.sharedwork.com/',
                'verify' => false
            ] );

            $query = array();

            $query['start_date'] = date('Y-m-d', strtotime('30 days ago') );
            $query['end_date'] = date('Y-m-d', strtotime('tomorrow') );

            if ( $request->input('project_id') )
            {
                $query['projectID'] = $request->input('project_id');
            }

            if ( $request->input('workspace_id') )
            {
                $query['workspaceID'] = $request->input('workspace_id');
            }

            try {

                $call = $client->request('GET', '/api/reports/timeByProject', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->workzone_access_token
                    ],
                    'query' => $query
                ]);

                $results = json_decode( $call->getBody()->getContents() );

                usort($results, function ($item1, $item2) {
                    return $item1->workspaceName <=> $item2->workspaceName;
                });

                return view( 'admin.reports.timeByProject', compact('results') );

            } catch (ClientException $e) {
                echo Psr7\str($e->getRequest());
                echo Psr7\str($e->getResponse());
            }
        }
    }


}
