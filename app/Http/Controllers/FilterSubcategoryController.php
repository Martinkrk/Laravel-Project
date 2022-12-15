<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use App\Models\FilterSubcategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FilterSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filtersubcategories = FilterSubcategory::get();
        $filters = Filter::get();
        $subcategories = SubCategory::get();
        return view('adminpanel/filtersubcategory.index', compact('filtersubcategories', 'filters', 'subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $filters = Filter::get();
        $subcategories = SubCategory::get();
        return view('adminpanel/filtersubcategory.create', compact('filters', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        FilterSubcategory::create([
            'filter_id' => $request->filter,
            'subcategory_id' => $request->subcategory
        ]);
        return redirect('filtersubcategoriesadmin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FilterSubcategory  $filterSubcategory
     * @return \Illuminate\Http\Response
     */
    public function show(FilterSubcategory $filterSubcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FilterSubcategory  $filterSubcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(FilterSubcategory $filterSubcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FilterSubcategory  $filterSubcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FilterSubcategory $filterSubcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FilterSubcategory  $filterSubcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FilterSubcategory $filterSubcategory)
    {
        $filterSubcategory->delete();
        return redirect('filtersubcategoriesadmin');
    }
}
