@extends('market.layout.main')
@section('container')
    <style>
        .chat:before {
            content: '';
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            background: linear-gradient(transparent 150px, white);
        }
    </style>

    <div class="p-5">
        <a href="/chatin">
            <div class="d-flex">
                <div>
                    <img src="../img/ateng.png" alt="" style="width: 60px; height: 60px;" class="rounded-circle">
                </div>
                <div class="ms-3 text-black d-flex justify-content-between w-100">
                    <div>
                        <p class="fw-bold">CR7Shop</p>
                        <p class="chat">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="float-end mt-4">
                        <span style="border-radius: 50%; background-color: red;" class="text-white w-25 p-2">9</span>
                    </div>
                </div>
            </div>
        </a>
        <hr>
    </div>
@endsection
