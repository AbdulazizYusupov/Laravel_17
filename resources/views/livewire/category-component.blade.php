<div>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Categories</h1>
                    <button class="btn btn-{{$activeForm ? 'secondary' : 'primary'}}"
                            wire:click="{{$activeForm ? 'cancel' : 'create'}}">{{$activeForm ? 'Cancel' : 'Create'}}</button>
                    @if($activeForm)
                        <form wire:submit.prevent="save">
                            <div class="row mt-2">
                                <div class="col-3">
                                    <input type="text" wire:model.blur="name" class="form-control" placeholder="Name">
                                </div>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="col-3">
                                    <input type="number" wire:model.blur="sort" class="form-control"
                                           placeholder="Sort number">
                                </div>
                                @error('sort') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="col-3">
                                    <input type="submit" class="btn btn-primary" value="Save">
                                </div>
                            </div>
                        </form>
                    @endif
                    @if(!$activeForm)
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover text-center">
                                        <thead>
                                        <tr>
                                            <th style="width: 50px">#</th>
                                            <th>Name</th>
                                            <th style="width: 100px">Options</th>
                                        </tr>
                                        </thead>
                                        <tbody wire:sortable="updateCategory">
                                        @foreach($models as $model)
                                            @if($editId != $model->id)
                                                <tr draggable="true" wire:sortable.item="{{$model->id}}">
                                                    <th>{{$model->id}}</th>
                                                    <td>
                                                        {{$model->name}}
                                                    </td>
                                                    <td style="display: flex; align-items: center;">
                                                        <button class="btn btn-danger"
                                                                wire:click="delete({{ $model->id }})"
                                                                style="margin-right: 5px;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                 height="16"
                                                                 fill="currentColor" class="bi bi-trash3"
                                                                 viewBox="0 0 16 16">
                                                                <path
                                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                            </svg>
                                                        </button>
                                                        <button class="btn btn-warning"
                                                                wire:click="edit({{ $model->id }})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                 height="16"
                                                                 fill="currentColor" class="bi bi-pencil"
                                                                 viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                @if($editId == $model->id)
                                                    <td>{{$model->id}}</td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                               placeholder="Edit by name"
                                                               wire:model="editName">
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-primary"
                                                                wire:click="update({{ $model->id }})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                 height="16" fill="currentColor" class="bi bi-check"
                                                                 viewBox="0 0 16 16">
                                                                <path
                                                                    d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{$models->links()}}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
