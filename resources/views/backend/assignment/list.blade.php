@extends('layouts.blank')
@section('content')
    {{--import bootstrap--}}

    <!--  Bootstrap4 core CSS  -->
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="{{asset("fullcalendar/lib/jquery.min.js")}}"></script>
    {{--<script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>--}}
    <!-- popper.min.js  for pop window, tip and dropdown-->
    <script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
    <!-- Bootstrap4 core JavaScript 文件 -->
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>

    {{--end import bootstrap--}}
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Your Assignments</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Task Name</th>
                            <th>Task Description</th>
                            <th>Process</th>
                            <th>Status</th>
                            <th>Operation</th>
                            <th>Schedule</th>
                        </tr>
                        </thead>
                        <tbody>
                        <td colspan="6" style="text-align: center;"><span>Acknowledged Assignments</span></td>
                        @foreach($acked_assignments as $a)
                            <tr>
                                <td>{{$a->task['name']}}</td>
                                <td>{{$a->task['description']}}</td>
                                <td>{{$a['percent']*100}}%</td>
                                <td>
                                    @if($a['finish_flag']===1)
                                        <label class="badge badge-success">Completed</label>
                                    @elseif($a['finish_flag']===0)
                                        <label class="badge badge-warning">In progress</label>
                                    @else
                                        <label class="badge badge-danger">Fail</label>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('request.form',['aid'=>$a['id']])}}">Do it</a>|
                                    <a href="" onclick="return confirm('Do you want to delete this assigment?')">Delete</a>
                                </td>
                                <td>
                                    <button  data-toggle="modal" data-remote="{{route("assignment.schedule",['id'=>$a['id']])}}"  data-target="#calendar_modal">detail</button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6" style="text-align: center"><span> Acknowledging Assignments</span></td>
                        </tr>
                        @foreach($acking_assignments as $a)
                            <tr>
                                <td>{{$a->task['name']}}</td>
                                <td>{{$a->task['description']}}</td>
                                <td>{{$a['percent']*100}}%</td>
                                <td>
                                    <label class="badge badge-info">waiting</label>
                                </td>
                                <td>
                                    <a href="{{route('assignment.acknowledge',['aid'=>$a['id'],'c'=>1])}}">Approve</a>|
                                    <a href="{{route('assignment.acknowledge',['aid'=>$a['id'],'c'=>2])}}" >Refuse</a>
                                </td>
                                <td>
                                    <button  data-toggle="modal" data-remote="{{route("assignment.schedule",['id'=>$a['id']])}}"  data-target="#calendar_modal">detail</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('body').on('click', '[data-toggle="modal"]',  function(e){
            $($(this).data("target")+' .modal-body').load($(this).data("remote"));
        });
    </script>
    <!-- 模态框（Modal） -->
    <div class="modal fade" id="calendar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>

                </div>
                <div class="modal-body" id="modal_content">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                    </button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
@endsection