<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalesDetailStoreRequest;
use App\Http\Requests\SalesDetailUpdateRequest;
use App\Models\SalesDetail;
use Illuminate\Http\Request;

class SalesDetailController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $salesDetails = SalesDetail::all();

        return view('salesDetail.index', compact('salesDetails'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('salesDetail.create');
    }

    /**
     * @param \App\Http\Requests\SalesDetailStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalesDetailStoreRequest $request)
    {
        $salesDetail = SalesDetail::create($request->validated());

        $request->session()->flash('salesDetail.id', $salesDetail->id);

        return redirect()->route('salesDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SalesDetail $salesDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SalesDetail $salesDetail)
    {
        return view('salesDetail.show', compact('salesDetail'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SalesDetail $salesDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, SalesDetail $salesDetail)
    {
        return view('salesDetail.edit', compact('salesDetail'));
    }

    /**
     * @param \App\Http\Requests\SalesDetailUpdateRequest $request
     * @param \App\Models\SalesDetail $salesDetail
     * @return \Illuminate\Http\Response
     */
    public function update(SalesDetailUpdateRequest $request, SalesDetail $salesDetail)
    {
        $salesDetail->update($request->validated());

        $request->session()->flash('salesDetail.id', $salesDetail->id);

        return redirect()->route('salesDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SalesDetail $salesDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SalesDetail $salesDetail)
    {
        $salesDetail->delete();

        return redirect()->route('salesDetail.index');
    }
}
