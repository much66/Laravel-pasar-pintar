<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Product;
use App\Models\Ulasan;

class PesananController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;

        return view('market.pesanan.index', [
            'title' => 'Pesanan Anda',
            'pesanan' => Pesanan::where('user_id', auth()->user()->id)->filter(request(['search', 'sort']))->paginate(10)->withQueryString(),
            'total' => Pesanan::where('user_id', auth()->user()->id)->sum('price_total'),
            'ulasan' => Ulasan::all(),
        ]);
    }
    public function ulasan(Product $product)
    {
        return view('market.pesanan.rating', [
            'title' => 'Beri Ulasan',
            'product' => Product::where('slug', $product->slug)->first()
        ]);
    }
    public function buat_ulasan(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required',
            'product_id' => 'required',
            'user_id' => 'required',
        ]);
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->storePublicly('ulasan-images', 'public');
        }
        $product = Product::findOrFail($request->product_id);
        $product->rating = $request->rating;
        $product->save();
        $validatedData['rating'] = $request->rating;
        Ulasan::create($validatedData);
        return redirect('pesanan')->with('success', 'Ulasan Berhail Dibuat');
    }
    public function pesanan_seller()
    {

        return view('market.seller.pesanan', [
            'title' => 'Pesanan Toko Anda',
            'pesanan' => Pesanan::whereHas('product', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->filter(request(['status']))->paginate(5)->withQueryString(),
        ]);
    }
}
