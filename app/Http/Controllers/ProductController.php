<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Filter;
use App\Models\ProductFilter;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::get();
        $subcategories = SubCategory::get();
        return view('adminpanel/products.index', compact('subcategories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = SubCategory::get();
        return view('adminpanel/products.create', compact('subcategories'));
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
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'discount' => 'nullable',
        ]);

        $data = $request->all();
        $filename = $request->file('image')->getClientOriginalName();
        $data['image'] = $filename;
        Product::create($data);
        $file = $request->file('image');

        if($filename) {
            $file->move('../public/images', $filename);
        }

        return redirect('productsadmin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $subcategories = SubCategory::get();
        return view('/adminpanel/products.edit', compact('subcategories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'discount' => 'nullable',
        ]);

        $data = $request->all();
        if($request->file('image')){
            $filename = $request->file('image')->getClientOriginalName();
            $data['image'] = $filename;

            $file = $request->file('image');
            if($filename){
                $file->move('../public/images/', $filename);
            }
        }
        $product->update($data);

        return redirect('productsadmin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('productsadmin');
    }

    //MAIN

    public function catalog(Request $request)
    {
        //PRODUCTS AND CATEGORIES
        $categories = Category::get();
        $subcategories = SubCategory::get();
        $productsinstock = Product::where('stock', '>', '0')->get();

        //SHOW AND SORT
        //show
        $shows = ['2','4'];
        if ($request['show'] != null) {
            $selectedshow = $request['show'];
        }
        else {
            $selectedshow = $shows[0];
        }

        //sort
        $sorts = ['Popular', 'New', 'Price (low to high)', 'Price (high to low)'];

        if ($request['sort'] != null) {
            $selectedsort = $request['sort'];
        }
        else {
            $selectedsort = $sorts[0];
        }

        $sortquery = ['', 'desc'];
        if ($selectedsort == 'Popular') {
            $sortquery[0] = 'bought';
        }
        elseif ($selectedsort == 'New') {
            $sortquery[0] = 'updated_at';
        }
        elseif ($selectedsort == 'Price (low to high)') {
            $sortquery[0] = 'price';
            $sortquery[1] = 'asc';
        }
        elseif ($selectedsort == 'Price (high to low)') {
            $sortquery[0] = 'price';
        }
        else {
            $sortquery = ['bought', 'desc'];
        }

        $checkedfilters = null;
        $checkedcategoryfilters = null;

        if ($request['search'] != null) {
            $searchText = $request['search'];
            $products = Product::where('name', 'like', '%'.$searchText.'%')
                ->where('stock', '>', '0')
                ->orderBy($sortquery[0], $sortquery[1])
                ->paginate($selectedshow)
                ->appends(request()->query());
        }
        elseif ($request['filters'] != null || $request['categoryfilters'] != null) {
                $checkedfilters = $request['filters'];
                $qb = DB::table('product_filter');
            if ($request['filters'] != null) {
                foreach ($checkedfilters as $rf) {
                    $rf = explode('*', $rf);
                    $qb->orWhere(function ($query) use ($rf) {
                        $query->where('filter_id', '=', $rf[0])
                            ->where('filtervalue', '=', $rf[1]);
                    });
                }
            }
            if ($request['categoryfilters'] != null) {
                $checkedcategoryfilters = $request['categoryfilters'];
                $qb->whereIn('subcategory_id', $request['categoryfilters']);
            }

            $productfilters = $qb->select('product_id');
            $products = Product::whereIn('id', $productfilters)
                ->where('stock', '>', '0')
                ->orderBy($sortquery[0], $sortquery[1])
                ->paginate($selectedshow)
                ->appends(request()->query());
        }
        else {
            $products = Product::where('stock', '>', '0')
                ->orderBy($sortquery[0], $sortquery[1])
                ->paginate($selectedshow)
                ->appends(request()->query());
        }

        $selectedfilters = DB::table('product_filter')
            ->select('filter_id')
            ->distinct()
            ->whereIn('product_id', $productsinstock->map(function ($prod) {
                return collect($prod->toArray())
                    ->only(['id'])
                    ->all();
            }));

        $filters = Filter::whereIn('id', $selectedfilters)->get();

        $filterValues = DB::table('product_filter')
            ->select('filter_id', 'filtervalue')
            ->whereIn('product_id', $productsinstock->map(function ($prod) {
                return collect($prod->toArray())
                    ->only(['id'])
                    ->all();
            }))
            ->groupByRaw('filtervalue, filter_id')
            ->get();

        return view('main/catalog', compact('categories', 'subcategories', 'products', 'filters', 'filterValues', 'checkedfilters', 'shows', 'selectedshow', 'sorts', 'selectedsort', 'checkedcategoryfilters'));
    }
}
