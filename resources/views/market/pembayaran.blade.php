@extends('market.layout.main')
@section('container')
    <div class="container">
        <div class="row">
            <div class="col">
                @if (session()->has('gagal'))
                    <div class="alert alert-danger alert-dismissible w-50 mx-auto mt-3" role="alert">
                        {{ session('gagal') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h1 class="mt-3 text-center fw-bold">Checkout</h1>
                <hr>
                <form action="/pesan/checkout" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $data->product_id }}">
                    <input type="hidden" name="kuantitas" value="{{ $data->kuantitas }}">
                    <input type="hidden" name="price" value="{{ $data->price }}">
                    <input type="hidden" name="price_total" value="{{ $data->price_total }}">
                    <input type="hidden" name="address" value="{{ $user->alamat }}">
                    <input type="hidden" name="no_telp" value="{{ $user->no_telp }}">
                    <h3 style="">{{ $product->user->name }}</h3>
                    <div class="d-flex">
                        <div>
                            <img src="{{ $product->image }}" style="max-width: 100px;" alt="">
                        </div>
                        <div class="p-2">
                            <h5 class="ms-2">{{ $product->name }}</h5>
                            <p class="ms-2 mb-auto">
                                Rp{{ number_format($data->price, 2, ',', '.') }}
                                x{{ $data->kuantitas }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <div class="me-5">
                            <p>Saldo PasarPay akan terpotong sebesar :</p>
                            <p>&nbsp Rp{{ number_format($user->saldo, 0, ',', '.') }} <span class="text-secondary"
                                    style="font-size: 13px">(saldo
                                    sekarang)</span><br>
                                - Rp{{ number_format($data->price_total, 0, ',', '.') }}<span class="text-secondary"
                                    style="font-size: 13px"> (saldo terpotong) </span>
                            </p>
                            <hr>
                            <p @if ($user->saldo < $data->price_total) class="text-danger" @endif>
                                Rp{{ number_format($user->saldo - $data->price_total, 0, ',', '.') }}
                                @if ($user->saldo < $data->price_total)
                                    <span class="text-danger" style="font-size: 13px">(saldo anda kurang, mohon untuk isi
                                        saldo terlebih dahulu)</span>
                                @else
                                    <span class="text-secondary" style="font-size: 13px">(sisa saldo setelah
                                        dipotong)</span>
                                @endif

                                {{-- <label for="metode">Pilih Metode Pembayaran</label>
                            <select id="metode" class="form-select border-black" name="metode"
                                aria-label="Default select example" required>
                                <option selected hidden></option>
                                 <option value="Dana">Dana</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="PasarPay" @if ($user->saldo < $data->price_total) disabled @endif>PasarPay
                                    (Rp{{ number_format($user->saldo, 0, ',', '.') }})
                                </option>
                            </select> --}}
                        </div>
                        <div>
                            <textarea class="form-control my-3 border-black" name="catatan" id="exampleFormControlTextarea1"
                                placeholder="Catatan..." rows="3"></textarea>
                        </div>
                    </div>
                    <hr>
                    <h5>Total : </h5>
                    <p>{{ $product->name }} x{{ $data->kuantitas }} =
                        Rp{{ number_format($data->price_total, 2, ',', '.') }}</p>
                    <hr>
                    <button class="btn btn-success" type="submit" @if ($user->saldo < $data->price_total) disabled @endif>Buat
                        Pesanan</button>
                    <!--pindahin disablenya ke tombol bang-->
                </form>
            </div>
        </div>
    </div>
@endsection
