<div>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Workers</h1>
                    <button class="btn btn-{{ $activeForm ? 'secondary' : 'primary' }}"
                        wire:click="{{ $activeForm ? 'cancel' : 'create' }}">{{ $activeForm ? 'Cancel' : 'Create' }}</button>
                    @if ($activeForm)
                        <form wire:submit.prevent="save">
                            <div class="row mt-2">
                                <div class="col-3">
                                    <select class="form-select" wire:model.blur="user_id">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="col-3">
                                    <select class="form-select" wire:model.blur="section_id">
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('section_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="col-3">
                                    <select class="form-select" wire:model.blur="salary_type">
                                        <option>Fixed</option>
                                        <option>Mixed</option>
                                    </select>
                                </div>
                                @error('salary_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="col-3">
                                    <input type="number" wire:model.blur="salary" class="form-control"
                                        placeholder="Salary">
                                </div>
                                @error('salary')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="col-3 mt-3">
                                    <input type="text" wire:model.blur="bonus" class="form-control"
                                        placeholder="Bonus">
                                </div>
                                @error('bonus')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="col-3 mt-3">
                                    <input type="number" wire:model.blur="month_time" class="form-control"
                                        placeholder="Month time">
                                </div>
                                @error('month_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="col-3 mt-3">
                                    <input type="time" wire:model.blur="start_time" class="form-control"
                                        placeholder="Start time">
                                </div>
                                @error('start_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="col-3 mt-3">
                                    <input type="time" wire:model.blur="end_time" class="form-control"
                                        placeholder="End time">
                                </div>
                                @error('end_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="col-3 mt-3">
                                    <button type="submit" class="btn btn-success toastrDefaultSuccess">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                    @if (!$activeForm && !$more)
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px">#</th>
                                                <th>User</th>
                                                <th>Salary</th>
                                                <th>Start time</th>
                                                <th>End time</th>
                                                <th>Hours</th>
                                                <th>Image</th>
                                                <th style="width: 100px">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($models as $model)
                                                <tr>
                                                    <th>{{ $model->id }}</th>
                                                    <td>{{ $model->user->name }}</td>
                                                    <td>{{ number_format($model->salary) }}</td>
                                                    <td>{{ $model->start_time }}</td>
                                                    <td>{{ $model->end_time }}</td>
                                                    <td>{{ $model->hours }}</td>
                                                    <td><img src="{{ asset('storage/' . $model->user->image) }}"
                                                            alt="Food Image" style="width: 100px;" /></td>
                                                    <td style="display: flex; align-items: center;">
                                                        <button class="btn btn-danger toastrDefaultError" type="button"
                                                            wire:click="delete({{ $model->id }})"
                                                            style="margin-right: 5px;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-trash3"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                            </svg>
                                                        </button>
                                                        <button class="btn btn-info" wire:click="show({{$model->id}})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-eye"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                                <path
                                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $models->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($more)
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px">#</th>
                                                <th>User</th>
                                                <th>Section</th>
                                                <th>Salary type</th>
                                                <th>Salary</th>
                                                <th>Bonus</th>
                                                <th>Month time</th>
                                                <th>Start time</th>
                                                <th>End time</th>
                                                <th>Hours</th>
                                                <th>Image</th>
                                                <th style="width: 100px">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @if ($editId != $worker->id)
                                                    <tr>
                                                        <th>{{ $worker->id }}</th>
                                                        <td>{{ $worker->user->name }}</td>
                                                        <td>{{ $worker->section->name }}</td>
                                                        <td>{{ $worker->salary_type }}</td>
                                                        <td>{{ number_format($worker->salary) }}</td>
                                                        <td>{{ $worker->bonus }}</td>
                                                        <td>{{ $worker->month_time }}</td>
                                                        <td>{{ $worker->start_time }}</td>
                                                        <td>{{ $worker->end_time }}</td>
                                                        <td>{{ $worker->hours }}</td>
                                                        <td><img src="{{ asset('storage/' . $worker->user->image) }}"
                                                                alt="Food Image" style="width: 100px;" /></td>
                                                        <td style="display: flex; align-items: center;">
                                                            <button type="button" class="btn btn-danger toastrDefaultError"
                                                                wire:click="delete({{ $worker->id }})"
                                                                style="margin-right: 5px;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-trash3" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                                </svg>
                                                            </button>
                                                            <button class="btn btn-warning"
                                                                wire:click="edit({{ $worker->id }})">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                                                </svg>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    @if ($editId == $worker->id)
                                                        <td>{{ $worker->id }}</td>
                                                        <td>
                                                            <select class="form-select" wire:model="editUser_id">
                                                                @foreach ($users as $user)
                                                                    @if ($user->id == $worker->user_id)
                                                                        <option selected value="{{ $user->id }}">
                                                                            {{ $user->name }}</option>
                                                                    @else
                                                                        <option value="{{ $user->id }}">
                                                                            {{ $user->name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-select" wire:model="editSecion_id">
                                                                @foreach ($sections as $section)
                                                                    @if ($section->id == $worker->section_id)
                                                                        <option selected value="{{ $section->id }}">
                                                                            {{ $section->name }}</option>
                                                                    @else
                                                                        <option value="{{ $section->id }}">
                                                                            {{ $section->name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" wire:model="editSalary_type"
                                                                class="form-control"
                                                                value="{{ $worker->salary_type }}">
                                                        </td>
                                                        <td>
                                                            <input type="number" wire:model="editSalary"
                                                                class="form-control" value="{{ $worker->salary }}">
                                                        </td>
                                                        <td>
                                                            <input type="number" wire:model="editBonus"
                                                                class="form-control" value="{{ $worker->bonus }}">
                                                        </td>
                                                        <td>
                                                            <input type="number" wire:model="editMonth_time"
                                                                class="form-control"
                                                                value="{{ $worker->month_time }}">
                                                        </td>
                                                        <td>
                                                            <input type="time" wire:model="editStart_time"
                                                                class="form-control"
                                                                value="{{ $worker->start_time }}">
                                                        </td>
                                                        <td>
                                                            <input type="time" wire:model="editEnd_time"
                                                                class="form-control" value="{{ $worker->end_time }}">
                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-primary"
                                                                wire:click="update({{ $worker->id }})">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-check" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                                                                </svg>
                                                            </button>
                                                        </td>
                                                    @endif
                                                </tr>
                                        </tbody>
                                    </table>
                                    <button wire:click="back" class="btn btn-secondary">Back</button>
                                    {{ $models->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
