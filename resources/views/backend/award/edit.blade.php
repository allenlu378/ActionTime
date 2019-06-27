@extends('layouts.blank')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit an Award</h4>
                {{--{{$errors}}--}}
                <form class="form-sample" method="POST" action="{{ route('award.update') }}" aria-label="{{ __('update an award')}}"
                      onsubmit=" confirm('Do you want to save the change?')"  enctype="multipart/form-data">
                    @csrf
                    <input name="id" type="hidden" value="{{$award['id']}}">
                    <input name="owner" type="hidden" value="{{$award['owner']}}">
                    <p class="card-description">
                        Award info
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Award Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           value="{{$award['name']}}" placeholder="Award Name"/>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" >Number</label>
                                <div class="col-sm-9">
                                    <input type="text" name="total_num" class="form-control {{ $errors->has('total_num') ? ' is-invalid' : '' }}"
                                           value="{{$award['total_num']}}" placeholder="Number"/>
                                    @if ($errors->has('total_num'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('total_num') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" >Image</label>
                                <div class="col-sm-9">
                                    <input type="file" id="file_upload" name="file_upload" accept="image/png,image/gif" class="form-control {{ $errors->has('img') ? ' is-invalid' : '' }}"
                                           enctype="multipart/form-data" value="{{asset('upload')}}/{{$award['img']}}">
                                    <input id="img" name="img" value="{{$award['img']}}" type="hidden">
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
                            <img id="art_thumb" src="{{asset('upload')}}/{{$award['img']}}" style="height: 70px">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description"
                                              class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                              rows="5">{{$award['description']}}</textarea>
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