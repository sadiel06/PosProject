<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function getClient(){
        $response=Http::get('http://127.0.0.1:5000/clients');
        return $response;
    }
}
