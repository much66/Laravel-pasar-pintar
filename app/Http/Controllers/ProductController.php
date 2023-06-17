<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pesanan;
use App\Models\Product;
use App\Models\Category;
use App\Models\Keranjang;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Category $category)
    {
        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = 'Produk pada Kategori ' . $category->name;
        }
        if (request('user')) {
            $user = User::firstWhere('username', request('user'));
            $title = 'Produk dari ' . $user->name;
        }
        if (request('search')) {
            $search = request('search');
            $title = 'Hasil pencarian "' . $search . '"';
        }
        if (request('sort')) {
            $search = request('search');
            $title = 'Hasil pencarian';
        }
        return view('market.search_product', [
            'title' => $title,
            'products' => Product::latest()->filter(request(['search', 'category', 'user', 'sort']))->paginate(12)->withQueryString(),
        ]);
    }
    public function show(Product $product)
    {
        return view('market.detail_product',  [
            'title' => $product->name,
            'product' => $product,
            'ulasan' => Ulasan::where('product_id', $product->id)->get(),
            'avg' => Product::where('user_id', $product->user_id)->avg('rating')
        ]);
    }

    public function cart(Request $request)
    {
        $user = auth()->user();
        $product_id = $request->input('product_id');
        $kuantitas = $request->input('kuantitas');
        $price = $request->input('price');

        $cart = $user->keranjang->where('product_id', $product_id)->first();

        if ($cart) {
            // If the product is already in the cart, update the quantity
            $cart->kuantitas += $kuantitas;
            $cart->save();
        } else {
            // If the product is not in the cart, create a new cart item
            $cart_item = new Keranjang;
            $cart_item->user_id = $user->id;
            $cart_item->product_id = $product_id;
            $cart_item->kuantitas = $kuantitas;
            $cart_item->price = $price;
            $cart_item->save();
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request)
    {
        $keranjang = Keranjang::findOrFail($request->id);

        // validasi data masukan
        $validatedData = $request->validate([
            'kuantitas' => 'required|integer|min:1|max:' . $keranjang->product->stock,
        ]);

        // update kuantitas dan simpan ke database
        $keranjang->kuantitas = $validatedData['kuantitas'];
        $keranjang->save();

        // kirim respons sukses
        return response()->json([
            'status' => 'success',
            'message' => 'Kuantitas berhasil diperbarui',
            'quantity' => $keranjang->kuantitas,
        ]);
    }

    public function pesan(Request $request)
    {
        if (auth()->check() && (empty(auth()->user()->alamat) || empty(auth()->user()->email) || empty(auth()->user()->no_telp))) {
            return view('market.profile.index', [
                'title' => 'Profil',
                'user' => auth()->user()
            ]);
        } else {
            $request['price_total'] = $request->price * $request->kuantitas;
            return view(
                'market.pembayaran',
                [
                    'title', 'Pembayaran',
                    'data' => $request,
                    'product' => Product::where('id', $request->product_id)->first(),
                    'user' => auth()->user()
                ]
            );
        }
    }
    public function checkout(Request $request)
    {
        $keranjang = Keranjang::where('product_id', $request->product_id)
            ->where('user_id', auth()->id())
            ->first();
        // Jika ada, hapus keranjang tersebut
        if ($keranjang) {
            $keranjang->status = 'non-aktif';
            $keranjang->save();
        }

        // Simpan data ke tabel pesan
        Pesanan::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'kuantitas' => $request->kuantitas,
            'price' => $request->price,
            'catatan' => $request->catatan,
            'price_total' => $request->price_total,
            'address' => $request->address,
            'no_telp' => $request->no_telp,
            'metode' => "PasarPay",
        ]);

        $user = User::findOrFail(auth()->user()->id);
        $user->decrement('saldo', $request->price_total);

        $product = Product::findOrFail($request->product_id);
        $product->decrement('stock', $request->kuantitas);
        $product->increment('sold', $request->kuantitas);


        // Redirect ke halaman sukses
        return redirect('/pesanan')->with('success', 'Pesanan berhasil dibuat');
    }

    public function diterima(Request $request)
    {
        $pesanan = Pesanan::findOrFail($request->id);
        $pesanan->status = $request->input('status');
        $user = User::findOrFail($request->user_id);
        $user->increment('saldo', intval($request->price_total));
        $pesanan->save();

        return redirect('/pesanan')->with('success', 'Pesanan berhasil diterima');
    }

    public function hapus(Request $request)
    {
        $pesanan = Pesanan::findOrFail($request->id);
        $pesanan->status = $request->input('status');
        $user = User::findOrFail($request->user_id);
        $user->increment('saldo', $request->input('price'));
        $pesanan->save();

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan');
    }

    public function dikirim(Request $request)
    {
        $pesanan = Pesanan::findOrFail($request->id);
        $pesanan->status = $request->input('status');
        $pesanan->save();

        return redirect()->back()->with('success', 'Pesanan berhasil dikirim');
    }

    public function delete($id)
    {
        $keranjang = Keranjang::where('id', $id)->first();
        $keranjang->status = 'non-aktif';
        $keranjang->save();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang');
    }
}
