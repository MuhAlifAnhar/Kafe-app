<section id="menu">
    <div class="container-fluid menu bg-light py-6">
        <div class="container">
            <div class="text-center wow bounceInUp">
                <small
                    class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Menu</small>
                <h1 class="display-5 mb-5">Menu Paling Populer di Cafe Kami</h1>
            </div>
            <div class="tab-class text-center">
                <ul class="nav nav-pills d-inline-flex justify-content-center mb-5 wow bounceInUp" data-wow-delay="0.1s">
                    <li class="nav-item p-2">
                        <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill active"
                            data-bs-toggle="pill" href="#tab-6">
                            <span class="text-dark" style="width: 150px;">Coffee</span>
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill" data-bs-toggle="pill"
                            href="#tab-7">
                            <span class="text-dark" style="width: 150px;">Mocktail</span>
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="d-flex py-2 mx-2 border border-primary bg-white rounded-pill" data-bs-toggle="pill"
                            href="#tab-8">
                            <span class="text-dark" style="width: 150px;">Food</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-6" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            @foreach ($menu_coffee as $coffee)
                                <div class="col-sm-12 col-md-6 col-lg-6 wow bounceInUp" data-wow-delay="0.1s">
                                    <div class="menu-item d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded-circle"
                                            src="{{ asset('storage/' . $coffee->image) }}" width="70"
                                            alt="{{ $coffee->name }}">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <div
                                                class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                                <h4>{{ $coffee->name }}</h4>
                                                <h4 class="text-primary">Rp.
                                                    {{ number_format($coffee->price, 0, ',', '.') }}</h4>
                                            </div>
                                            <p class="mb-0">{{ Str::limit($coffee->description, 120) }}</p>
                                            <div class="d-flex justify-content-end align-items-end mt-2">

                                                <form action="{{ route('shopping-cart.add', $coffee->name) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="number" id="quantity" name="quantity" min="1"
                                                        value="1" class="border text-center hidden" />
                                                    <button type="submit" class="btn-sm btn-primary">
                                                        <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                                        </svg>Add to Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div id="tab-7" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            @foreach ($menu_mocktail as $mocktail)
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="menu-item d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded-circle"
                                            src="{{ asset('storage/' . $mocktail->image) }}" width="70"
                                            alt="{{ $mocktail->name }}">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <div
                                                class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                                <h4>{{ $mocktail->name }}</h4>
                                                <h4 class="text-primary">Rp.
                                                    {{ number_format($mocktail->price, 0, ',', '.') }}</h4>
                                            </div>
                                            <p class="mb-0">{{ Str::limit($mocktail->description, 120) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div id="tab-8" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            @foreach ($menu_food as $food)
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="menu-item d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded-circle"
                                            src="{{ asset('storage/' . $food->image) }}" width="70"
                                            alt="{{ $food->name }}">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <div
                                                class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">
                                                <h4>{{ $food->name }}</h4>
                                                <h4 class="text-primary">Rp.
                                                    {{ number_format($food->price, 0, ',', '.') }}</h4>
                                            </div>
                                            <p class="mb-0">{{ Str::limit($food->description, 120) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
