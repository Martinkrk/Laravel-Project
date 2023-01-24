<?php

/**
 * Manage Products and all views associated with them.
 *
 * @author Martin Gerstman JKTV21 <martin.gerstman@ivkhk.ee>.
 * @copyright Copyright 2023.
 */

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Filter;
use App\Models\Image;
use App\Models\ProductFilter;
use App\Models\Rating;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\User;
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
        $images = Image::get();
        $subcategories = SubCategory::get();
        return view('adminpanel/products.index', compact('subcategories', 'products', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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
        $data['image'] = $data['image']->getClientOriginalName();
        $request['image']->move('../public/images/', $data['image']);
        $product = Product::create($data);

        foreach (($request->file('images')) as $imagefile) {
            $filename = $imagefile->getClientOriginalName();
            Image::create(['image' => $filename, 'product_id' => $product->id]);

            if ($filename) {
                $imagefile->move('../public/images/', $filename);
            }
        }

        return redirect('productsadmin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Product $product)
    {
        $categories = Category::get();
        $subcategories = SubCategory::get();
        $images = Image::where('product_id', '=', $product->id)->get();
        $productsubcategory = SubCategory::where('id', '=', $product->subcategory_id)->first();
        $productfilters = ProductFilter::where('product_id', '=', $product->id)->get();
        $productfilterhalf = ceil(count($productfilters)/2)+1;
        $filters = Filter::get();
        $ratings = Rating::where('product_id', '=', $product->id)->orderBy('updated_at', 'desc')->paginate(3);
        $ratingscount = count(Rating::where('product_id', '=', $product->id)->get());
        $users = User::whereIn('id', $ratings->pluck('user_id'))->get();

        return view('main/view', compact('categories', 'subcategories', 'images', 'product', 'productsubcategory', 'productfilters', 'filters', 'productfilterhalf', 'ratings', 'users', 'ratingscount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        $subcategories = SubCategory::get();
        $images = Image::get();
        return view('/adminpanel/products.edit', compact('subcategories', 'product', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'discount' => 'nullable',
        ]);

        if($request->file('images')){
            foreach (($request->file('images')) as $imagefile) {
                $filename = $imagefile->getClientOriginalName();
                Image::create(['image' => $filename, 'product_id' => $product->id]);

                if ($filename) {
                    $imagefile->move('../public/images/', $filename);
                }
            }
        }
        $request->request->remove('images');
        $data = $request->all();
        $product->update($data);

        return redirect('productsadmin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('productsadmin');
    }

    //MAIN

    /**
     * Delete review
     *
     * @param int $product Product linked to a review
     * @param int $user User linked to a review
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function resetReview(int $product, int $user)
    {
        Rating::where('user_id', '=', $user)->where('product_id', '=', $product)->delete();
        return redirect('view/'.$product);
    }

    /**
     * Display a product cart
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cart() {
        $categories = Category::get();
        $subcategories = SubCategory::get();

        return view('main/cart', compact('categories', 'subcategories'));
    }

    /**
     * Add a product to cart and store via sessions
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function addToCart(Product $product) {
        if (!$product) {
            abort(404);
        }

        $cart = session()->get('cart');

        $newPrice = $product->price * (1 - $product->discount / 100);

        if(!$cart) {
            $cart = [
                $product->id => [
                    'name' => $product->name,
                    'quantity' => 1,
                    'price' => $newPrice
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        $cart[$product->id] = [
            'name' => $product->name,
            'quantity' => 1,
            'price' => $newPrice
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Update products and their quantity in a cart via sessions
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function updateCart(Request $request) {
        if($request['product'] and $request['quantity']) {
            $cart = session()->get('cart');
            $cart[$request['product']]['quantity'] = $request['quantity'];
            session()->put('cart', $cart);
        }
        return redirect('cart')->with('success', 'Cart updated successfully');
    }

    /**
     * Remove products from cart via sessions
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function removeFromCart(Request $request, int $id)
    {
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }
        return redirect('cart')->with('success', 'Product removed successfully');
    }

    /**
     * Clear a cart and update product's information, such as it's quantity and amount in stock
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function checkout() {
        $products = Product::get();
        $cart = session()->get('cart');
        foreach ($products as $product) {
            if(array_key_exists($product->id, $cart)) {
                $product->update([
                    'bought' => $product->bought + $cart[$product->id]['quantity'],
                    'stock' => $product->stock - $cart[$product->id]['quantity']
                ]);
            }
        }
        session()->forget('cart');
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Display a search view that uses no separation by subcategories
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request) {
        //PRODUCTS AND CATEGORIES
        $categories = Category::get();
        $subcategories = SubCategory::get();
        $productsinstock = Product::where('stock', '>', '0')
            ->get();

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
                    $qb->where(function ($query) use ($rf) {
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

        return view('main/search', compact('categories', 'subcategories', 'products', 'filters', 'filterValues', 'checkedfilters', 'shows', 'selectedshow', 'sorts', 'selectedsort', 'checkedcategoryfilters'));

    }

    /**
     * Display a catalog of all products separated by a subcategory.
     *
     * @param Request $request contains filter, sort and show information
     * @param SubCategory $subCategory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function catalog(Request $request, SubCategory $subCategory)
    {
        //PRODUCTS AND CATEGORIES
        $categories = Category::get();
        $subcategories = SubCategory::get();
        $productsinstock = Product::where('stock', '>', '0')
            ->where('subcategory_id', '=', $subCategory->id)
            ->get();

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
                ->where('subcategory_id', '=', $subCategory->id)
                ->orderBy($sortquery[0], $sortquery[1])
                ->paginate($selectedshow)
                ->appends(request()->query());
        }
        else {
            $products = Product::where('stock', '>', '0')
                ->where('subcategory_id', '=', $subCategory->id)
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

        return view('main/catalog', compact('categories', 'subcategories', 'products', 'filters', 'filterValues', 'checkedfilters', 'shows', 'selectedshow', 'sorts', 'selectedsort', 'checkedcategoryfilters', 'subCategory'));
    }
}
