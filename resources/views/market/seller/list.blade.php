@extends('market.layout.main')
@section('container')
    <div class="p-4">
        <div class="input-group mb-3 w-50 my-3 mx-auto">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
            <input type="text" class="form-control" placeholder="Cari produk..." aria-describedby="basic-addon1">
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible " role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="dropdown">
            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-arrow-down-wide-short"></i>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Status</a></li>
                <li><a class="dropdown-item" href="#">Alfabet</a></li>
            </ul>
        </div>
        <div class="mt-5">
            <table class="table mx-auto">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aktif</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="text-center">
                            <th scope="row">
                                <p class="my-5">
                                    {{ $products->perPage() * ($products->currentPage() - 1) + $loop->iteration }}</p>
                            </th>
                            <td style="width: 75px">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="" class="mt-3"
                                    style="width: 110px; height:110px;">
                            </td>
                            <td>
                                <div class="d-flex p-1">
                                    <p class="mx-auto mt-5">{{ $product->name }}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p class="mt-5">{{ $product->stock }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="mt-5">
                                    <p>Rp.{{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="mt-5 text-success">
                                    <p><i class="fa-solid fa-check"></i></p>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $products->links() }}
@endsection
