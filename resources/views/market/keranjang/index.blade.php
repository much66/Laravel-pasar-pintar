@extends('market.layout.main')
@section('container')
    @if (!$keranjangs->isEmpty())
        <style>
            input,
            textarea {
                border: 1px solid #eeeeee;
                box-sizing: border-box;
                margin: 0;
                outline: none;
                padding: 10px;
            }

            input[type="button"] {
                cursor: pointer;
            }

            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
            }

            .input-group {
                clear: both;
                margin: 15px 0;
                position: relative;
            }

            .input-group input[type='button'] {
                background-color: #eeeeee;
                min-width: 38px;
                width: auto;
                transition: all 300ms ease;
            }

            .input-group .button-minus,
            .input-group .button-plus {
                font-weight: bold;
                height: 38px;
                padding: 0;
                width: 38px;
                position: relative;
            }

            .input-group .kuantitas-field {
                position: relative;
                height: 38px;
                left: -6px;
                text-align: center;
                width: 62px;
                display: inline-block;
                font-size: 13px;
                margin: 0 0 5px;
                resize: vertical;
            }

            .button-plus {
                left: -13px;
            }
        </style>
        <div class="p-5">
            <div class="input-group mb-3 w-50 my-3 mx-auto">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control" placeholder="Cari di keranjang..." aria-describedby="basic-addon1">
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible w-50 mx-auto" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="mt-5">
                <table class="table mx-auto">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Kuantitas</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keranjangs as $keranjang)
                            <tr class="text-center">
                                {{--<th scope="row">
                                     <input type="checkbox" class="my-5" name="keranjang_id[]"
                                        value="{{ $keranjang->id }}"> 
                                </th>--}}
                                <td>
                                    <div class="d-flex p-1">
                                        <img src="{{ asset('storage/' . $keranjang->product->image) }}" alt=""
                                            class="mt-3" style="width: 110px; height:110px;">
                                        <p class="mx-auto mt-5">{{ $keranjang->product->name }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="mt-5 p-1">
                                        <p>Rp{{ number_format($keranjang->price, 0, ',', '.') }}</p>
                                    </div>
                                </td>
                                <td>
                                    <form action="">
                                        <div class="input-group mt-5" style="margin-left: 150px;">
                                            <input type="button" value="-" class="button-minus"
                                                data-field="kuantitas">
                                            <input type="number" step="1" max="{{ $keranjang->product->stock }}"
                                                value="{{ $keranjang->kuantitas }}" name="kuantitas"
                                                class="kuantitas-field">
                                            <input type="button" value="+" class="button-plus" data-field="kuantitas">
                                        </div>
                                    </form>
                                </td>
                                <td style="width: 200px">
                                    <div class="me-auto d-block">
                                        <div class="form-group mx-auto my-5">
                                            <label for="total_price">Total Harga:</label>
                                            <input type="text" class="w-75" id="total_price" name="total_price"
                                                value="Rp {{ number_format($keranjang->price * $keranjang->kuantitas, 0, ',', '.') }}"
                                                readonly>
                                        </div>
                                        {{-- <div class="form-group mt-2">
                                            <button type="submit" class="btn btn-success">Checkout</button>
                                        </div> --}}
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    <div class="d-flex my-5" style="justify-content:center; align-items:center;">
                                        <form action="{{ route('pesan') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="kuantitas" value="{{ $keranjang->kuantitas }}"
                                                class="hiddenkuantitas">
                                            <input type="hidden" name="price" value="{{ $keranjang->price }}"
                                                class="hiddenkuantitas">
                                            <input type="hidden" name="price_total"
                                                value="{{ $keranjang->kuantitas * $keranjang->price }}"
                                                class="hiddenkuantitas">
                                            <input type="hidden" name="product_id" value="{{ $keranjang->product->id }}"
                                                class="hiddenkuantitas">
                                            <button class="btn btn-success mx-1" type="submit">Pesan</button>
                                        </form>
                                        <form action="{{ route('cart.delete', $keranjang->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-success mx-1" type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            function incrementValue(e) {
                e.preventDefault();
                var fieldName = $(e.target).data('field');
                var parent = $(e.target).closest('div');
                var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
                var maxValue = parseInt(parent.find('input[name=' + fieldName + ']').attr('max'), 10);

                if (!isNaN(currentVal) && currentVal < maxValue) {
                    parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
                } else {
                    parent.find('input[name=' + fieldName + ']').val(maxValue);
                }
            }

            function decrementValue(e) {
                e.preventDefault();
                var fieldName = $(e.target).data('field');
                var parent = $(e.target).closest('div');
                var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
                var maxValue = parseInt(parent.find('input[name=' + fieldName + ']').attr('max'), 10);

                if (!isNaN(currentVal) && currentVal > 0) {
                    parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
                } else {
                    parent.find('input[name=' + fieldName + ']').val(0);
                }
            }

            $('.input-group').on('click', '.button-plus', function(e) {
                incrementValue(e);
            });

            $('.input-group').on('click', '.button-minus', function(e) {
                decrementValue(e);
            });
        </script>
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
                        <p>Keranjang kamu kosong, ayo belanja dulu!</p>
                        <a href="/dashboard"><button class="rounded text-white btn btn-success">Belanja Sekarang <i
                                    class="fa-solid fa-arrow-right mx-2"></i></button></button></a>
                    </div>
                </center>
            </div>
        </div>
    @endif
@endsection
