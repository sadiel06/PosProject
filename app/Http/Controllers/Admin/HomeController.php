<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use function MongoDB\BSON\toJSON;

class HomeController extends Controller
{
    public function index(){
        $vals = $this->getClient()->body();
//        dd($vals);
        return view('admin.index', compact('vals'));
    }
    public function getClient(){
        $response = Http::get('http://127.0.0.1:5000/clients');
        return $response;
    }
}
