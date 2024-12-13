<div>
    <div class="content-wrapper kanban">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>All Orders</h1>
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
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox"
                                                    id="customCheckbox1{{ $food->id }}" disabled>
                                                <label for="customCheckbox1{{ $food->id }}"
                                                    class="custom-control-label">
                                                    {{ $food->name }} {{ $food->pivot->quantity }} ta
                                                    {{ $food->pivot->total_price }} so'm
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        <button wire:click="accept({{ $order->id }})" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Accept
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card card-row card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Progress
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
                                            <div class="custom-control custom-checkbox">
                                                <input wire:click="done({{ $food->id }}, {{$food->pivot->order_id}})"
                                                    class="custom-control-input" type="checkbox"
                                                    id="customCheckbox1{{ $food->id }}"
                                                    @if ($food->status == 3) checked @endif>
                                                <label for="customCheckbox1{{ $food->id }}"
                                                    class="custom-control-label">
                                                    {{ $food->name }} {{ $food->pivot->quantity }} ta {{$food->pivot->total_price }} so'm
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card card-row card-default">
                    <div class="card-header bg-info">
                        <h3 class="card-title">
                            Done
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
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox"
                                                    id="customCheckbox1{{ $food->id }}" disabled>
                                                <label for="customCheckbox1{{ $food->id }}"
                                                    class="custom-control-label">
                                                    {{ $food->name }} {{ $food->pivot->quantity }} ta
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
                            Given to waiter
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
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox"
                                                    id="customCheckbox1{{ $food->id }}" disabled>
                                                <label for="customCheckbox1{{ $food->id }}"
                                                    class="custom-control-label">
                                                    {{ $food->name }} {{ $food->pivot->quantity }} ta
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
