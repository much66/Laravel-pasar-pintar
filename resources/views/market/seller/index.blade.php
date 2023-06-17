@extends('market.layout.main')
@section('container')
    <div class="p-5">
        <h1 class="fw-bold text-center">Selamat Datang di <span class="text-success">Pasar Pintar</span>!</h1>
        <div class="d-flex justify-content-evenly my-4">
            <div class="text-center p-3 border border-success rounded" style="width: 40%;">
                <h3>Produk Terjual</h3>
                <p class="mt-4"><span class="text-success fw-bold">{{ $jml_p }}</span> <span>Per 30 Hari
                        Terakhir</span></p>
            </div>
            <div class="text-center p-3 border border-success rounded" style="width: 40%;">
                <h3>Produk Dalam Keranjang</h3>
                <p class="mt-4"><span class="text-success fw-bold">{{ $jml_k }}</span> <span>Per 30 Hari
                        Terakhir</span></p>
            </div>
        </div>
        <div class="mt-5">
            <h4 class="text-center">Sudah siap berjualan online?</h4>
            <p class="text-center">Cek semuanya untuk meningkatkan performa tokomu!</p>
            <center><button class="btn btn-success">Baca Panduan <i class="fa-solid fa-arrow-right"></i></button></center>
        </div>
    </div>
@endsection
