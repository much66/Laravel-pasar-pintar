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
    <div class="mx-auto" style="width: 35%; margin: 8px;">
        <div class="bg-white rounded p-2 mt-4">
            <div>
                <center><img src="./img/logoori.png" alt="" style="width: 150px;" class="m-2"></center>
            </div>
            <div class="p-3">
                <h1 class="fw-bold fs-3 text-center text-black">Register</h1>
                <form action="/register" method="post">
                    @csrf
                    <div>
                        <label for="name" class="d-block">Nama</label>
                        <input type="text" name="name" id="name" autofocus
                            class="input mx-auto w-100 d-block @error('name')
                            is-invalid
                        @enderror"
                            required value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="username" class="d-block">Username</label>
                        <input type="text" name="username" id="username"
                            class="input mx-auto w-100 d-block @error('username')
                            is-invalid
                        @enderror"
                            required value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-evenly mt-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="L"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
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
                    <div class="mt-4">
                        <label for="password" class="d-block">Password</label>
                        <input type="password" name="password" id="password"
                            class="input w-100 mx-auto d-block @error('password')
                            is-invalid
                        @enderror"
                            required>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="password_confirmation" class="d-block">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="input w-100 mx-auto d-block @error('password_confirmation')
                            is-invalid
                        @enderror"
                            required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-evenly mt-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="pedagang"
                                id="flexRadioDefault1" required>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Pedagang
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="pembeli"
                                id="flexRadioDefault2" checked required>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Pembeli
                            </label>
                        </div>
                    </div>
                    <center><button class="btn btn-success mt-4 mb-3" type="submit">Sign Up</button></center>
                </form>
                <p class="text-center mt-4">Sudah punya akun? Login disini <span><a href="/login"
                            class="text-success">Login</a></span></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
