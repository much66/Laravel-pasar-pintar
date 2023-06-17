<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Pasar Pintar</title>
    <style>
        .input {
            border: none;
            border-bottom: 2px solid #379237;
            padding: 5px 10px;
            outline: none;
            background-color: #dadada;
        }
    </style>
</head>

<body style="background-color: #379237;">
    <div class="mx-auto" style="width: 35%; margin-top: 100px;">
        <div class="bg-white rounded p-2">
            <div>
                <center><img src="./img/logoori.png" alt="" style="width: 150px;" class="m-2"></center>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="p-3">
                <h1 class="fw-bold fs-3 text-center text-black">Login</h1>
                <form action="/login" method="POST">
                    @csrf
                    <div>
                        <label for="username" class="d-block">Username</label>
                        <input type="text" name="username"
                            class="input mx-auto w-100 d-block @error('username')
                            is-invalid
                        @enderror">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="password" class="d-block">Password</label>
                        <input type="password" name="password"
                            class="input w-100 mx-auto d-block @error('password')
                            is-invalid
                        @enderror">
                    </div>
                    <center><button class="btn btn-success mt-4 mb-3" type="submit">Login</button></center>
                </form>
                <p class="text-center mt-4">Tidak punya akun? Buat disini <span><a href="/register"
                            class="text-success">Sign Up</a></span></p>
                <p class="text-center "><a href="/dashboard" class="text-success">Lewati</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
