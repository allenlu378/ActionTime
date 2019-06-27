@extends('layouts.blank')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Your Groups</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Group Name</th>
                            <th>Operation</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $group)
                            <tr>
                                <td>{{$group['name']}}</td>
                                <td>
                                    <a href="{{route('group.edit',['group_id'=>$group['id']])}}">edit</a>
                                    {{--<a href="{{route('group/delete',['award_id'=>$group['id']])}}">delete</a>--}}
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