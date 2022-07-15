@extends('layouts.master')
@section('title','User Edit')
@section('breadcrumb')
    <li class="active">User Edit</li>
@endsection

@section('content')
    <!-- start widget -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>User Edit</header>
                    <button id="panel-button1"
                            class="mdl-button mdl-js-button mdl-button--icon pull-right"
                            data-upgraded=",MaterialButton">
                        <i class="material-icons">more_vert</i>
                    </button>
                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                        data-mdl-for="panel-button1">
                        <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
                        </li>
                        <li class="mdl-menu__item"><i class="material-icons">print</i>Another action
                        </li>
                        <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else
                            here
                        </li>
                    </ul>
                </div>
                <div class="card-body" id="bar-parent1">
                    <form action="{{ route('users.update',$user->id) }}" method="POST" id="form_sample_1"
                          class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="name" data-required="1"
                                           class="form-control"
                                           value="{{ old('name',isset($user->name) ? $user->name:null) }}"
                                           placeholder="Name"/>
                                </div>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Email

                                </label>
                                <div class="col-md-4">
                                    <div class="input-group">

                                        <input type="text" class="form-control" name="email"
                                               value="{{ old('email',isset($user->email) ? $user->email:null) }}"
                                               placeholder="Email"></div>
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Phone
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input name="phone" type="text"
                                           value="{{ old('phone',isset($user->phone) ? $user->phone:null) }}"
                                           data-required="1" class="form-control" placeholder="Phone"/>
                                </div>
                                @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Identity(NID)
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input name="user_identity" type="text" value="{{ old('user_identity',isset($user->user_identity) ? $user->user_identity:null) }}" data-required="1"
                                           class="form-control" placeholder="Identity(NID)"/>
                                </div>
                                @error('user_identity')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Date of Birth
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input name="dob" type="text" value="{{ old('dob',isset($user->dob) ? $user->dob:null) }}" data-required="1"
                                           class="form-control" placeholder="Date of Birth"/>
                                </div>
                                @error('dob')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Gender
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <select class="form-control" name="gender">
                                        <option value="">Gender...</option>

                                        <option @if(old('gender',isset($user) ? $user->gender : null) == 'male') selected @endif value="male">Male</option>
                                        <option @if(old('gender',isset($user) ? $user->gender : null) == 'female') selected @endif value="female">Female</option>
                                        <option @if(old('gender',isset($user) ? $user->gender : null) == 'other') selected @endif value="other">Other</option>
                                    </select>
                                </div>
                                @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Image
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <input type="file" name="image" data-required="1"
                                           class="form-control" value="{{old('image')}}"/>
                                </div>
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Old Image
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <img style="max-width: 100px" src="{{ asset($user->image) }}" alt="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Role
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <select class="form-control" name="role">
                                        <option value="">Role...</option>
                                        <option @if(isset($user->role) && $user->role== '1') selected
                                                @endif @if(old('role')=='1')selected @endif value="1">Admin
                                        </option>
                                        <option @if(isset($user->role) && $user->role== '2') selected
                                                @endif @if(old('role')=='2')selected @endif value="2">Employee
                                        </option>
                                        <option @if(isset($user->role) && $user->role== '3') selected
                                                @endif @if(old('role')=='3')selected @endif value="3">Agent
                                        </option>

                                    </select>
                                </div>
                                @error('type')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Address
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input name="address" type="text"
                                           value="{{ old('address',isset($user->address) ? $user->address:null) }}"
                                           data-required="1" class="form-control" placeholder="Address"/>
                                </div>
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="offset-md-3 col-md-9">
                                <button type="submit" class="btn btn-info">Update</button>
                                <button type="button" class="btn btn-default">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    {{--  page required js  /--}}
    <script src="{{ asset('assets/admin/assets/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/plugins/jquery-validation/js/additional-methods.min.js') }}"></script>

    <script src="{{ asset('assets/admin/assets/js/pages/validation/form-validation.js') }}"></script>
@endpush
