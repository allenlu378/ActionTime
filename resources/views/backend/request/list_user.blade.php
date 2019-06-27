@extends('layouts.blank')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Your Request</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Task Name</th>
                            <th>Finished Hours/Times</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Feedback</th>
                            <th>Operation</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($auditRequests  as $r)
                            <tr>
                                <td>{{$r['task']['name']}}</td>
                                <td>{{$r['add_value']}}</td>
                                <td>{{date('d-m-Y', strtotime($r['datetime']))}}</td>
                                <td>
                                   @switch($r['result'])
                                        @case(0)
                                            pending...
                                            @break
                                        @case(1)
                                            Pass.
                                            @break
                                        @case(2)
                                            Refuse.
                                            @break
                                    @endswitch
                                </td>
                                <td>{{$r['feedback']}}</td>
                                <td>
                                    <a href="{{route('request.delete',['id'=>$r['id']])}}">delete</a>
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