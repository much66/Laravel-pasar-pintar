@extends('market.layout.main')
@section('container')
    @php
        $data = 3.5;
    @endphp
    <style>
        .rating-color {
            color: #F8BE2C !important;
        }

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

    <div class="p-3">
        <div class="mx-auto">
            <div class="d-flex">
                <div>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="" style="width: 200px; height:200px;">
                </div>
                <div class="mx-4 d-flex justify-content-between w-100">
                    <div>
                        <h2>{{ $product->name }}</h2>
                        <div>
                            <div class="d-flex">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <p>{{ $product->rating }}</p>
                                    </div>
                                    <div id="rateYo" data-rateYo-rating="{{ $product->rating }}"></div>
                                </div>
                                <p class="mx-3" style="font-size: 16px;">{{ $product->sold }} terjual</p>
                            </div>
                            <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <div>
                                <div class="input-group">
                                    <form method="POST" class="mx-auto">
                                        <div class="d-flex">
                                            <div>
                                                <input type="button" value="-" class="button-minus mx-auto"
                                                    data-field="kuantitas">
                                                <input type="number" step="1" max="{{ $product->stock }}"
                                                    value="1" name="kuantitas" class="kuantitas-field">
                                                <input type="button" value="+" class="button-plus"
                                                    data-field="kuantitas">
                                            </div>
                                            <div class="ms-3 mt-2">
                                                <p>Tersisa {{ $product->stock }} buah</p>
                                            </div>
                                        </div>
                                        <div>
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                            <button class="me-2 btn btn-success" type="submit"
                                                formaction="{{ route('cart') }}"><i
                                                    class="fa-solid fa-plus me-3"></i>Keranjang</button>
                                            <button class="mx-2 btn btn-success" type="submit"
                                                formaction="{{ route('pesan') }}">Beli</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <img src="/img/ateng.png" alt="" style="width: 36px; height: 36px;"
                            class="rounded-circle me-4">
                        <div>
                            <h4 class="my-2">{{ $product->user->name }}</h4>
                            <p><i class="fa fa-star text-secondary me-4"></i><span
                                    style="font-size: 14px;">{{ number_format($avg, 1, ',', '.') }}</span><span
                                    class="mx-2" style="font-size: 14px;">Rata-rata ulasan</span></p>
                            <p><i class="fa-solid fa-clock text-secondary me-4"></i><span style="font-size: 14px;">± 8 jam
                                    Pesanan Diproses</span></p>
                            <div class="mt-4">
                                <h4>Pengiriman</h4>
                                <p><i class="fa-solid fa-truck text-secondary me-4"></i> Ongkir Reguler 6rb-11rb</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div>
            <h3>Detail Produk</h3>
            <p>{{ $product->desc }}</p>
        </div>
        <hr>
        <div>
            <h3 class="mb-4">Ulasan <span class="text-secondary fs-5">{{ count($ulasan) }}</span></h3>
            <div>
                @foreach ($ulasan as $u)
                    <div class="border border-1 rounded p-2 mb-3">
                        <div class="d-flex">
                            <img @if ($u->user->image) src="{{ asset('storage/' . $u->user->image) }}"
                            @else
                            src="/img/guest.jpg" @endif
                                alt="" style="width: 36px; height: 36px;" class="rounded-circle me-4">
                            <p class="mt-2 fw-bold">{{ $u->user->name }}</p>
                        </div>
                        <a href="{{ asset('storage/' . $u->image) }}" target="_blank">
                            <div style="max-width: 120px; max-height: 120px; overflow: hidden;">
                                <img style="width: 100%; height: 100%; aspect-ratio:1/1; object-fit: cover;"
                                    src="{{ asset('storage/' . $u->image) }}" alt="">
                            </div>
                        </a>
                        <p>{{ $u->content }}</p>
                        <div class="ratings mx-auto d-flex">
                            <div id="rate" data-rateYo-rating="{{ $u->rating }}"></div>
                            <div class="ms-3
                                d-flex">
                                <i class="fa-solid fa-thumbs-up"></i>
                                <p class="mx-2" style="font-size: 14px;">Apakah ulasan ini membantu?</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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

        $(function() {

            $("#rateYo").rateYo({
                starWidth: "20px",
                spacing: "-2px",
                readOnly: true,
            });

        });

        $(function() {

            $("#rate").rateYo({
                starWidth: "20px",
                spacing: "-2px",
                readOnly: true,
            });

        });
    </script>
@endsection
