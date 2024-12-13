<div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">FlashFood</a>
            <div class="collapse navbar-collapse" id="ftco-navbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="/client"
                           class="nav-link">All</a>
                    </li>
                    @foreach($categories as $category)
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
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
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
                <div class="col-12">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <tr>
                            <td>Name</td>
                            <td>Price</td>
                            <td>Count</td>
                            <td>Total</td>
                            <td>Remove</td>
                        </tr>
                        @foreach($foods as $food)
                            @if(isset($carts[$food->id]))
                                <tr>
                                    <td>{{ $food->name }}</td>
                                    <td>{{ number_format($food->price) }}</td>
                                    <td>
                                        <button class="btn btn-primary" wire:click="lowQuantity({{$food->id}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                                            </svg>
                                        </button>
                                        {{ $carts[$food->id]['quantity'] ?? 0 }}
                                        <button class="btn btn-success" wire:click="addQuantity({{$food->id}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                            </svg>
                                        </button>
                                    </td>
                                    <td>{{ number_format($carts[$food->id]['quantity'] * $food->price) ?? 0 }}</td>
                                    <td>
                                        <button class="btn btn-secondary" wire:click="remove({{$food->id}})">remove</button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                    <br>
                    <a  href="/client" class="btn btn-info mr-3">Back</a>
                    <button class="btn btn-primary mr-3 " wire:click="cancel">Cancel</button>
                    <button class="btn btn-success" wire:click="submit">Submit</button>
                    <div class="text-center">
                        <output>Total price: {{number_format($total)}}</output>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
