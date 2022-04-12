<?php

namespace App\Http\Controllers;

use App\Http\Requests\productStoreRequest;
use App\Http\Requests\productUpdateRequest;
use App\Models\Products\Product;
use Illuminate\Http\Request;

class productController extends Controller
{

    public function index(Request $request)
    {
        $products = Product::all();

        return view('admin.product.index', compact('products'));
    }


    public function create(Request $request)
    {
        return view('admin.product.create');
    }


    public function store(productStoreRequest $request)
    {

        $product = Product::create($request->all());

//        $request->session()->flash('admin.product.id', $product->id);

        return redirect()->route('admin.product.edit',$product)->with('message','Registrado correctamente');

    }


    public function show(Request $request, Product $product)
    {
        return view('admin.product.show', compact('product'));
    }


    public function edit(Request $request, Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }


    public function update(productUpdateRequest $request, Product $product)
    {
        $product->update($request->validated());

        $request->session()->flash('admin.product.id', $product->id);

        return redirect()->route('admin.product.edit',$product)->with('message','Registro correctamente actualizado');
    }


    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        return redirect()->route('admin.product.index');
    }
}
