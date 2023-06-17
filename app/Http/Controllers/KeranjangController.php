<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;

class KeranjangController extends Controller
{
    public function index()
    {
            return view('market.keranjang.index', [
                    'title' => 'Keranjang',
                    'keranjangs' => Keranjang::where('user_id', auth()->user()->id)->where('status', 'aktif')->get()
                ]);
            }
}
