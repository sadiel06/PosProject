<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryDetailStoreRequest;
use App\Http\Requests\InventoryDetailUpdateRequest;
use App\Models\InventoryDetail;
use Illuminate\Http\Request;

class InventoryDetailController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inventoryDetails = InventoryDetail::all();

        return view('inventoryDetail.index', compact('inventoryDetails'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('inventoryDetail.create');
    }

    /**
     * @param \App\Http\Requests\InventoryDetailStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryDetailStoreRequest $request)
    {
        $inventoryDetail = InventoryDetail::create($request->validated());

        $request->session()->flash('inventoryDetail.id', $inventoryDetail->id);

        return redirect()->route('inventoryDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\InventoryDetail $inventoryDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, InventoryDetail $inventoryDetail)
    {
        return view('inventoryDetail.show', compact('inventoryDetail'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\InventoryDetail $inventoryDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, InventoryDetail $inventoryDetail)
    {
        return view('inventoryDetail.edit', compact('inventoryDetail'));
    }

    /**
     * @param \App\Http\Requests\InventoryDetailUpdateRequest $request
     * @param \App\Models\InventoryDetail $inventoryDetail
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryDetailUpdateRequest $request, InventoryDetail $inventoryDetail)
    {
        $inventoryDetail->update($request->validated());

        $request->session()->flash('inventoryDetail.id', $inventoryDetail->id);

        return redirect()->route('inventoryDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\InventoryDetail $inventoryDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, InventoryDetail $inventoryDetail)
    {
        $inventoryDetail->delete();

        return redirect()->route('inventoryDetail.index');
    }
}
