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
                <div class="col-md-6 col-lg-4">
                    <h4 class="text-center text-primary mb-4">Processing Orders</h4>
                    @if ($processes->count() > 0)
                        @foreach ($processes as $process)
                            <div class="card mt-3 shadow-lg border-0 rounded overflow-hidden">
                                <div class="card-body">
                                    <p class="d-inline-flex gap-1">
                                        <a class="btn btn-primary" data-bs-toggle="collapse"
                                            href="#collapseExample{{ $process->id }}" role="button"
                                            aria-expanded="false" aria-controls="collapseExample">Queue:
                                            {{ $process->queue }}
                                        </a>
                                    </p>
                                    <div class="collapse" id="collapseExample{{ $process->id }}">
                                        <div class="card card-body">
                                            @foreach ($process->foods as $food)
                                                <p class="mb-1 text-secondary">
                                                    <strong>{{ $food->name }}</strong>
                                                    <span class="badge bg-secondary ms-2">{{ $food->pivot->quantity }}
                                                        ta</span>
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="card mt-3 shadow-lg border-0 rounded overflow-hidden">
                            <div class="card-body">
                                <p class="text-muted text-center">No orders are currently processing.</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-6 col-lg-4">
                    <h4 class="text-center text-success mb-4">Completed Orders</h4>
                    @if ($dones->count() > 0)
                        @foreach ($dones as $done)
                            <div class="card mt-3 shadow-lg border-0 rounded overflow-hidden">
                                <div class="card-body">
                                    <p class="d-inline-flex gap-1">
                                        <a class="btn btn-success" data-bs-toggle="collapse"
                                            href="#collapseExample{{ $done->id }}" role="button"
                                            aria-expanded="false" aria-controls="collapseExample">Queue:
                                            {{ $done->queue }}
                                        </a>
                                    </p>
                                    <div class="collapse" id="collapseExample{{ $done->id }}">
                                        <div class="card card-body">
                                            @foreach ($done->foods as $food)
                                                <p class="mb-1 text-secondary">
                                                    <strong>{{ $food->name }}</strong>
                                                    <span class="badge bg-secondary ms-2">{{ $food->pivot->quantity }}
                                                        ta</span>
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="card mt-3 shadow-lg border-0 rounded overflow-hidden">
                            <div class="card-body">
                                <p class="text-muted text-center">No orders have been completed.</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-6 col-lg-4">
                    <h4 class="text-center text-info mb-4">Given Orders</h4>
                    @if ($givens->count() > 0)
                        @foreach ($givens as $give)
                            <div class="card mt-3 shadow-lg border-0 rounded overflow-hidden">
                                <div class="card-body">
                                    <p class="d-inline-flex gap-1">
                                        <a class="btn btn-info" data-bs-toggle="collapse"
                                            href="#collapseExample{{ $give->id }}" role="button"
                                            aria-expanded="false" aria-controls="collapseExample">Queue:
                                            {{ $give->queue }}
                                        </a>
                                    </p>
                                    <div class="collapse" id="collapseExample{{ $give->id }}">
                                        <div class="card card-body">
                                            @foreach ($give->foods as $food)
                                                <p class="mb-1 text-secondary">
                                                    <strong>{{ $food->name }}</strong>
                                                    <span class="badge bg-secondary ms-2">{{ $food->pivot->quantity }}
                                                        ta</span>
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="card mt-3 shadow-lg border-0 rounded overflow-hidden">
                            <div class="card-body">
                                <p class="text-muted text-center">No orders have been given.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
