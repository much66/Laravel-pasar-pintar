@extends('market.layout.main')
@section('container')
    <div class="d-flex p-5">
        <div>
            @if ($recipe->image)
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="" style="max-width: 300px;" class="">
            @else
                <img src="../img/risol.png" alt="" style="max-width: 300px;" class="">
            @endif
            <div>
                <h1>{{ $recipe->name }}</h1>
                <div class="d-flex">
                    <p class="text-secondary me-2"><i class="fa-solid fa-user"></i> {{ $recipe->portion }} Porsi</p>
                    <p class="text-secondary mx-2"><i class="fa-solid fa-stopwatch"></i> Pembuatan
                        {{ $recipe->cooking_time }}
                        min</p>
                </div>
                <p>Oleh : {{ $recipe->user->name }}</p>
            </div>
        </div>
        <div class="mx-3">
            <div class="d-flex">
                <div style="width: 50vh;">
                    <h2>Bahan-bahan</h2>
                    <ol>
                        {!! $recipe->igredient !!}
                    </ol>
                </div>
                <div style="width:60vh;">
                    <h2>Cara membuat</h2>
                    <ol style="text-align: justify">
                        {!! $recipe->description !!}
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div>
        <h3>Dapatkan bahan-bahannya disini <a href="" class="text-success"><i
                    class="fa-solid fa-angles-right rtext-success p-2" style="font-size: 30px;"></i></a></h3>
        <div class="mb-4">
            <div class="d-flex">
                <!--Foreach + limit-->
                @foreach ($recipe->product as $product)
                    <div class="text-center rounded shadow p-2 m-2" style="width: 15%;">
                        <a href="/dashboard/detail/{{ $product->slug }}" class="text-black">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-100">
                            <p class="fw-bold mt-3">{{ $product->name }}</p>
                            <p>Rp.{{ number_format($product->price, 0, ',', '.') }}</p>
                            <button class="btn btn-success mb-2">Lihat</button>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
