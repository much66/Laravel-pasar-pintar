{{-- @dd(is_null($user->field)) --}}
@extends('market.layout.main')
@section('container')
    <div class="p-5">
        @if (auth()->check() &&
                (empty(auth()->user()->alamat) || empty(auth()->user()->email) || empty(auth()->user()->no_telp)))
            <div class="p-3 mb-4 bg-danger bg-opacity-10 border border-danger rounded text-danger">
                <span><i class="fa-solid fa-circle-exclamation me-3"></i></span>Lengkapi profilmu sebelum mulai berbelanja
                terutama alamat dan kontak
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div>
            <div class="mx-auto text-center">
                @if (!$user->image == null)
                    <img src="{{ asset('storage/' . $user->image) }}" alt="" style="width: 150px; height: 150px;"
                        class="rounded-circle">
                @else
                    <img src="../img/guest.jpg" alt="" style="width: 150px; height: 150px;" class="rounded-circle">
                @endif
                <form action="{{ route('storeForm1') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mt-4 w-25 mx-auto">
                        <input type="file"
                            class="form-control @error('image')
                                is-invalid
                            @enderror"
                            name="image" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"
                            aria-label="Upload">
                        <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Submit</button>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </form>
                <div class="mt-3">
                    <h4 class="fw-bold">{{ '@' . $user->username }}</h4>
                    <p>{{ $user->name }}</p>
                </div>
            </div>
            <div class="w-75 mx-auto">
                <form action="{{ route('storeForm2') }}" method="post">
                    @csrf
                    <h3>Biodata</h3>
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="text" value="{{ $user->name }}" name="name"
                        class="form-control  @error('name')
                                is-invalid
                            @enderror"
                        id="exampleFormControlInput1" placeholder="Nama">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-group">
                        <label for="inputDate" class="col-1 col-form-label w-100">Tanggal Lahir</label>
                        <input type="date" value="{{ $user->tanggal_lahir }}" name="tanggal_lahir"
                            class="form-control  @error('tanggal_lahir')
                                is-invalid
                            @enderror"
                            id="inputDate" name="inputDate">
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <p>Kelamin</p>
                    <div class="d-flex mt-4">
                        <div class="form-check">
                            <input class="form-check-input checked" type="radio" name="gender" value="L"
                                id="flexRadioDefault1">
                            <label class="form-check-label me-4" for="flexRadioDefault1">
                                Laki-Laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="P"
                                id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Perempuan
                            </label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success mt-3 mb-3">Submit</button>
                </form>
                <h3>Kontak</h3>
                <form action="{{ route('storeForm3') }}" method="post">
                    @csrf
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email"
                        class="form-control @error('email')
                                is-invalid
                            @enderror"
                        value="{{ $user->email }}" name="email" id="exampleFormControlInput1"
                        placeholder="name@example.com">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="no_telp" class="form-label mt-2">No. HP</label>
                    <div class="input-group">
                        <span class="input-group-text">+62</span>
                        <input type="text"
                            class="form-control @error('no_telp')
                                    is-invalid
                                @enderror "
                            name="no_telp" value="{{ $user->no_telp }}" id="no_telp" placeholder="+62... ">
                        @error('no_telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success mt-3 mb-3">Submit</button>
                </form>
                <h3>Alamat</h3>
                <form action="{{ route('storeForm4') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat Rumah</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-house"></i></span>
                            <textarea rows="3" type="text"
                                class="form-control @error('alamat')
                                is-invalid
                            @enderror"
                                name="alamat" id="address" placeholder="Masukkan alamat lengkap cth : Jl, RT, RW, Kel, Kec, Kode Pos Kota">{{ $user->alamat }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3 mb-3">Submit</button>
                </form>
                <div class="h4 pb-2 mb-4 mt-5 text-danger border-bottom border-danger">
                    <h2>Zona Berbahaya</h2>
                </div>
                <h3>Bank & Kartu</h3>
                <p>No. Rekening : 3212{{ $user->no_telp }}</p>
                <p>Kartu Kredit : <img src="../img/kredit.png" alt="" style="width: 100px;"></p>
                <p>Uang Digital :
                <div class="d-flex">
                    <img src="../img/dana.png" alt="" style="max-width: 100px; margin-right:10px;">
                    <img src="../img/gopay.png" alt="" style="max-width: 100px; margin-right:10px;">
                    <img src="../img/ovo.png" alt="" style="max-width: 100px; margin-right:10px;">
                </div>
                </p>
                <h3 class="mt-2">Ubah Password</h3>
                <form action="{{ route('storeForm5') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password Lama</label>
                        <input type="password" name="old_password"
                            class="form-control @if (session()->has('error')) is-invalid @endif"
                            id="exampleInputPassword1" placeholder="Masukkan Password Lama">
                        @if (session()->has('error'))
                            <div class="invalid-feedback">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <label for="exampleInputPassword1" class="form-label">Password Baru</label>
                        <input type="password" name="password"
                            class="form-control @error('password')
                            is-invalid
                        @enderror"
                            id="exampleInputPassword1" placeholder="Masukkan Password Baru">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="exampleInputPassword1" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation')
                            is-invalid
                        @enderror"
                            id="exampleInputPassword1" placeholder="Masukkan Konfirmasi Password Baru">
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success mt-3 mb-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Ambil nilai gender dari database
        var gender = '{{ $user->gender }}';

        // Cari elemen inputan radio button sesuai dengan nilai gender dari database
        var elem = document.querySelector('input[name="gender"][value="' + gender + '"]');

        // Jika elemen ditemukan, tandai opsi yang terpilih
        if (elem) {
            elem.checked = true;
        }
    </script>
@endsection
