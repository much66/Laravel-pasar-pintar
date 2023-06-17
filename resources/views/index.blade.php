<!DOCTYPE html>
<html lang="en" class="smooth-scroll">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasar Pintar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes float {
            0% {
                transform: translatey(0px);
            }

            50% {
                transform: translatey(-20px);
            }

            100% {
                transform: translatey(0px);
            }
        }

        .logo {
            animation: float 6s ease-in-out infinite;
        }

        #map {
            height: 100%;
        }

        .nav-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body class="m-0">
    <div id="Home"></div>
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: #FFFF;">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="mx-auto">
                    <ul class="navbar-nav fw-bold">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" style="color: #379237;"
                                href="#Home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: #379237;" href="#Tentang">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: #379237;" href="#Fitur">Fitur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: #379237;" href="#Kontak">Kontak</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <center>
        <div class="mt-5 p-4 mb-3">
            <img src="./img/logoori.png" alt="" style="width: 700px;" class="logo">
            <h2 class="fs-1 fw-bold">Belanja di <span style="color: #379237;">Pasar Pintar</span> Hanya dengan Ujung
                Jari !</h2>
            <p class="fs-4">Segala kebutuhan panganmu ada disini!</p>
            <a @auth href="/dashboard"
            @else
            href="/login" @endauth>
                <button class="fs-5 p-3 mt-3 rounded text-white btn btn-success">Mulai Belanja! <i
                        class="fa-solid fa-arrow-right mx-2"></i></button></a>
        </div>
    </center>

    <img src="./img/boundary2.png" alt="" class="w-100" id="Tentang">
    <div style="background-color: #379237;" class="p-4">
        <h1 class="fw-bold text-white fs-1 text-decoration-underline text-center">Tentang</h1>
        <p class="fw-bold text-white fs-3 text-center">Pasar Pancasila</p>
        <div class="d-flex p-3 m-3">
            <img src="./img/pasar.png" alt="" class="rounded" style="width: 500px;">
            <div class="border-start border-light border-2 m-3"></div>
            <div>
                <p class="text-white mt-5">Pasar Pancasila Tasikmalaya adalah sebuah pasar tradisional yang terletak di
                    kota Tasikmalaya, Jawa Barat. Pasar ini memiliki sejarah yang panjang sebagai pusat perdagangan di
                    daerah tersebut, dan hingga kini masih menjadi tempat yang ramai dikunjungi oleh warga setempat
                    maupun wisatawan. Di dalam pasar Pancasila, terdapat berbagai jenis barang dagangan yang dijual,
                    mulai dari kebutuhan sehari-hari seperti bahan makanan, pakaian, hingga kerajinan tangan yang khas
                    dari daerah Tasikmalaya. Selain itu, pengunjung pasar juga dapat menemukan berbagai kuliner khas
                    daerah Tasikmalaya, seperti sate maranggi, empal gentong, dan nasi tutug oncom yang sangat terkenal
                    di kalangan wisatawan.</p>
            </div>
        </div>
        <div class="d-flex p-3 m-3">
            <div>
                <p class="text-white mt-5">Pasar Pancasila Tasikmalaya juga memiliki nuansa yang khas dan ramah
                    lingkungan. Di dalam pasar, terdapat banyak pedagang yang masih menggunakan cara tradisional dalam
                    menjual barang dagangannya, seperti menawarkan harga secara berkeliling dan bersikap ramah terhadap
                    pengunjung. Hal ini menjadikan pasar Pancasila sebagai tempat yang unik dan memberikan pengalaman
                    yang berbeda bagi pengunjung yang ingin merasakan budaya dan kearifan lokal di Tasikmalaya.</p>
            </div>
            <div class="border-end border-light border-2 m-3"></div>
            <img src="./img/vegetable.png" alt="" class="rounded" style="width: 500px;">
        </div>
    </div>
    <img src="./img/boundary1.png" alt="" class="w-100" id="Fitur">

    <div class="mt-4 mb-5 p-5">
        <h1 class="fw-bold fs-1 text-decoration-underline text-center" style="color:#379237">Fitur</h1>
        <div class="d-flex justify-content-evenly text-center">
            <div class="w-25 p-3 rounded m-3 shadow">
                <i class="fa-solid fa-truck-fast m-3" style="color:#379237; font-size: 64px;"></i>
                <h2>Pengiriman Cepat</h2>
                <p>Kecepatan dan ketepatan terpadu, pengiriman cepat dari penjual. Percayakan kami untuk memenuhi
                    kebutuhan pengiriman Anda dengan kecepatan kilat, menjadikan setiap langkah sebagai
                    lompatan keefektifan Waktu Anda.</p>
            </div>
            <div class="w-25 p-3 rounded m-3 shadow">
                <i class="fa-solid fa-lock m-3" style="color:#379237; font-size: 64px;"></i>
                <h2>Belanja Praktis</h2>
                <p>Belanja praktis, kebutuhan terpenuhi dengan mudah! Temukan segala yang Anda perlukan dengan cepat dan
                    nyaman di sini. Hemat waktu, hemat tenaga, dan nikmati kemudahan belanja dalam genggaman tangan
                    Anda.</p>
            </div>
            <div class="w-25 p-3 rounded m-3 shadow">
                <i class="fa-solid fa-utensils m-3" style="color:#379237; font-size: 64px;"></i>
                <h2>Ide Menu</h2>
                <p>Temukan Kekayaan Rasa dalam Setiap Ide Menu, Temani Hari-harimu dengan Kreasi Kuliner Tak Terbatas
                    yang Memukau Selera dan Menggugah Imajinasi, Menghadirkan Kenikmatan yang Tak Terlupakan .</p>
            </div>
        </div>
    </div>

    <img src="./img/boundary2.png" alt="" class="w-100">
    <div class="p-5" style="background-color: #379237;" id="Kontak">
        <h1 class="fw-bold fs-1 text-decoration-underline text-center text-white mb-5">Kontak</h1>
        <div class="d-flex justify-content-evenly">
            <div>
                <img src="./img/logo1.png" alt="" class="mt-5 w-75">
            </div>
            <div class="border-start border-light border-2 m-4"></div>
            <div class="text-white m-4 mt-5 text-center">
                <p>Hubungi Kami dengan :</p>
                <div class="d-flex justify-content-center">
                    <a href="" class="text-white"><i class="fa-brands fa-google mx-2 fs-3"></i></a>
                    <a href="" class="text-white"><i class="fa-brands fa-facebook-f mx-2 fs-3"></i></a>
                    <a href="" class="text-white"><i class="fa-brands fa-twitter mx-2 fs-3"></i></a>
                    <a href="" class="text-white"><i class="fa-brands fa-instagram mx-2 fs-3"></i></a>
                    <a href="" class="text-white"><i class="fa-brands fa-tiktok mx-2 fs-3"></i></a>
                </div>
            </div>
            <div class="text-white">
                <p>Jl. Ps. Pancasila, Lengkongsari, Kec. Tawang, Kab. Tasikmalaya, Jawa Barat 46111</p>
                <div class="mx-auto" id="googleMap" style="width:75%;height:200px;"></div>
            </div>
        </div>
    </div>
    <div class="p-2" style="background-color: #379237;">
        <p class="text-center text-white">© Kelompok 69 | 2023</p>
    </div>

    <script src="http://maps.googleapis.com/maps/api/js"></script>

    <script>
        function initialize() {
            var propertiPeta = {
                center: new google.maps.LatLng(-7.325631807118526, 108.22866429983715),
                zoom: 9,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
