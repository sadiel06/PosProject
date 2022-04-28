<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Products\Product;
use App\Models\Sale;
use App\Models\SalesDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use function MongoDB\BSON\toJSON;

class HomeController extends Controller
{
    public function index(){
        $vals = $this->getClient()->body();
        $products = Product::all();
        return view('admin.index', compact('vals','products'));
    }
    public function getClient(){
        $response = Http::get('http://127.0.0.1:5000/clients');
        return $response;
    }

    public function getProducts(){
        $ventas = Sale::with('details')->get();
        $product= Producto::join('sales_details','sales_details.producto_id','=','productos.id')->get(['price']);
        return $ventas;
    }
}
