<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ClimbingRegistrationController extends Controller
{
    public function index() {
        $client = new Client;
        $url = 'http://localhost:8000/api/climbing_registrations';

        try {
            $response = $client->request('GET', $url, [
                'headers' => ['Authorization' => 'Bearer ' . session('token')],
            ]);
            $results = json_decode($response->getBody()->getContents(), true);
            return view('climbingregistrationadmin', ['data' => $results]);
            
        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);  
            return view('climbingregistrationadmin', ['data' => $error]);
            
        }
    }
    public function climbingRegistration($id) {
        if (!session('login')) {
            return redirect('login')
                ->with('loginError', 'Silahkan masuk untuk melanjutkan');
        }
        $client = new Client;
        $url = 'http://localhost:8000/api/mountains/';

        try {
            $response = $client->request('GET', $url.$id);
            $results = json_decode($response->getBody()->getContents(), true);
            // dd($results);
            return view('climbingRegistration', ['data' => $results]);
            
        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);  
            return view('climbingRegistration', ['data' => $error]);
            
        }
    }

    public function climbingRegistrationPost(Request $request, $id) {
        $client = new Client;
        $url = 'http://localhost:8000/api/climbing_registrations';

        $identity_card = time(). '_I_C.' .$request->file('kartu')->extension();
        $healthy_letter = time(). '_H_L.' .$request->file('surat')->extension();
        $schedule = strtotime($request->schedule);

        $newformat = date('Y/m/d', $schedule);
        
        $request->merge([
            'identity_card' => $identity_card,
            'healthy_letter' => $healthy_letter,
            'schedule' => $newformat,
        ]);
        
        try {
            $response = $client->request('POST', $url, [
                'headers' => ['Authorization' => 'Bearer ' . session('token')],
                'form_params' => $request->all(),
            ],);
            $results = json_decode($response->getBody()->getContents(), true);

            $request->kartu->move(public_path('assets'), $identity_card);
            $request->surat->move(public_path('assets'), $healthy_letter);

            return redirect('/climbing_registrations/users/'.session('userId'));
            
        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);  
            return redirect('/climbing_registrations/'.$id, ['data' => $error]);
            
        }
    }

    public function showByUserId($id) {
        $client = new Client;
        $url = 'http://localhost:8000/api/climbing_registrations/';

        try {
            $response = $client->request('GET', $url.'users/'.$id, [
                'headers' => ['Authorization' => 'Bearer ' . session('token')],
            ]);
            $results = json_decode($response->getBody()->getContents(), true);
            // dd($results);
            return view('climbingregistrationuser', ['data' => $results]);
            
        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);  
            // dd($error);
            return view('climbingregistrationuser', ['data' => $error]);
            
        }
    }

    public function approve($id) {
        $client = new Client;
        $url = 'http://localhost:8000/api/climbing_registrations/';

        try {
            $response = $client->request('PUT', $url.'approve/'.$id, [
                'headers' => ['Authorization' => 'Bearer ' . session('token')],
            ]);
            $results = json_decode($response->getBody()->getContents(), true);
            //dd($results);
            return back()
                ->with('updateSuccess', $results['message']);
            
        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);  
            // dd($error);
            return back()
                ->with('updateError', $error['message']);
            
        }
    }

    public function decline($id) {
        $client = new Client;
        $url = 'http://localhost:8000/api/climbing_registrations/';

        try {
            $response = $client->request('PUT', $url.'decline/'.$id, [
                'headers' => ['Authorization' => 'Bearer ' . session('token')],
            ]);
            $results = json_decode($response->getBody()->getContents(), true);
            //dd($results);
            return back()
                ->with('updateSuccess', $results['message']);
            
        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);  
            // dd($error);
            return back()
                ->with('updateError', $error['message']);
            
        }
    }

    public function climb($id) {
        $client = new Client;
        $url = 'http://localhost:8000/api/climbing_registrations/';

        try {
            $response = $client->request('PUT', $url.'climb/'.$id, [
                'headers' => ['Authorization' => 'Bearer ' . session('token')],
            ]);
            $results = json_decode($response->getBody()->getContents(), true);
            //dd($results);
            return back()
                ->with('updateSuccess', $results['message']);
            
        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);  
            // dd($error);
            return back()
                ->with('updateError', $error['message']);
            
        }
    }

    public function done($id) {
        $client = new Client;
        $url = 'http://localhost:8000/api/climbing_registrations/';

        try {
            $response = $client->request('PUT', $url.'done/'.$id, [
                'headers' => ['Authorization' => 'Bearer ' . session('token')],
            ]);
            $results = json_decode($response->getBody()->getContents(), true);
            //dd($results);
            return back()
                ->with('updateSuccess', $results['message']);
            
        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);  
            // dd($error);
            return back()
                ->with('updateError', $error['message']);
            
        }
    }
}
