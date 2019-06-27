@extends('layouts.blank')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit an Group</h4>
                {{--{{$errors}}--}}
                <form class="form-sample" method="POST" action="{{ route('group.update') }}" aria-label="{{ __('update an group')}}"
                      onsubmit=" confirm('Do you want to save the change?')"  enctype="multipart/form-data">
                    @csrf
                    <input name="id" type="hidden" value="{{$group['id']}}">
                    <input name="manager_id" type="hidden" value="{{$group['manager_id']}}">
                    <p class="card-description">
                        Group info
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Group Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           value="{{$group['name']}}" placeholder="Award Name"/>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
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

                <div class="row">
                    <div class="col-md-6">
                        <p class="card-description">
                            Group Member
                        </p>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Operation</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($group->users as $user)
                                <tr>
                                    <td>{{$user['name']}}</td>
                                    <td>

                                        <a href="{{route('group.removeMember',['group_id'=>$group['id'],'user_id'=>$user['id']])}}">
                                            <button type="button" class="btn btn-gradient-primary btn-sm">Remove</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                    <div class="col-md-6">
                        <p class="card-description">
                            Add Member
                        </p>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Operation</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($candidates as $candidate)
                                <tr>
                                    <td>{{$candidate['name']}}</td>
                                    <td>
                                        {{--   <a href="{{route('group.edit',['award_id'=>$group['id']])}}">edit</a>--}}
                                        {{--<a href="{{route('group/delete',['award_id'=>$group['id']])}}">delete</a>--}}
                                        <a href="{{route('group.addMember',['group_id'=>$group['id'],'user_id'=>$candidate['id']])}}">
                                         <button type="button" class="btn btn-gradient-primary btn-sm">Add To</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection