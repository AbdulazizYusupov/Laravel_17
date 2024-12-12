<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Journal</h1>
                <!-- Sana kiritish -->
                <input type="date" class="form-control mt-4" wire:change="changeDate($event.target.value)">
                <!-- Joriy oyni ko'rsatish -->
                <h3 class="text-primary mt-4">{{ $now->format('F Y') }}</h3>

                <!-- Jadval -->
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        @foreach ($days as $day)
                                            <th>{{ $day->format('d') }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($models as $model)
                                        <tr>
                                            <td>{{ $model->id }}</td>
                                            <td>{{ $model->user->name }}</td>
                                            @foreach ($days as $day)
                                                @php
                                                    $dayTime = $model
                                                        ->where('date', $day->format('Y-m-d'))
                                                        ->where('user_id', $model->user->id)
                                                        ->first();
                                                @endphp
                                                <td>
                                                    @if ($dayTime)
                                                        <button class="btn btn-info"
                                                            wire:click="openModal({{ $dayTime->id }})">
                                                            {{ $dayTime->time }}
                                                        </button>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Modal -->
                            @if ($selectedJurnal)
                                <div class="modal fade show d-block" style="background: rgba(0, 0, 0, 0.5);"
                                    tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Jurnal Batafsil</h5>
                                                <button type="button" class="btn-close"
                                                    wire:click="closeModal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>User:</strong> {{ $selectedJurnal->user->name }}</p>
                                                <p><strong>Date:</strong> {{ $selectedJurnal->date }}</p>
                                                <p><strong>Start Time:</strong> {{ $selectedJurnal->start_time }}</p>
                                                <p><strong>End Time:</strong> {{ $selectedJurnal->end_time }}</p>
                                                <p><strong>Total Time:</strong> {{ $selectedJurnal->time }} hours</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    wire:click="closeModal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
