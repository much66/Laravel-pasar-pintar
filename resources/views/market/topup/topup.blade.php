   @extends('market.layout.main')
   @section('container')
       <div class="p-4">
           <h1 class="text-center fw-bold fs-1">Isi Saldo</h1>
           <div class="mt-5">
               <h3 class="text-center fw-bold fs-2">1011 0783 8792 <i class="fa-solid fa-copy" data-bs-toggle="tooltip"
                       data-bs-placement="bottom" title="Salin Kode"></i></h3>
               <div>
                   <p class="fs-5">Metode Pembayaran :</p>
                   <div class="d-flex">
                       <a href="" class="me-3"><button class="btn btn-outline-secondary">
                               <img src="../img/dana.png" alt="" style="width: 130px;" class="m-2">
                           </button></a>
                       <a href="" class="me-3"><button class="btn btn-outline-secondary">
                               <img src="../img/gopay.png" alt="" style="width: 100px;" class="m-2">
                           </button></a>
                       <a href="" class="me-3"><button class="btn btn-outline-secondary">
                               <img src="../img/ovo.png" alt="" style="width: 90px;" class="m-2">
                           </button></a>
                   </div>
                   <div class="mt-5">
                       <h4>Langkah Pembayaran :</h4>
                       <ul style="list-style-type: none;">
                           <li>
                               <p>1. Buka Aplikasi Dana Anda.</p>
                           </li>
                           <li>
                               <p>2. Klik pada tombol kirim uang atau send money.</p>
                           </li>
                           <li>
                               <p>3. Masukkan Kode pembayaran <span class="fw-bold">1011 0783 8792</span> pada kolom cari
                                   bank akun.</p>
                           </li>
                           <li>
                               <p>4. Masukkan jumlah saldo yang ingin ditop-up ke saldo PasarPay.</p>
                           </li>
                           <li>
                               <p>5. Selanjutnya tekan lanjutkan untuk memproses pembayaran.</p>
                           </li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
   @endsection
