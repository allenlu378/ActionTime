@extends('layouts.blank')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Request</h4>
                <form class="form-sample" method="POST" action="{{ route('request.save') }}" aria-label="{{ __('create a new audit request?')}}"
                      onsubmit=" confirm('Do you want to create a request?')" >
                    @csrf
                    <input name="created_by" type="hidden" value="{{Auth::user()->id}}"/>
                    <input name="assignment_id" type="hidden" value="{{$assignment['id']}}"/>

                    <p class="card-description">
                        Request info
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Finished Hours/Times</label>
                                <div class="col-sm-9">
                                    <input type="text" name="add_value" class="form-control {{ $errors->has('add_value') ? ' is-invalid' : '' }}"
                                           value="{{old('add_value')}}" placeholder="Finish work"/>
                                    @if ($errors->has('add_value'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('add_value') }}</strong>
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
                                               rows="5">{{old('description')}}</textarea>

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
                                <label class="col-sm-3 col-form-label">Audit Code</label>
                                <div class="col-sm-9">
                                    <input type="text" name="audit_code" class="form-control {{$errors->has('audit_code') ? ' is-invalid' : '' }}"
                                           value="{{old('audit_code')}}" placeholder="Audit Code"/>
                                    @if($errors->has('audit_code'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>Wrong audit code</strong>
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
                                    Request
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection