@extends('market.layout.main')
@section('container')
    <div class="col-lg-8 flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-center">Buat Resep Baru</h1>
    </div>
    <div class="col-lg-8">
        <form method="post" action="/resep/recipes/{{ $recipes->id }}" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Resep</label>
                <input type="text"
                    @if ($recipes->name) value="{{ $recipes->name }}"
                    @else
                    value="{{ old('name') }}" @endif
                    class="form-control @error('name')
                    is-invalid
                @enderror"
                    id="name" name="name" autofocus required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="portion" class="form-label">Jumlah Porsi</label>
                <input type="text"
                    @if ($recipes->portion) value="{{ $recipes->portion }}"
                    @else
                    value="{{ old('portion') }}" @endif
                    class="form-control @error('portion')
                    is-invalid
                @enderror"
                    id="portion" name="portion" autofocus required>
                @error('portion')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="cooking_time" class="form-label">Lama Memasak</label>
                <input type="text"
                    @if ($recipes->cooking_time) value="{{ $recipes->cooking_time }}"
                    @else
                    value="{{ old('cooking_time') }}" @endif
                    class="form-control @error('cooking_time')
                    is-invalid
                @enderror"
                    id="cooking_time" name="cooking_time" autofocus required>
                @error('cooking_time')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Kategori</label>
                <select class="form-select" name="type_id">
                    @foreach ($types as $type)
                        @if (old('type_id') == $type->id)
                            <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                        @else
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label><br>
                <img src="{{ asset('storage/' . $recipes->image) }}" class="img-fluid img-preview mb-3 col-sm-5"
                    alt="">
                <input class="form-control @error('image')
                is-invalid
                @enderror"
                    value="{{ $recipes->image }}" type="file" id="image" onchange="previewImage()" name="image">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="igredient"
                    class="form-label @error('igredient')
                is-invalid
                @enderror">Bahan -
                    bahan</label>
                @error('igredient')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <input type="hidden"
                    @if ($recipes->igredient) value="{{ $recipes->igredient }}"
                    @else
                    value="{{ old('igredient') }}" @endif
                    id="igredient" name="igredient">
                <trix-editor input="igredient"></trix-editor>
            </div>
            <div class="mb-3">
                <label for="description"
                    class="form-label @error('description')
                is-invalid
                @enderror">Cara
                    Membuat</label>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <input type="hidden"
                    @if ($recipes->description) value="{{ $recipes->description }}"
                    @else
                    value="{{ old('description') }}" @endif
                    id="description" name="description">
                <trix-editor input="description"></trix-editor>
            </div>
            <label for="product_id">Pilih produk</label>
            <div class="select_picker mb-3">
                <select id="product_id" data-live-search="true" multiple class="form-select w-100" name="product_id[]">
                    @foreach ($product as $p)
                        <option class="w-100" value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Resep</button>
        </form>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        $(document).ready(function() {
            $('.select_picker select').selectpicker();
        })
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
