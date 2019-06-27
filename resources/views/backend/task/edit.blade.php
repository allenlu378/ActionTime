@extends('layouts.blank')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Change {{$task['name']}} Task</h4>
                {{--{{$errors}}--}}
                <form class="form-sample" method="POST" action="{{ route('task.update') }}" aria-label="{{ __('edit a task')}}"
                      onsubmit=" confirm('Do you want to save the change ?')" >
                    @csrf
                    <input name="created_by" type="hidden" value="{{$task['created_by']}}">
                    <input name="audited_by" type="hidden" value="{{$task['audited_by']}}">
                    <input name="id" type="hidden" value="{{$task['id']}}">
                    <p class="card-description">
                        Task info
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Task Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           value="{{$task['name']}}" placeholder="Task Name"/>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Award</label>
                                <div class="col-sm-9">

                                    <select class="form-control" name="award_id">
                                        @foreach($awards as $award)
                                            <option value="{{$award['id']}}" @if($task['award_id']==$award['id']) selected @endif>{{$award['name']}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Type</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="type">
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
                                           value="{{$task['total_value']}}" placeholder="Total Hours"/>
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
                                <label class="col-sm-3 col-form-label">Deadline</label>
                                <div class="col-sm-9">
                                    <input type="date" name="deadline" value="{{date('Y-m-d', strtotime($task['deadline']))}}" class="form-control">
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
                                <label class="col-sm-3 col-form-label" >Image</label>
                                <div class="col-sm-9">
                                    <input type="file" id="file_upload" name="file_upload" accept="image/png,image/gif,image/jpg,image/jpeg" class="form-control {{ $errors->has('img') ? ' is-invalid' : '' }}"
                                           enctype="multipart/form-data" value="{{asset('upload')}}/{{$task['img']}}">
                                    <input id="img" name="img" value="{{$task['img']}}" type="hidden">
                                    @if ($errors->has('img'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('img') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--upload imgs--}}
                                <script type="text/javascript" src="{{asset('js/jquery-1.8.3.min.js')}}"></script>
                                <script>
                                    $(function () {
                                        $("#file_upload").change(function () {
                                            uploadImage();
                                        })
                                    })

                                    function uploadImage() {
                                        var imgPath = $("#file_upload").val();
                                        if (imgPath == "") {
                                            alert("请选择上传图片！");
                                            return;
                                        }

                                        // var formData = new FormData($('#art_form')[0]);
                                        var formData = new FormData();
                                        formData.append('fileupload', $('#file_upload')[0].files[0]);
                                        $.ajax({
                                            type: "POST",
                                            cache: false,
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            url: "{{route('util.upload')}}",
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            success: function (data) {
                                                console.log(data);
                                                //alert(data);
                                                $('#art_thumb').attr('src', "{{asset('upload')}}"+"/"+data);
                                                $("#img").val(data);
                                            },
                                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                                alert("upload error, please try again!");
                                            }
                                        });
                                    }
                                </script>
                                {{-- end upload imgs--}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img id="art_thumb" src="{{asset('upload')}}/{{$task['img']}}" style="height: 70px">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description"
                                              class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                              rows="5">{{$task['description']}}</textarea>
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