@extends('layouts.blank')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create a new task</h4>
                {{--{{$errors}}--}}
                <form class="form-sample" method="POST" action="{{ route('task/save') }}" aria-label="{{ __('create a new task')}}">
                    @csrf
                    <p class="card-description">
                        Task info
                    </p>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">file</label>
                                <div class="col-sm-9">
                                    <input type="file"  name="file_upload" />

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