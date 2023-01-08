<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use App\Models\Product;
use App\Models\ProductFilter;
use Illuminate\Http\Request;

class ProductFilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productfilters = ProductFilter::orderBy('product_id', 'asc')->get();
        $products = Product::get();
        $filters = Filter::get();
        return view('adminpanel/productfilter.index', compact('productfilters', 'products', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('updated_at', 'desc')->get();
        $filters = Filter::get();
        return view('adminpanel/productfilter/create', compact('products', 'filters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required'
        ]);

        ProductFilter::create([
            'product_id' => $request->product,
            'filter_id' => $request->filter,
            'value' => $request->value
        ]);

        return redirect('productfiltersadmin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductFilter  $productFilter
     * @return \Illuminate\Http\Response
     */
    public function show(ProductFilter $productFilter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductFilter  $productFilter
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductFilter $productFilter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductFilter  $productFilter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductFilter $productFilter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductFilter  $productFilter
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductFilter $productFilter)
    {
        $productFilter->delete();
        return redirect('productfiltersadmin');
    }
}
