<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressStoreRequest;
use App\Http\Requests\AddressUpdateRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $addresses = Address::all();

        return view('address.index', compact('addresses'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('address.create');
    }

    /**
     * @param \App\Http\Requests\AddressStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressStoreRequest $request)
    {
        $address = Address::create($request->validated());

        $request->session()->flash('address.id', $address->id);

        return redirect()->route('address.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Address $address
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Address $address)
    {
        return view('address.show', compact('address'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Address $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Address $address)
    {
        return view('address.edit', compact('address'));
    }

    /**
     * @param \App\Http\Requests\AddressUpdateRequest $request
     * @param \App\Models\Address $address
     * @return \Illuminate\Http\Response
     */
    public function update(AddressUpdateRequest $request, Address $address)
    {
        $address->update($request->validated());

        $request->session()->flash('address.id', $address->id);

        return redirect()->route('address.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Address $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Address $address)
    {
        $address->delete();

        return redirect()->route('address.index');
    }
}
