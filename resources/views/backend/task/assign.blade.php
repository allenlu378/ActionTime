@extends('layouts.blank')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Assign "{{$task['name']}}" Task</h4>
                {{--{{$errors}}--}}
                <form class="form-sample" method="POST" action="{{ route('task.doAssign') }}" aria-label="{{ __('assign a task')}}"
                      onsubmit=" confirm('Do you want to assign this task ?')" >
                    @csrf
                    <input name="task_id" type="hidden" value="{{$task['id']}}">

                    <p class="card-description">
                        Task info
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Task Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           value="{{$task['name']}}" placeholder="Task Name" readonly="readonly"/>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Type</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="type" readonly="readonly" disabled="true">
                                        <option value="0" @if($task['type']=='0') selected @endif>daily task</option>
                                        <option value="1" @if($task['type']=='1') selected @endif>weekly task</option>
                                        <option value="2" @if($task['type']=='2') selected @endif>monthly task</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" >Total Hours/Times</label>
                                <div class="col-sm-9">
                                    <input type="text" name="total_value" class="form-control {{ $errors->has('total_value') ? ' is-invalid' : '' }}"
                                           value="{{$task['total_value']}}" placeholder="Total Hours" readonly="readonly"/>
                                    @if ($errors->has('total_value'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('total_value') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description"
                                              class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                              rows="5" readonly="readonly">{{$task['description']}}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Due Time</label>
                                <div class="col-sm-9">
                                    <input type="datetime-local" name="due_time" value="{{date('Y-m-d\T', strtotime($task['deadline']))}}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Period Workload</label>
                                <div class="col-sm-9">
                                    <input type="number" name="average_workload" value="{{$task['average_workload']}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Group</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="group_id">
                                        @foreach($groups as $group)
                                            <option value="{{$group['id']}}">{{$group['name']}}</option>
                                        @endforeach
                                        <option value="-1">Anyone</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <button type="submit" class="btn btn-outline-primary btn-icon-text">
                                    <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
