@extends('market.layout.main')
@section('container')
    <div class="container">
        <div class="row mb-3 justify-content-center">
            <div class="col mt-5 m-auto">
                <div id="carouselExampleAutoplaying" data-bs-ride="carousel" class="carousel slide w-100 mx-auto">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../img/banner3.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../img/banner4.png" class="d-block w-100" alt="...">
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

    <div class="d-flex flex-wrap justify-content-between mb-5 ms-5">
        @foreach ($types as $type)
            <div class="w-50">
                <h2 class="fw-bold mt-4">{{ $type->name }} <a href="/ide_menu/menu?type={{ $type->slug }}"
                        class="text-success"><i class="fa-solid fa-angles-right rtext-success p-2"
                            style="font-size: 30px;"></i></a></h2>
                <!--Foreach + limit-->
                @foreach ($type->recipe->slice(0, 3) as $r)
                    <div class="d-flex justify-content-evenly rounded shadow p-1 m-2 w-75">
                        @if ($r->image)
                            <img src="{{ asset('storage/' . $r->image) }}" alt="" class="rounded m-3"
                                style="width: 120px; height:120px;">
                        @else
                            <img src="../img/kotak_susu.jpg" alt="" class="rounded m-3"
                                style="width: 120px; height:120px;">
                        @endif
                        <div class="p-1 m-3">
                            <p class="fw-bold"
                                style="overflow:hidden; text-overflow:ellipsis; display:-webkit-box; -webkit-line-clamp:1; -webkit-box-orient:vertical;">
                                {{ $r->name }}</p>
                            <p class="text-secondary">oleh : <a href="/ide_menu/menu?user={{ $r->user->username }}"
                                    class="text-secondary text-decoration-none">{{ $r->user->name }}</a></p>
                            <div class="d-flex justify-content-between">
                                <p class="text-secondary mx-1"><i class="fa-solid fa-user"></i>{{ $r->portion }}</p>
                                <p class="text-secondary mx-1"><i class="fa-solid fa-stopwatch"></i> {{ $r->cooking_time }}
                                    min</p>
                            </div>
                        </div>
                        <a href="/ide_menu/{{ $r->slug }}" class="text-black"><button
                                class="btn btn-success text-white mt-5 me-4" style="width:115px; height:35px;">Baca
                                Resep</button></a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
