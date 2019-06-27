@extends('layouts.blank')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Upload work record</h4>
                {{--{{$errors}}--}}
                <form class="form-sample" method="POST" action="{{ route('request/') }}" aria-label="{{ __('create a new award')}}"
                      onsubmit=" confirm('Do you want to create a new award?')"  enctype="multipart/form-data">
                    @csrf
                    <input name="owner" type="hidden" value="{{Auth::user()->id}}">
                    <p class="card-description">
                        Award info
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Award Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           value="" placeholder="Award Name"/>
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
                                           value="" placeholder="Number"/>
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
                                           value="" placeholder="" enctype="multipart/form-data"/>
                                    <input id="img" name="img" type="text" hidden>
                                    @if ($errors->has('img'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('img') }}</strong>
                                        </span>
                                    @endif
                                </div>
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
                        <div class="col-md-6">
                            <img id="art_thumb" src="" style="height: 70px">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description"
                                              class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                              rows="5"></textarea>
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