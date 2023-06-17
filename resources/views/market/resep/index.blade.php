@extends('market.layout.main')
@section('container')
    <div class="container">
        <div class="row">

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible " role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($recipes->count() != 0)
                <h1 class="h2 text-center mt-4 mb-2 border-bottom">Resep Anda</h1>
                <a href="/resep/recipes/create" class="btn btn-primary ms-auto me-5" style="width: 150px">Buat resep</a>
                <center>
                    <div class="align-items-center d-flex justify-content-center text-center">
                        <table class="table align-middle mt-3 mx-auto">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama Resep</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recipes as $recipe)
                                    <tr>
                                        <th scope="row">
                                            {{ $recipes->perPage() * ($recipes->currentPage() - 1) + $loop->iteration }}
                                        </th>
                                        <th scope="row">
                                            @if ($recipe->image)
                                                <img src="{{ asset('storage/' . $recipe->image) }}" alt=""
                                                    style="max-width: 150px;" class="">
                                            @else
                                                <img src="../img/risol.png" alt="" style="max-width:50px;"
                                                    class="">
                                            @endif
                                        </th>
                                        <td>{{ $recipe->name }}</td>
                                        <td>{{ $recipe->type->name }}</td>
                                        <td><a href="/ide_menu/{{ $recipe->slug }}" class="badge bg-success">view</a> | <a
                                                href="/resep/recipes/{{ $recipe->id }}/edit"
                                                class="badge bg-primary">edit</a>
                                            |
                                            <form action="/resep/recipes/{{ $recipe->id }}" class="d-inline"
                                                method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="badge bg-danger border-0"
                                                    onclick="return confirm('Yakin????')">Hapus</button>
                                            </form>
                                        </td>
                                        </td>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </center>
        </div>
    </div>
@else
    <div class="container">
        <div class="row mb-3 justify-content-center">
            <img src="../img/not_found.png" alt="" style="width: 350px; margin-top: 20px;">
            <center>
                <div>
                    <h2 class="fw-bold mt-5">Yah!</h2>
                    <p>Kamu belum membuat resep, buat resepmu sendiri!</p>
                    <a href="/resep/recipes/create"><button class="rounded text-white btn btn-success">Buat
                            Resep
                            Sekarang <i class="fa-solid fa-arrow-right mx-2"></i></button></button></a>
                </div>
            </center>
        </div>
    </div>
    @endif
    </div>
    <div class="col text-center">
        {{ $recipes->appends(['search' => request()->query('search')])->links() }}
    </div>
@endsection
