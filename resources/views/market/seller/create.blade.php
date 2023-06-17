@extends('market.layout.main')
@section('container')
    <div class="p-4">
        <div>
            <h1 class="text-center">Tambah produk penjualan anda</h1>
            <hr>
            <div class="mt-5">
                <form action="/produk/products" method="post" class="w-75" enctype="multipart/form-data">
                    @csrf
                    <h3>Data Produk</h3>
                    <div class="input-group">
                        <label for="username">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control rounded mx-auto d-block w-100 border-black @error('name')
                            is-invalid
                        @enderror">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="password">Kategori</label>
                        <select
                            class="form-select border-black @error('category_id')
                            is-invalid
                        @enderror"
                            value="{{ old('category_id') }}" required name="category_id"
                            aria-label="Default select example">
                            <option selected hidden>Pilih Kategori Produk</option>
                            @foreach ($category as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                        <textarea
                            class="form-control border-black @error('desc')
                            is-invalid"
                        @enderror name="desc"
                            value="{{ old('desc') }}" id="exampleFormControlTextarea1" rows="3"></textarea>
                        @error('desc')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <h3 class="mt-4">Detail Produk</h3>
                    <div>
                        <label for="foto">Foto</label>
                        <img src="" class="img-fluid img-preview mb-3 col-sm-5" style="max-width: 500px"
                            alt="">
                        <input value="{{ old('image') }}" onchange="previewImage()" type="file" name="image"
                            id="foto"
                            class="form-control w-50 border-black  @error('image')
                            is-invalid
                        @enderror"
                            id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <p class="text-secondary" style="font-size: 11px">(gunakan foto dengan rasio 1:1)</p>
                    </div>
                    <p class="mt-3">Kondisi</p>
                    <div class="d-flex mt-4">
                        <div class="form-check">
                            <input class="form-check-input checked" type="radio" value="fresh" id="flexRadioDefault1">
                            <label class="form-check-label me-4" for="flexRadioDefault1">
                                Fresh
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="penyimpanan" id="flexRadioDefault2"
                                checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Di Penyimpanan
                            </label>
                        </div>
                    </div>
                    <p class="mt-3">Harga</p>
                    <div class="input-group mb-3 w-50">
                        <span class="input-group-text border-black">Rp.</span>
                        <input type="number" name="price"
                            class="form-control border-black @error('price')
                            is-invalid
                        @enderror"
                            value="{{ old('price') }}">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <p class="mt-3">Stok</p>
                    <div class="input-group mb-3 w-50">
                        <input type="text" name="stock" value="{{ old('stock') }}"
                            class="form-control border-black @error('stock')
                            is-invalid
                        @enderror">
                        @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-success mt-2 mb-3">Tambah</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
