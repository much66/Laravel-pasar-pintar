@extends('market.layout.main')
@section('container')
    @if (!$pesanan->isEmpty())
        <div class="p-5">
            <form action="">
                <div class="input-group mb-3 w-50 my-3 mx-auto">
                    @if (request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" value="{{ request('search') }}" name="search" class="form-control"
                        placeholder="Cari pesanan..." aria-describedby="basic-addon1">
                </div>
            </form>
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible w-50 mx-auto" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="dropdown">
                <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa-solid fa-arrow-down-wide-short"></i>
                </button>
                <form>
                    @if (request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <ul class="dropdown-menu">
                        <li><button class="dropdown-item" name="sort" value="status" formaction="/pesanan" type="submit"
                                formaction="">Status</button></li>
                        <li><button class="dropdown-item" name="sort" value="name" type="submit"
                                formaction="">Alfabet</button></li>
                    </ul>
                </form>
            </div>
            <div class="mt-5">
                <table class="table mx-auto">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Produk</th>
                            <th scope="col">Toko</th>
                            <th scope="col">Kuantitas</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan as $pesan)
                            <tr class="text-center">
                                <th scope="row">
                                    <p class="my-5">{{ $loop->iteration }}</p>
                                </th>
                                <td>
                                    <div class="d-flex p-1">
                                        <img src="{{ asset('storage/' . $pesan->product->image) }}" alt=""
                                            class="mt-3" style="width: 110px; height:110px;">
                                        <p class="mx-auto mt-5">{{ $pesan->product->name }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="mt-3 p-1">
                                        <p>{{ $pesan->product->user->name }}</p>
                                        <a href="/chatin/{{ $pesan->product->user->username }}"><Button
                                                class="btn btn-success">Chat</Button></a>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <p class="mt-5">{{ $pesan->kuantitas }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="mt-5">
                                        <p>Rp{{ number_format($pesan->price_total, 2, ',', '.') }}</p>
                                    </div>
                                </td>
                                <td>
                                    @if ($pesan->status == 'sedang diproses')
                                        <div class="my-5 mx-auto border bg-primary text-white border-1 rounded-pill"
                                            style="width: 150px;">
                                            <p class="m-auto">{{ $pesan->status }}</p>
                                        </div>
                                    @elseif ($pesan->status == 'dibatalkan')
                                        <div class="my-5 mx-auto border bg-danger text-white border-1 rounded-pill"
                                            style="width: 150px;">
                                            <p class="m-auto">{{ $pesan->status }}</p>
                                        </div>
                                    @elseif ($pesan->status == 'dalam perjalanan')
                                        <div class="my-3 mx-auto border bg-secondary text-white border-1 rounded-pill"
                                            style="width: 150px;">
                                            <p class="m-auto">{{ $pesan->status }}</p>
                                        </div>
                                        <div>
                                            <form action="{{ route('diterima.pesan') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $pesan->id }}">
                                                <input type="hidden" name="user_id"
                                                    value="{{ $pesan->product->user->id }}">
                                                <input type="hidden" name="price_total" value="{{ $pesan->price_total }}">
                                                <button type="submit" name="status" value="diterima"
                                                    class="btn btn-secondary"
                                                    onclick="return confirmSubmit()">Diterima</button>
                                            </form>
                                        </div>
                                    @elseif ($pesan->status == 'diterima')
                                        @if ($ulasan->where('user_id', auth()->user()->id)->where('product_id', $pesan->product->id)->isNotEmpty())
                                            <div class="my-5 mx-auto border bg-success text-white border-1 rounded-pill"
                                                style="width: 100px;">
                                                <p class="m-auto">{{ $pesan->status }}</p>
                                            </div>
                                        @else
                                            <div class="my-3 mx-auto border bg-success text-white border-1 rounded-pill"
                                                style="width: 100px;">
                                                <p class="m-auto">{{ $pesan->status }}</p>
                                            </div>
                                            <div>
                                                <a href="/pesanan/ulasan/{{ $pesan->product->slug }}"><button
                                                        class="btn btn-success">Beri
                                                        ulasan</button></a>
                                            </div>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <script>
                                function confirmSubmit() {
                                    var result = confirm(
                                        "Berikan uang sebesar Rp{{ number_format($pesan->price * $pesan->kuantitas, 0, ',', '.') }} kepada penjual???   "
                                    );
                                    if (result) {
                                        return true; // Lanjutkan submit form
                                    } else {
                                        return false; // Batalkan submit form
                                    }
                                }
                            </script>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex float-end fw-bold">
                <div class="mx-3">
                    <p>Total :</p>
                </div>
                <div class="mx-3">
                    <p>Rp{{ number_format($total, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
        {{ $pesanan->links() }}
    @else
        <div class="container">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible w-50 mx-auto mt-2" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row mb-3 justify-content-center mt-3">
                <img src="../img/not_found.png" alt="" style="width: 350px; margin-top: 20px;">
                <center>
                    <div>
                        <h2 class="fw-bold mt-5">Yah!</h2>
                        <p>Kamu belum pernah memesan produk apapun, ayo belanja dulu!</p>
                        <a href="/dashboard"><button class="rounded text-white btn btn-success">Belanja Sekarang <i
                                    class="fa-solid fa-arrow-right mx-2"></i></button></button></a>
                    </div>
                </center>
            </div>
        </div>
    @endif
@endsection
