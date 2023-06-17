@extends('market.layout.main')
@section('container')
    <style>
        /* Popup container - can be anything you want */
        .popup {
            position: relative;
            display: inline-block;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* The actual popup */
        .popup .popuptext {
            visibility: hidden;
            width: 160px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 8px 0;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -80px;
        }

        /* Popup arrow */
        .popup .popuptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        /* Toggle this class - hide and show the popup */
        .popup .show {
            visibility: visible;
            -webkit-animation: fadeIn 1s;
            animation: fadeIn 1s;
        }

        /* Add animation (fade in the popup) */
        @-webkit-keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
    <hr>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible w-50 mx-auto mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="p-4">
        <div class="d-flex justify-content-center">
            <div class="mx-3">
                <a href="/pesanan_seller" class="text-success nav_link">Semua Pesanan</a>
            </div>
            <div class="mx-3">
                <a href="/pesanan_seller?status=sedang%20diproses" class="text-success nav_link">Pesanan Baru</a>
            </div>
            <div class="mx-3">
                <a href="/pesanan_seller?status=dalam%20perjalanan" class="text-success nav_link">Dalam Pengiriman</a>
            </div>
            <div class="mx-3">
                <a href="/pesanan_seller?status=diterima" class="text-success nav_link">Selesai</a>
            </div>
            <div class="mx-3">
                <a href="/pesanan_seller?status=dibatalkan" class="text-success nav_link">Dibatalkan</a>
            </div>
        </div>
        <div>
            <div class="mt-3">
                <table class="table mx-auto">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Produk</th>
                            <th scope="col">Kuantitas</th>
                            <th scope="col">Total</th>
                            <th scope="col">Pembeli</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan as $pesan)
                            <tr class="text-center">
                                <td>
                                    <div class="d-flex p-1">
                                        <img src="{{ asset('storage/' . $pesan->product->image) }}" alt=""
                                            class="mt-3 m-2" style="width: 100px; height:100px;">
                                        <p class="mx-auto mt-5">{{ $pesan->product->name }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <p class="mt-5">{{ $pesan->kuantitas }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="mt-5">
                                        <p>Rp.{{ number_format($pesan->price_total) }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="mt-5">
                                        <p>{{ '@' . $pesan->user->name }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="mt-5">
                                        <p>{{ $pesan->user->alamat }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="mt-5 popup" onclick="myFunction{{ $pesan->id }}()">
                                        <i class="fa-solid fa-note-sticky" style="font-size:30px"></i>
                                        <span class="popuptext p-2"
                                            id="myPopup{{ $pesan->id }}">{{ $pesan->catatan }}</span>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    @if ($pesan->status == 'sedang diproses')
                                        <div class="mt-3 mb-2 mx-auto border bg-primary text-white border-1 rounded-pill"
                                            style="width: 150px;">
                                            <p class="m-auto">butuh verifikasi</p>
                                        </div>
                                        <div>
                                            <form method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $pesan->id }}">
                                                <input type="hidden" name="user_id" value="{{ $pesan->user->id }}">
                                                <input type="hidden" name="price" value="{{ $pesan->price_total }}">
                                                <button type="submit" name="status" value="dalam perjalanan"
                                                    class="btn btn-success" onclick="return confirmSubmit()"
                                                    formaction="{{ route('dikirim.pesan') }}">Kirim</button>
                                                <button type="submit" value="dibatalkan" name="status"
                                                    class="btn btn-danger" onclick="return cancelSubmit()"
                                                    formaction="{{ route('hapus.pesan') }}">Batal</button>
                                            </form>
                                        </div>
                                    @elseif ($pesan->status == 'dalam perjalanan')
                                        <div class="my-5 mx-auto border bg-secondary text-white border-1 rounded-pill"
                                            style="width: 150px;">
                                            <p class="m-auto">{{ $pesan->status }}</p>
                                        </div>
                                    @elseif ($pesan->status == 'diterima')
                                        <div class="my-5 mx-auto border bg-success text-white border-1 rounded-pill"
                                            style="width: 100px;">
                                            <p class="m-auto">{{ $pesan->status }}</p>
                                        </div>
                                    @elseif ($pesan->status == 'dibatalkan')
                                        <div class="my-5 mx-auto border bg-danger text-white border-1 rounded-pill"
                                            style="width: 100px;">
                                            <p class="m-auto">{{ $pesan->status }}</p>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <script>
                                function cancelSubmit() {
                                    var result = confirm(
                                        "Kembalikan uang sebesar Rp{{ number_format($pesan->price_total, 0, ',', '.') }} kepada pembeli???   "
                                    );
                                    if (result) {
                                        return true; // Lanjutkan submit form
                                    } else {
                                        return false; // Batalkan submit form
                                    }
                                }

                                function confirmSubmit() {
                                    var result = confirm(
                                        "Kirim produk sekarang?"
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
            {{ $pesanan->links() }}
        </div>
    </div>
    @foreach ($pesanan as $pesan)
        <script>
            // When the user clicks on div, open the popup
            function myFunction{{ $pesan->id }}() {
                var popup = document.getElementById("myPopup{{ $pesan->id }}");
                popup.classList.toggle("show");
            }
        </script>
    @endforeach
@endsection
