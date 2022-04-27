<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoStoreRequest;
use App\Http\Requests\ProductoUpdateRequest;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productos = Producto::all();

        return view('producto.index', compact('productos'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('producto.create');
    }

    /**
     * @param \App\Http\Requests\ProductoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoStoreRequest $request)
    {
        $producto = Producto::create($request->validated());

        $request->session()->flash('producto.id', $producto->id);

        return redirect()->route('producto.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Producto $producto)
    {
        return view('producto.show', compact('producto'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Producto $producto)
    {
        return view('producto.edit', compact('producto'));
    }

    /**
     * @param \App\Http\Requests\ProductoUpdateRequest $request
     * @param \App\Models\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(ProductoUpdateRequest $request, Producto $producto)
    {
        $producto->update($request->validated());

        $request->session()->flash('producto.id', $producto->id);

        return redirect()->route('producto.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Producto $producto)
    {
        $producto->delete();

        return redirect()->route('producto.index');
    }
}
