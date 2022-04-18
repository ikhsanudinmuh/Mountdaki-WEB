<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    
    public function loginUser() {
        return view('login');
    }
    
    public function loginAdmin() {
        return view('loginadmin');
    }
    
    public function loginUserPost(Request $request) {
        $client = new Client;
        $url = 'http://localhost:8000/api/login';
        $data = $request->all();

        try {
            $response = $client->request('POST', $url, [
                'form_params' => $data,
            ]);
            $results = json_decode($response->getBody()->getContents(), true);
            session([
                'login' => TRUE,
                'role' => 'user',
                'userName' => $results['data']['name'],
                'userId' => $results['data']['id'],
                'token' => $results['data']['access_token']
            ]);

            return redirect('/')
                ->with('loginSuccess', $results['message']);

        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true); 
            return redirect('/login')
                ->with('loginError', $error['message']);
        }
    }

    public function loginAdminPost(Request $request) {
        $client = new Client;
        $url = 'http://localhost:8000/api/admin/login';
        $data = $request->all();

        try {
            $response = $client->request('POST', $url, [
                'form_params' => $data,
            ]);
            $results = json_decode($response->getBody()->getContents(), true);
            session([
                'login' => TRUE,
                'role' => 'admin',
                'userName' => $results['data']['name'],
                'token' => $results['data']['access_token']
            ]);

            return redirect('/')
                ->with('loginSuccess', $results['message']);

        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true); 
            return redirect('/admin/login')
                ->with('loginError', $error['message']);
        }
    }

    public function registerUser() {
        return view('register');
    }

    public function registerUserPost(Request $request) {
        $client = new Client;
        $url = 'http://localhost:8000/api/register';
        $data = $request->all();

        try {
            $response = $client->request('POST', $url, [
                'form_params' => $data,
            ]);
            $results = json_decode($response->getBody()->getContents(), true);
            
            return redirect('/login')
                ->with('registerSuccess', $results['message']);
            
        } catch (\Guzzlehttp\Exception\ClientException $e) {    
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);  
            // dd($error);      
            return redirect('/register')
                ->with('registerError', $error['message']);
        }
    }

    public function logoutUser(Request $request) {
        $request->session()->flush();
        return redirect('/login');
    }

}
