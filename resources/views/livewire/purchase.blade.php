<div>
    <div class="content-wrapper kanban">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        {{-- <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light"
                        id="ftco-navbar">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M8 1.5a2 2 0 0 1 2 2V3h3.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 12 12H4a.5.5 0 0 1-.491-.408l-1.5-8A.5.5 0 0 1 2.5 3H6v-.5a2 2 0 0 1 2-2zm-1 2V3h2v-.5a1 1 0 1 0-2 0zm-3.682 1l1.313 7h8.738l1.313-7H3.318zM5 11.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1H5.5a.5.5 0 0 1-.5-.5zm7.354-5.646a.5.5 0 1 1-.708.708l-2-2a.5.5 0 0 1 .708-.708l1.147 1.146L11.646 5.5z" />
                                            </svg>
                                            <span class="ml-2">Purchased</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav> --}}
                    </div>
                </div>
            </div>
        </section>
        <section class="content pb-3">
            <div class="container-fluid h-100">
                <div class="card card-row card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Orders
                        </h3>
                    </div>
                    <div class="card-body">
                        @foreach ($orders as $order)
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h5 class="card-title">{{ $order->queue }}-Queue</h5>
                                    <div class="card-tools">
                                        <a wire:click="show({{ $order->id }})" class="btn btn-tool">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
                                </div>
                                @if ($allow1 == $order->id)
                                    <div class="card-body">
                                        @foreach ($order->foods as $food)
                                            <div class="custom-control">
                                                <label id="custom{{ $food->id }}">
                                                    {{ $food->name }} - {{ $food->pivot->quantity }} ta,
                                                    {{ $food->pivot->total_price }} so'm
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card card-row card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            In progress
                        </h3>
                    </div>
                    <div class="card-body">
                        @foreach ($processes as $process)
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h5 class="card-title">{{ $process->queue }}-Queue</h5>
                                    <div class="card-tools">
                                        <a wire:click="ruxsat({{ $process->id }})" class="btn btn-tool">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
                                </div>
                                @if ($allow2 == $process->id)
                                    <div class="card-body">
                                        @foreach ($process->foods as $food)
                                            <div class="custom-control">
                                                <label id="custom{{ $food->id }}">
                                                    {{ $food->name }} - {{ $food->pivot->quantity }} ta,
                                                    {{ $food->pivot->total_price }} so'm
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card card-row card-warning">
                    <div class="card-header">
                        <h3 class="card-title">
                            Dones
                        </h3>
                    </div>
                    <div class="card-body">
                        @foreach ($dones as $done)
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h5 class="card-title">{{ $done->queue }}-Queue</h5>
                                    <div class="card-tools">
                                        <a wire:click="consent({{ $done->id }})" class="btn btn-tool">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
                                </div>
                                @if ($allow3 == $done->id)
                                    <div class="card-body">
                                        @foreach ($done->foods as $food)
                                            <div class="custom-control">
                                                <label id="custom{{ $food->id }}">
                                                    {{ $food->name }} - {{ $food->pivot->quantity }} ta,
                                                    {{ $food->pivot->total_price }} so'm
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card card-row card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            Deliviring by waiter
                        </h3>
                    </div>
                    <div class="card-body">
                        @foreach ($givens as $give)
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h5 class="card-title">{{ $give->queue }}-Queue</h5>
                                    <div class="card-tools">
                                        <a wire:click="see({{ $give->id }})" class="btn btn-tool">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
                                </div>
                                @if ($allow4 == $give->id)
                                    <div class="card-body">
                                        @foreach ($give->foods as $food)
                                            <div class="custom-control">
                                                <label id="custom{{ $food->id }}">
                                                    {{ $food->name }} - {{ $food->pivot->quantity }} ta,
                                                    {{ $food->pivot->total_price }} so'm
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
