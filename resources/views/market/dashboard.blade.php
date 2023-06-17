@extends('market.layout.main')
@section('container')
    <div class="container">
        <div class="row mb-3 justify-content-center">
            <div class="col mt-5 m-auto">
                <div id="carouselExampleAutoplaying" data-bs-ride="carousel" class="carousel slide w-100 mx-auto">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../img/banner1.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../img/banner2.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <h2 class="fw-bold mt-4">Kategori</h2>
    <!--ini ntar bole pake foreach, jangan lupa taro icon di DBnya jg, kayae DBnya ntar ditambahin lg kolomnya buat tabel kategori-->
    <div class="d-flex justify-content-evenly text-center">
        @foreach ($categories as $category)
            <div>
                <a href="/dashboard/product?category={{ $category->slug }}">
                    <i class="fa-solid {{ $category->icon }} my-3"
                        style="font-size: 50px; color: {{ $category->color }};"></i>
                    <p class="text-black">{{ $category->name }}</p>
                </a>
            </div>
        @endforeach
    </div>

    {{-- <h2 class="fw-bold mt-4">Flash Sale <i class="fa-solid fa-burst" style="color: #ff6600;"></i> <span>(HH-MM-SS)</span>
    </h2>
    <div class="d-flex justify-content-center">
        <!--pake foreach jelas disini mh + limit, kecuali yang liat semua-->
        <div class="text-center rounded shadow p-2 m-2" style="width: 15%;">
            <a href="" class="text-black">
                <img src="../img/kotak_susu.jpg" alt="" class="w-100">
                <p class="fw-bold mt-3">Susu Kotak</p>
                <p>Rp.696969</p>
                <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: 25%">69 tersisa</div>
                </div>
            </a>
        </div>
        <div class="text-center rounded shadow p-2 m-2" style="width: 15%;">
            <a href="" class="text-black">
                <img src="../img/kotak_susu.jpg" alt="" class="w-100">
                <p class="fw-bold mt-3">Susu Kotak</p>
                <p>Rp.696969</p>
                <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: 50%">69 tersisa</div>
                </div>
            </a>
        </div>
        <div class="p-5 text-center">
            <div class="mt-5">
                <a href="" class="text-success">
                    <i class="fa-solid fa-angles-right rounded-circle border border-success p-2"></i>
                    <p>Lihat Semua</p>
                </a>
            </div>
        </div>
    </div> --}}

    <h2 class="fw-bold mt-4">Produk Terlaris</h2>
    <div class="d-flex justify-content-center">
        <!--Foreach + limit kecuali liat semua-->
        @foreach ($terlaris->slice(0, 6) as $laris)
            <div class="text-center rounded shadow p-2 m-2" style="width: 15%;">
                <a href="/dashboard/detail/{{ $laris->slug }}" class="text-black">
                    <img src="{{ asset('storage/' . $laris->image) }}" alt="" class="w-100">
                    <p class="fw-bold mt-3">{{ $laris->name }}</p>
                    <p>Rp.{{ number_format($laris->price, 0, ',', '.') }}</p>
                    <p>Penjualan/bulan : {{ $laris->sold }}</p>
                </a>
            </div>
        @endforeach
        <div class="p-5 text-center">
            <div class="mt-5">
                <a href="/dashboard/product?sort=sold" class="text-success">
                    <i class="fa-solid fa-angles-right rounded-circle border border-success p-2"></i>
                    <p>Lihat Semua</p>
                </a>
            </div>
        </div>
    </div>

    @foreach ($categories as $category)
        <h2 class="fw-bold mt-4">{{ $category->name }}<i class="fa-solid {{ $category->icon }} my-3 mx-3"
                style="font-size: 30px; color: {{ $category->color }};"></i> <a
                href="/dashboard/product?category={{ $category->slug }}" class="text-success"><i
                    class="fa-solid fa-angles-right rtext-success p-2" style="font-size: 30px;"></i></a></h2>
        <div>
            <div class="d-flex justify-content-center">
                <!--Foreach + limit-->
                @foreach ($category->product->slice(0, 6) as $p)
                    <div class="text-center rounded shadow p-2 m-2" style="width: 15%;">
                        <a href="/dashboard/detail/{{ $p->slug }}" class="text-black">
                            <img src="{{ asset('storage/' . $p->image) }}" alt="" class="w-100">
                            <p class="fw-bold mt-3">{{ $p->name }}</p>
                            <p>Rp{{ number_format($p->price, 0, '.', ',') }}</p>
                        </a>
                    </div>
                @endforeach
                <div class="p-5 text-center">
                    <div class="mt-5">
                        <a href="/dashboard/product?category={{ $category->slug }}" class="text-success">
                            <i class="fa-solid fa-angles-right rounded-circle border border-success p-2"></i>
                            <p>Lihat Semua</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <hr class="mt-3 mb-5">
@endsection
