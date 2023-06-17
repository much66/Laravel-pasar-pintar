<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class ProductSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('market.seller.list', [
            'title' => 'Produk Anda',
            'products' => Product::where('user_id', auth()->user()->id)->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('market.seller.create',[
            'title' => 'Buat Produk',
            'category' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'desc' => 'required',
            'image' => 'image|file|max:1024|dimensions:ratio=1/1',
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->storePublicly('product-images', 'public');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['slug'] = $slug;
        Product::create($validatedData);
        return redirect('produk/products')->with('success', 'Produk Berhail Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
