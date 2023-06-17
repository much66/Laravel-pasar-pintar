@extends('market.layout.main')
@section('container')
    <style>
        .right-chat {
            margin-left: auto;
            margin-right: 0;
        }
    </style>

    <div class="p-5">
        <div class="border border-black rounded">
            <div class="d-flex">
                <div>
                    <img src="{{ asset('storage/' . $user->image) }}" alt="" style="width: 60px; height: 60px;"
                        class="rounded-circle m-3">
                </div>
                <div>
                    <p class="fw-bold mt-3">{{ $user->name }}</p>
                    <p style="font-size: 12px;"><span><i class="fa-solid fa-circle text-success me-3"></i></span>Online</p>
                </div>
            </div>
            <div class="p-4">
                <div>
                    <p class="fw-bold">{{ $user->name }}</p>
                </div>
                <div class="rounded w-50 p-3 d-block" style="background-color: #C2E6F4;">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae recusandae, quae aliquid laudantium
                    eos harum inventore. Eum unde pariatur, ad nostrum at odit facilis temporibus asperiores aliquam maxime
                    illum eligendi?
                </div>
                <div>
                    <p class="fw-bold text-end">{{ auth()->user()->name }}</p>
                </div>
                <div class="rounded w-50 p-3 pull-right d-block right-chat" style="background-color: #C2E6F4;">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae recusandae, quae aliquid laudantium
                    eos harum inventore. Eum unde pariatur, ad nostrum at odit facilis temporibus asperiores aliquam maxime
                    illum eligendi?
                </div>
                <div class="input-group mb-3 w-50 my-3 mx-auto">
                    <input type="text border border-black" class="form-control" placeholder="Ketik Pesan..."
                        aria-describedby="basic-addon1">
                    <span class="input-group-text" id="basic-addon1"><button style="border: none; outline:none;"><i
                                class="fa-solid fa-paper-plane"></i></button></span>
                </div>
            </div>
        </div>
    </div>
@endsection
