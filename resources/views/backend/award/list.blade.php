@extends('layouts.blank')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Your Awards</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Award Name</th>
                            <th>Award Description</th>
                            <th>Total Number</th>
                            <th>Remaining Number</th>
                            <th>Status</th>
                            <th>Operation</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($awards as $award)
                            <tr>
                                <td>{{$award['name']}}</td>
                                <td>{{$award['description']}}</td>
                                <td>{{$award['total_num'] }}</td>
                                <td>{{$award['remaining_num'] }}</td>
                                <td><label class="badge badge-danger">Pending</label></td>

                                <td>

                                    <a href="{{route('award.edit',['award_id'=>$award['id']])}}">edit</a>
                                    |
                                    <a href="{{route('award/delete',['award_id'=>$award['id']])}}">delete</a>
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