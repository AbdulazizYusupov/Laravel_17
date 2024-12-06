<div>
    <div class="content-wrapper kanban">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Orders</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content pb-3">
            <div class="container-fluid h-100">
                <div class="card card-row card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Ordered foods
                        </h3>
                    </div>
                    <div class="card-body">
                        @foreach($models as $model)
                            @if(!empty($model->foods))
                                <div class="card card-info card-outline">
                                    <div class="card-body">
                                        <p>
                                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#status1{{$model->id}}" aria-expanded="false"
                                                    aria-controls="collapseWidthExample">
                                                Queue: {{$model->queue}}
                                            </button>
                                        </p>
                                        <div style="min-height: 120px;">
                                            <div class="collapse collapse-horizontal" id="status1{{$model->id}}">
                                                <div class="card card-body" style="width: 300px;">
                                                    @foreach($model->foods as $food)
                                                        @if($food->pivot->status == 1)
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input" type="checkbox"
                                                                       id="customCheckbox{{ $food->id }}"
                                                                       wire:change="change({{ $food->pivot }}, $event.target.checked)">
                                                                <label for="customCheckbox{{ $food->id }}"
                                                                       class="custom-control-label">
                                                                    {{ $food->name }}  {{$food->pivot->quantity}} ta
                                                                    - {{$food->pivot->total_price}} so'm
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
                        @foreach($models as $model)
                            <div class="card card-info card-outline">
                                <div class="card-body">
                                    <p>
                                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#status2{{$model->id}}" aria-expanded="false"
                                                aria-controls="collapseWidthExample">
                                            Queue: {{$model->queue}}
                                        </button>
                                    </p>
                                    <div style="min-height: 120px;">
                                        <div class="collapse collapse-horizontal" id="status2{{$model->id}}">
                                            <div class="card card-body" style="width: 300px;">
                                                @foreach($model->foods as $food)
                                                    @if($food->pivot->status == 2)
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox"
                                                                   id="customCheckbox{{ $food->id }}"
                                                                   wire:change="change({{ $food->pivot }}, $event.target.checked)">
                                                            <label for="customCheckbox{{ $food->id }}"
                                                                   class="custom-control-label">
                                                                {{ $food->name }}  {{$food->pivot->quantity}} ta
                                                                - {{$food->pivot->total_price}} so'm
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card card-row card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            Done
                        </h3>
                    </div>
                    <div class="card-body">
                        @foreach($models as $model)
                            <div class="card card-info card-outline">
                                <div class="card-body">
                                    <p>
                                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#status3{{$model->id}}" aria-expanded="false"
                                                aria-controls="collapseWidthExample">
                                            Queue: {{$model->queue}}
                                        </button>
                                    </p>
                                    <div style="min-height: 120px;">
                                        <div class="collapse collapse-horizontal" id="status3{{$model->id}}">
                                            <div class="card card-body" style="width: 300px;">
                                                @foreach($model->foods as $food)
                                                    @if($food->pivot->status == 3)
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox"
                                                                   id="customCheckbox{{ $food->id }}"
                                                                   wire:change="change({{ $food->pivot }}, $event.target.checked)">
                                                            <label for="customCheckbox{{ $food->id }}"
                                                                   class="custom-control-label">
                                                                {{ $food->name }}  {{$food->pivot->quantity}} ta
                                                                - {{$food->pivot->total_price}} so'm
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card card-row card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            Given to waiter
                        </h3>
                    </div>
                    <div class="card-body">
                        @foreach($models as $model)
                            <div class="card card-info card-outline">
                                <div class="card-body">
                                    <p>
                                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#status4{{$model->id}}" aria-expanded="false"
                                                aria-controls="collapseWidthExample">
                                            Queue: {{$model->queue}}
                                        </button>
                                    </p>
                                    <div style="min-height: 120px;">
                                        <div class="collapse collapse-horizontal" id="status4{{$model->id}}">
                                            <div class="card card-body" style="width: 300px;">
                                                @foreach($model->foods as $food)
                                                    @if($food->pivot->status == 4)
                                                        <div class="custom-control custom-checkbox">
                                                            <label for="customCheckbox{{ $food->id }}"
                                                                   class="custom-control-label">
                                                                {{ $food->name }}  {{$food->pivot->quantity}} ta
                                                                - {{$food->pivot->total_price}} so'm
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
