<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryStoreRequest;
use App\Http\Requests\InventoryUpdateRequest;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inventories = Inventory::all();

        return view('inventory.index', compact('inventories'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('inventory.create');
    }

    /**
     * @param \App\Http\Requests\InventoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryStoreRequest $request)
    {
        $inventory = Inventory::create($request->validated());

        $request->session()->flash('inventory.id', $inventory->id);

        return redirect()->route('inventory.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Inventory $inventory)
    {
        return view('inventory.show', compact('inventory'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Inventory $inventory)
    {
        return view('inventory.edit', compact('inventory'));
    }

    /**
     * @param \App\Http\Requests\InventoryUpdateRequest $request
     * @param \App\Models\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryUpdateRequest $request, Inventory $inventory)
    {
        $inventory->update($request->validated());

        $request->session()->flash('inventory.id', $inventory->id);

        return redirect()->route('inventory.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('inventory.index');
    }
}
