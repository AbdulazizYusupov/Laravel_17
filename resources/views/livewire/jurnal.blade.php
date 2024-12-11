<div>
    <div class="content-wrapper">
        <div class="container-fluid mt-3">
            <div class="row">
                <h1>Journal</h1>
                <div class="col-md-12">
                    <table class="table table-bordered text-center table-hover mt-4">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Start time</th>
                            <th>End time</th>
                            <th>Hours</th>
                        </tr>
                        @foreach ($models as $model)
                            <tr>
                                <th>{{ $model->id }}</th>
                                <td>{{ $model->user->name }}</td>
                                <td>{{ $model->date }}</td>
                                <td>{{ $model->start_time }}</td>
                                <td>{{ $model->end_time }}</td>
                                <td>{{ $model->time }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
