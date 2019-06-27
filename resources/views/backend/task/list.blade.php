@extends('layouts.blank')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4 class="card-title">Your Created Tasks</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Task Name</th>
                            <th>Task Description</th>
                            <th>Total Hours/Times</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Assign</th>
                            <th>Operation</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{$task['name']}}</td>
                                <td>{{$task['description']}}</td>
                                <td>{{$task['total_value'] }}</td>
                                <td>{{date('d-m-Y', strtotime($task['deadline']))}}</td>
                                <td><label class="badge badge-danger">Pending</label></td>
                                <td>
                                    <a href="{{route('task.assign',['task_id'=>$task['id']])}}">
                                        <button type="button" class="btn btn-gradient-primary btn-sm">Assign</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('task.edit',['task_id'=>$task['id']])}}">edit</a>

                                </td>
                                <td>
                                    <a href="{{route('task/delete',['task_id'=>$task['id']])}}">delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection