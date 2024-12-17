<div>
    <div>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col">
                            <h1>Fix Salary</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <input type="date" class="form-control" wire:change='day' wire:model="select">
                    <div class="row mt-4">
                        <h2>{{ $now }}</h2>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                                <table class="table table-bordered text-center table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Worker name</th>
                                            <th>Salary</th>
                                            <th>Type</th>
                                            <th>Given</th>
                                            <th>Left</th>
                                            <th>Add</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $int = 1;
                                        $sum = 0;
                                    @endphp
                                    <tbody>
                                        @foreach ($models as $model)
                                            <tr>
                                                <th>{{ $int++ }}</th>
                                                <td>{{ $model->user->name }}</td>
                                                <td>{{ $model->salary }}</td>
                                                <td>{{ $model->salary_type }}</td>
                                                <td>
                                                    @if ($model->oyliks && $model->oyliks->count() > 0)
                                                        @foreach ($model->oyliks->where('date', $select) as $oylik)
                                                            @php
                                                                $sum = $sum + $oylik->given;
                                                            @endphp
                                                        @endforeach
                                                        {{ $sum }}
                                                    @else
                                                        {{ 0 }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($model->oyliks && $model->oyliks->count() > 0)
                                                        {{ $model->salary - $sum }}
                                                    @else
                                                        {{ $model->salary }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary rounded-pill"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal{{ $model->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-plus-circle"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                            <path
                                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                                        </svg>
                                                    </button>

                                                    <div class="modal fade" id="modal{{ $model->id }}"
                                                        tabindex="-1" aria-labelledby="modalLabel{{ $model->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form
                                                                    wire:submit.prevent="addSalary({{ $model->id }})">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="modalLabel{{ $model->id }}">Add
                                                                            Salary</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="number" wire:model="number"
                                                                            class="form-control"
                                                                            placeholder="Enter salary">
                                                                        @error('number')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
