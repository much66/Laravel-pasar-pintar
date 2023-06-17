<header class="header d-flex" id="header" style="background-color: #379237;">
    <a href="/dashboard" class="me-auto"><img src="./img/logo1.png" alt="" style="width:75px;" class="mx-auto"></a>
    @if (Request::is('dashboard*'))
        <center>
            <form action="/dashboard/product">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('user'))
                    <input type="hidden" name="user" value="{{ request('user') }}">
                @endif
                @if (request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif
                <div class="input-group mb-3 my-3" style="width:700px;">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control" value="{{ request('search') }}" name="search"
                        placeholder="Cari kebutuhanmu disini..." aria-describedby="basic-addon1">
                </div>
            </form>
        </center>
    @elseif (Request::is('ide_menu*'))
        <form action="/ide_menu/menu">
            @if (request('type'))
                <input type="hidden" name="type" value="{{ request('type') }}">
            @endif
            @if (request('user'))
                <input type="hidden" name="user" value="{{ request('user') }}">
            @endif
            <div class="input-group mb-3 my-3 mx-auto" style="width:700px;">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control" value="{{ request('search') }}" name="search"
                    placeholder="Cari Ide Resep disini..." aria-describedby="basic-addon1">
            </div>
        </form>
    @endif
    @auth
        <div class="mt-3 ms-auto text-white d-flex">
            <div class="mx-2">
                <a href="/chatout">
                    <button type="button" class="icon-button">
                        <span class="material-icons fs-2"><i class="fa-regular fa-comment-dots text-white"></i></span>
                        <span class="icon-button__badge">99</span>
                    </button>
                </a>
            </div>
            <div class="me-2">
                <a href="/topup" style="color: white">
                    <p><span class="mx-2"><i class="fa-solid fa-coins"></i></span>Rp.
                        {{ number_format(auth()->user()->saldo, 0, ',', '.') }}</p>
                </a>
                <!--ini hrefnya ke yang topup blade-->
            </div>
        </div>
    @else
        <a href="/login" class="btn btn-outline-light ms-auto">Login</a>
        <a href="/register" class="btn btn-outline-light mx-2">Sign Up</a>
    @endauth
</header>
