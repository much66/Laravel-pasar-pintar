@extends('market.layout.main')
@section('container')
    <style>
        .ratings {
            margin-right: 10px;
        }

        .ratings i {
            color: #cecece;
            font-size: 10px;
        }

        .rating-color {
            color: #F8BE2C !important;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col mt-3">
                <h1 class="text-center">{{ $title }}</h1>
            </div>
        </div>
    </div>
    <div class="d-flex flex-wrap justify-content-between mb-5">
        @foreach ($recipes as $r)
            <div class="w-50">
                <div class="d-flex flex-wrap">
                    <!--Foreach + limit-->
                    <div class="d-flex justify-content-evenly rounded shadow p-1 m-2 w-100">
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
                                <p class="text-secondary mx-1"><i class="fa-solid fa-user"></i>
                                    {{ $r->portion }}
                                    porsi
                                </p>
                                <p class="text-secondary mx-1"><i class="fa-solid fa-stopwatch"></i>
                                    {{ $r->cooking_time }}
                                    min</p>
                            </div>
                        </div>
                        <a href="/ide_menu/{{ $r->slug }}" class="text-black"><button
                                class="btn btn-success text-white mt-5 me-4" style="width:115px; height:35px;">Baca
                                Resep</button></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
