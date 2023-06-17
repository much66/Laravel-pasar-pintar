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
                <div class="dropdown">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-arrow-down-wide-short"></i>
                    </button>
                    <form>
                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if (request('user'))
                            <input type="hidden" name="user" value="{{ request('user') }}">
                        @endif
                        @if (request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif
                        <ul class="dropdown-menu">
                            <li><button class="dropdown-item" name="sort" value="price" type="submit"
                                    formaction="/dashboard/product">Harga</button></li>
                            <li><button class="dropdown-item" name="sort" value="name" type="submit"
                                    formaction="/dashboard/product">Alfabet</button></li>
                            <li><button class="dropdown-item" name="sort" value="rating" type="submit"
                                    formaction="/dashboard/product">Rating</button></li>
                            <li><button class="dropdown-item" name="sort" value="sold" type="submit"
                                    formaction="/dashboard/product">Penjualan</button></li>
                        </ul>
                    </form>
                </div>
                <div class="my-3">
                    <div class="d-flex flex-wrap">
                        <!--Foreach + limit-->
                        @foreach ($products as $product)
                            <div class="rounded shadow p-2 m-2" style="width: 15%;">
                                <a href="/dashboard/detail/{{ $product->slug }}" class="text-black">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-100">
                                    <p class="fw-bold mt-3">{{ $product->name }}</p>
                                    <p>Rp.{{ number_format($product->price, 0, ',', '.') }}</p>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex">
                                            <div class="rateyo mx-auto" data-rateyo-rating="{{ $product->rating }}">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="mb-2" style="font-size: 12px;">{{ $product->sold }} terjual</p>
                                        </div>
                                    </div>
                                    <p><a style="color: black;"
                                            href="/dashboard/product?name={{ $product->user->name }}">{{ $product->user->name }}</a>
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <center>
        {{ $products->links() }}
    </center>
    <script>
        $(function() {

            $(".rateyo").rateYo({
                starWidth: "21px",
                spacing: "-2px",
                readOnly: true
            });

        });
    </script>
@endsection
