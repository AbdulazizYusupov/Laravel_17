<div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">FlashFood</a>
            <div class="collapse navbar-collapse" id="ftco-navbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="/client" class="nav-link">All</a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a href="{{ route('category.foods', $category->id) }}"
                                class="nav-link">{{ $category->name }}</a>
                        </li>
                    @endforeach
                    <li class="nav-item ml-3">
                        <a href="/cart" class="nav-link d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cart" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                            </svg>
                            <span class="ml-2">Cart
                                <span class="badge badge-pill badge-light">
                                    {{ $foodCount }}
                                </span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item ml-3">
                        <a href="/purchase" class="nav-link d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bag-check" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1.5a2 2 0 0 1 2 2V3h3.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 12 12H4a.5.5 0 0 1-.491-.408l-1.5-8A.5.5 0 0 1 2.5 3H6v-.5a2 2 0 0 1 2-2zm-1 2V3h2v-.5a1 1 0 1 0-2 0zm-3.682 1l1.313 7h8.738l1.313-7H3.318zM5 11.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1H5.5a.5.5 0 0 1-.5-.5zm7.354-5.646a.5.5 0 1 1-.708.708l-2-2a.5.5 0 0 1 .708-.708l1.147 1.146L11.646 5.5z" />
                            </svg>
                            <span class="ml-2">Purchased</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="ftco-section">
        <div class="container mt-3">
            <div class="row">
                @foreach ($foods as $food)
                    <div class="col-md-6 col-lg-4">
                        <div class="menu-wrap">
                            <div class="menus d-flex">
                                <div class="menu-img img"
                                    style="background-image: url({{ asset('storage/' . $food->image) }});"></div>
                                <div class="text">
                                    <div class="d-flex">
                                        <div class="one-half">
                                            <h3>{{ $food->name }}</h3>
                                            <button wire:click="addToCart({{ $food->id }})"
                                                class="btn btn-outline-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                                    <path
                                                        d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z" />
                                                    <path
                                                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="one-forth">
                                            <span class="price">{{ number_format($food->price) }} so'm</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $foods->links() }}
            </div>
        </div>
    </section>
</div>
