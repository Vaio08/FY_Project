@extends('layouts.master')
@section('title',"Insurance Type Edit")
@section('breadcrumb')
    <li>
        <a class="parent-item" href="{{route('insuranceType.index')}}">Insurance Type</a>&nbsp;<i
            class="fa fa-angle-right"></i>
    </li>
    <li class="active">Insurance Type Edit</li>
@endsection
@section('content')
    <!-- start widget -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>Insurance Type Edit</header>
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
                    <form action="{{route('insuranceType.update',$insuranceType->id)}}" method="POST" id="form_sample_1"
                          class="form-horizontal">
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Insurance Category
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <select class="form-control" name="insuranceCategory">
                                        <option>Select Insurance Category</option>
                                        @foreach($categories as $category)
                                            <option @if($insuranceType->insurance_category_id == $category->id) selected
                                                    @endif value="{{$category->id}}"> {{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('insuranceCategory')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="name" data-required="1"
                                           class="form-control"
                                           value="{{ old('name',isset($insuranceType->type_name) ? $insuranceType->type_name:null) }}"
                                           placeholder="Name"/>
                                </div>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if(session()->has('exits_name'))
                                    <div class="text-danger">
                                        {{ session()->get('exits_name') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Min Amount
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="min_amount" data-required="1"
                                           class="form-control"
                                           value="{{ old('min_amount',isset($insuranceType->min_amount) ? $insuranceType->min_amount:null) }}"
                                           placeholder="Name"/>
                                </div>
                                @error('min_amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Maximum Amount
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="max_amount" data-required="1"
                                           class="form-control"
                                           value="{{ old('max_amount',isset($insuranceType->max_amount) ? $insuranceType->max_amount:null) }}"
                                           placeholder="Name"/>
                                </div>
                                @error('max_amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <div class="offset-md-3 col-md-9">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

