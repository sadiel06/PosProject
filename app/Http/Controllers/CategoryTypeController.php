<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryTypeStoreRequest;
use App\Http\Requests\CategoryTypeUpdateRequest;
use App\Models\CategoryType;
use Illuminate\Http\Request;

class CategoryTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoryTypes = CategoryType::all();

        return view('categoryType.index', compact('categoryTypes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('categoryType.create');
    }

    /**
     * @param \App\Http\Requests\CategoryTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryTypeStoreRequest $request)
    {
        $categoryType = CategoryType::create($request->validated());

        $request->session()->flash('categoryType.id', $categoryType->id);

        return redirect()->route('categoryType.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CategoryType $categoryType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CategoryType $categoryType)
    {
        return view('categoryType.show', compact('categoryType'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CategoryType $categoryType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CategoryType $categoryType)
    {
        return view('categoryType.edit', compact('categoryType'));
    }

    /**
     * @param \App\Http\Requests\CategoryTypeUpdateRequest $request
     * @param \App\Models\CategoryType $categoryType
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryTypeUpdateRequest $request, CategoryType $categoryType)
    {
        $categoryType->update($request->validated());

        $request->session()->flash('categoryType.id', $categoryType->id);

        return redirect()->route('categoryType.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CategoryType $categoryType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CategoryType $categoryType)
    {
        $categoryType->delete();

        return redirect()->route('categoryType.index');
    }
}
