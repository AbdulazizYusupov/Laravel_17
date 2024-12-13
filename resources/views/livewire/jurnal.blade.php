<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Journal</h1>
                <input type="date" class="form-control mt-4" wire:change="changeDate($event.target.value)">
                <h3 class="text-primary mt-4">{{ $now->format('F Y') }}</h3>

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
                                                    $dayTime = $model->jurnals
                                                        ->where('date', $day->format('Y-m-d'))
                                                        ->where('user_id', $model->user->id)
                                                        ->first();
                                                @endphp
                                                <td>
                                                    @if ($dayTime)
                                                        <button
                                                            class="btn btn-{{ $dayTime->time >= $model->hours ? 'success' : 'danger' }}"
                                                            data-bs-toggle="tooltip"
                                                            title="Start time: {{ \Carbon\Carbon::parse($model->jurnals->where('date', $day->format('Y-m-d'))->where('user_id', $model->user->id)->first()->start_time)->format('H:i') }} | End time: {{ \Carbon\Carbon::parse($model->jurnals->where('date', $day->format('Y-m-d'))->where('user_id', $model->user->id)->first()->end_time)->format('H:i') }} |
                                                                Reason :  {{ $model->jurnals->where('date', $day->format('Y-m-d'))->where('user_id', $model->user->id)->first()->end_time >= $model->end_time ? 'Good job' : $model->end_time . 'hours left' }}"
                                                            wire:click="openModal({{ $dayTime->id }})">
                                                            {{ number_format($dayTime->time) }}
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-toggle="tooltip"
                                                            title="Start time: {{ \Carbon\Carbon::parse($model->start_time)->format('H:i') }} | End time: {{ \Carbon\Carbon::parse($model->end_time)->format('H:i') }}"
                                                            wire:click="open({{ $model->user->id }}, '{{ $day->format('Y-m-d') }}')">
                                                            -
                                                        </button>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if ($selectedJurnal)
                                <div class="modal fade show d-block" style="background: rgba(0, 0, 0, 0.5);"
                                    tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Show more</h5>
                                                <button type="button" class="btn-close"
                                                    wire:click="closeModal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form wire:submit.prevent="updateJurnal">
                                                    <div class="mb-3">
                                                        <label for="user" class="form-label">User</label>
                                                        <input type="text" class="form-control" id="user"
                                                            value="{{ $selectedJurnal->user->name }}" disabled>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="date" class="form-label">Date</label>
                                                        <input type="date" class="form-control" id="date"
                                                            wire:model="selectedJurnal.date"
                                                            value="{{ $selectedJurnal->date }}" disabled>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="start_time" class="form-label">Start Time</label>
                                                        <input type="time" class="form-control"
                                                            value="{{ $selectedJurnal->start_time }}" id="start_time"
                                                            wire:model.defer="editStart">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="end_time" class="form-label">End Time</label>
                                                        <input type="time" class="form-control"
                                                            value="{{ $selectedJurnal->end_time }}" id="end_time"
                                                            wire:model.defer="editEnd">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="total_time" class="form-label">Total Time</label>
                                                        <input type="number" class="form-control" id="total_time"
                                                            value="{{ $selectedJurnal->time }}" disabled>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            wire:click="delete({{ $selectedJurnal->id }})">Delete</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            wire:click="closeModal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($select)
                                <div class="modal fade show d-block" style="background: rgba(0, 0, 0, 0.5);"
                                    tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Journal add</h5>
                                                <button type="button" class="btn-close"
                                                    wire:click="closeModal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form wire:submit.prevent="create">
                                                    <div class="mb-3">
                                                        <label for="user" class="form-label">User</label>
                                                        <input type="text" class="form-control" id="user"
                                                            value="{{ $select->name }}" disabled>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="start_time" class="form-label">Start Time</label>
                                                        <input type="time" class="form-control" id="start_time"
                                                            wire:model="addStartTime" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="end_time" class="form-label">End Time</label>
                                                        <input type="time" class="form-control" id="end_time"
                                                            wire:model="addEndTime">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            wire:click="close">Close</button>
                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                    </div>
                                                </form>
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
