<?php

use App\Models\User;
use App\Models\Pesanan;
use App\Models\Product;
use App\Models\Category;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\IdeMenuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProductSellerController;
use App\Models\Keranjang;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function () {
    return view('market.dashboard', [
        'title' => 'Dashboard',
        'categories' => Category::all(),
        'terlaris' =>  Product::orderBy('sold', 'desc')->get()
    ]);
});
Route::get('/dashboard/product', [ProductController::class, 'index']);
Route::get('/dashboard/detail/{product:slug}', [ProductController::class, 'show']);

Route::get('/ide_menu', [IdeMenuController::class, 'index']);
Route::get('/ide_menu/menu', [IdeMenuController::class, 'show']);
Route::get('/ide_menu/{recipe:slug}', [IdeMenuController::class, 'detail']);
Route::resource('/resep/recipes', ResepController::class)->middleware('auth');
Route::get('/keranjang', [KeranjangController::class, 'index'])->middleware('auth');

Route::delete('/cart/{id}', [ProductController::class, 'delete'])->name('cart.delete');

Route::get('/pesanan', [PesananController::class, 'index'])->middleware('auth');
Route::get('/pesanan/ulasan/{product:slug}', [PesananController::class, 'ulasan']);
Route::post('/pesanan/ulasan/create', [PesananController::class, 'buat_ulasan']);
Route::get('/profile', function () {
    return view('market.profile.index', [
        'title' => 'Profil',
        'user' => auth()->user()

    ]);
})->middleware('auth');



Route::get('/chatout', function () {
    return view('market.chat.chatout', [
        'title' => 'Chat'
    ]);
});
Route::get('/chatin/{user:username}', function (User $user) {
    return view('market.chat.chatin', [
        'title' => 'Chat',
        'user' => User::where('username', $user['username'])->first()
    ]);
});

Route::post('/cart', [ProductController::class, 'cart'])->name('cart')->middleware('auth');
Route::post('/cart/update', [ProductController::class, 'update'])->name('update.cart');
Route::post('/pesan', [ProductController::class, 'pesan'])->name('pesan')->middleware('auth');
Route::post('/pesan/checkout', [ProductController::class, 'checkout'])->name('checkout.pesan')->middleware('auth');
Route::post('/pesan/diterima', [ProductController::class, 'diterima'])->name('diterima.pesan');
Route::post('/pesan/dikirim', [ProductController::class, 'dikirim'])->name('dikirim.pesan');
Route::post('/pesan/hapus', [ProductController::class, 'hapus'])->name('hapus.pesan');

Route::get('/topup', function () {
    return view('market.topup.topup');
});




Route::prefix('users')->group(function () {

    // Route for form 1
    Route::get('/form1', [UserController::class, 'showForm1']);
    Route::post('/form1', [UserController::class, 'storeForm1'])->name('storeForm1');

    // Route for form 2
    Route::get('/form2', [UserController::class, 'showForm2']);
    Route::post('/form2', [UserController::class, 'storeForm2'])->name('storeForm2');

    // Route for form 3
    Route::get('/form3', [UserController::class, 'showForm3']);
    Route::post('/form3', [UserController::class, 'storeForm3'])->name('storeForm3');
    // Route for form 3
    Route::get('/form4', [UserController::class, 'showForm4']);
    Route::post('/form4', [UserController::class, 'storeForm4'])->name('storeForm4');

    Route::get('/form5', [UserController::class, 'showForm5']);
    Route::post('/form5', [UserController::class, 'storeForm5'])->name('storeForm5');
    // and so on...

});

Route::middleware(['auth', 'can:view-pedagang'])->group(function () {
    Route::get('/seller', function () {
        $userID = auth()->user()->id;
        $startDate = now()->subDays(30);
        return view('market.seller.index', [
            'jml_p' => Pesanan::whereHas('product', function ($query) use ($userID) {
                $query->where('user_id', $userID);
            })->where('created_at', '>=', $startDate)->sum('kuantitas'),
            'jml_k' => Keranjang::whereHas('product', function ($query) use ($userID) {
                $query->where('user_id', $userID);
            })->where('created_at', '>=', $startDate)->sum('kuantitas')
        ]);
    });
    Route::resource('/produk/products', ProductSellerController::class);
    Route::get('/pesanan_seller', [PesananController::class, 'pesanan_seller']);
});
