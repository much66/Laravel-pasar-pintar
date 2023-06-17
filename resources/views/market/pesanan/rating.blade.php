@extends('market.layout.main')
@section('container')
    <style>
        .rating-stars ul>li.star>i.fa {
            font-size: 2.5em;
            color: #ccc;
        }

        .rating-stars ul>li.star.hover>i.fa {
            color: #FFCC36;
        }

        .rating-stars ul>li.star.selected>i.fa {
            color: #F8BE2C;
        }

        .rating-stars ul {
            list-style-type: none;
            padding: 0;
        }

        .rating-stars ul>li.star {
            display: inline-block;
        }
    </style>

    <div class="p-4">
        <h3 class="text-center fw-bold">Ulasan</h3>
        <div>
            <div class="d-flex w-100">
                <div>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="" style="width: 150px;">
                </div>
                <div class="mx-3">
                    <h2>{{ $product->name }}</h2>
                    <p>{{ $product->desc }}.</p>
                    <p class="fw-bold">{{ $product->user->name }}</p>
                </div>
            </div>
            <hr>
            <form action="/pesanan/ulasan/create" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <p>Tambahkan foto :</p>
                <div class="input-group mt-2 w-50 d-block">
                    <img src="" class="img-fluid img-preview mb-3 col-sm-5" alt="">
                    <input type="file" name="image" value="{{ old('image') }}" id="image"
                        class="form-control w-100" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"
                        onchange="previewImage()" aria-label="Upload">
                </div>
                <div class="d-flex justify-content-center">
                    <div class="w-50">
                        <textarea class="form-control my-3" required id="exampleFormControlTextarea1" name="content"
                            data-value="{{ old('image') }}" placeholder="Ulasanmu..." rows="3"></textarea>
                    </div>
                    <div class="w-50">
                        <div class='rating-stars text-center d-block'>
                            <ul id='stars'>
                                <div style="margin-left: 230px;" id="rateYo" class="rateYo" data-rateYo-rating="0"
                                    data-rateYo-num-stars="5" data-rateYo-star-width="40px" data-rateYo-spacing="4px"
                                    data-rateYo-score="3"></div>
                            </ul>
                        </div>
                        <div>
                            <span style="margin-left: 340px" class='result' id="ratingValue">0</span>
                            <input type="hidden" name="rating" id="rating">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3 mb-3">Kirim</button>
            </form>
        </div>
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

        $(function() {
            var rateYo = $("#rateYo").rateYo({
                rating: 3.2,
                spacing: "10px",
                onChange: function(rating, rateYoInstance) {
                    $("#ratingValue").text(rating);
                    $("#rating").val(rating);
                }
            });
        });

        function responseMessage(msg) {
            $('.success-box').fadeIn(200);
            $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }
    </script>
@endsection
