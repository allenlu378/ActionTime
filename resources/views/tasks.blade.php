@extends('layouts.blank')

@section('content')
    <div class="container">
        <div class="row">
            <script>
                @if ($errors->has('repeat_mistake'))
                    alert('{{ $errors->first('repeat_mistake') }}')
                @endif
            </script>


            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Current Tasks</h4>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Task Name</th>
                                <th>Task Description</th>
                                <th>Total Hours/Times</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Operation</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($tasks as $task)
                                <tr>
                                    <td>{{$task['name']}}</td>
                                    <td>{{$task['description']}}</td>
                                    <td>{{$task['total_value'] }}</td>
                                    <td>{{date('m-d-Y', strtotime($task['deadline']))}}</td>
                                    <td><label class="badge badge-danger">Pending</label></td>
                                    <td>
                                        <a href="{{route('task/pick',['task_id'=>$task['id']])}}">
                                            Pick it
                                        </a>

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
