<?php

namespace App\Http\Controllers;

use App\Http\Requests\PointOfSaleStoreRequest;
use App\Http\Requests\PointOfSaleUpdateRequest;
use App\Models\PointOfSale;
use Illuminate\Http\Request;

class PointOfSaleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pointOfSales = PointOfSale::all();

        return view('pointOfSale.index', compact('pointOfSales'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pointOfSale.create');
    }

    /**
     * @param \App\Http\Requests\PointOfSaleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PointOfSaleStoreRequest $request)
    {
        $pointOfSale = PointOfSale::create($request->validated());

        $request->session()->flash('pointOfSale.id', $pointOfSale->id);

        return redirect()->route('pointOfSale.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PointOfSale $pointOfSale
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PointOfSale $pointOfSale)
    {
        return view('pointOfSale.show', compact('pointOfSale'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PointOfSale $pointOfSale
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PointOfSale $pointOfSale)
    {
        return view('pointOfSale.edit', compact('pointOfSale'));
    }

    /**
     * @param \App\Http\Requests\PointOfSaleUpdateRequest $request
     * @param \App\Models\PointOfSale $pointOfSale
     * @return \Illuminate\Http\Response
     */
    public function update(PointOfSaleUpdateRequest $request, PointOfSale $pointOfSale)
    {
        $pointOfSale->update($request->validated());

        $request->session()->flash('pointOfSale.id', $pointOfSale->id);

        return redirect()->route('pointOfSale.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PointOfSale $pointOfSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PointOfSale $pointOfSale)
    {
        $pointOfSale->delete();

        return redirect()->route('pointOfSale.index');
    }
}
