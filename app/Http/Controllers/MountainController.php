<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

use Illuminate\Http\Request;

class MountainController extends Controller
{
    public function index() {
        $client = new Client;
        $url = 'http://localhost:8000/api/mountains/';

        try {
            $response = $client->request('GET', $url);
            $results = json_decode($response->getBody()->getContents(), true);
            return view('index', ['data' => $results]);
            
        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);  
            
        }
    }

    public function list() {
        $client = new Client;
        $url = 'http://localhost:8000/api/mountains/';

        try {
            $response = $client->request('GET', $url);
            $results = json_decode($response->getBody()->getContents(), true);
            return view('mountains', ['data' => $results]);
            
        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);  
        }
                   
    }

    public function show($id) {
        $client = new Client;
        $url = 'http://localhost:8000/api/mountains/';

        try {
            $response = $client->request('GET', $url.$id);
            $results = json_decode($response->getBody()->getContents(), true);
            // dd($results);
            return view('mountaindetail', ['data' => $results]);
            
        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);  
            return view('mountaindetail', ['data' => $error]);
            
        }
    }

    public function store(Request $request) {
        $client = new Client;
        $url = 'http://localhost:8000/api/mountains';

        $image = time(). '_M.' .$request->file('gambar')->extension();

        $request->merge([
            'image' => $image,
        ]);

        try {
            $response = $client->request('POST', $url, [
                'headers' => ['Authorization' => 'Bearer ' . session('token')],
                'form_params' => $request->all(),
            ],);
            $results = json_decode($response->getBody()->getContents(), true);

            $request->gambar->move(public_path('assets'), $image);

            return redirect('/admin/mountains')
                ->with('createSuccess', $results['message']);
            
        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);  
            return redirect('/admin/mountains')
                ->with('createError', $error['message']);
            
        }
    }

    public function update(Request $request, $id) {
        $client = new Client;
        $url = 'http://localhost:8000/api/mountains/';

        try {
            $response = $client->request('PUT', $url.$id, [
                'headers' => ['Authorization' => 'Bearer ' . session('token')],
                'form_params' => $request->all(),
            ],);
            $results = json_decode($response->getBody()->getContents(), true);

            return redirect('/admin/mountains')
                ->with('createSuccess', $results['message']);
            
        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);  
            return redirect('/admin/mountains')
                ->with('createError', $error['message']);
            
        }
    }
}
