@extends('layouts.master')
@section('title',"Insurance Type Create")
@section('breadcrumb')
    <li>
        <a class="parent-item" href="{{route('insuranceType.index')}}">Insurance Type</a>&nbsp;<i
            class="fa fa-angle-right"></i>
    </li>
    <li class="active">Insurance Type Create</li>
@endsection
@section('content')
    <!-- start widget -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>Insurance Type Create</header>
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
                    <form action="{{route('insuranceType.store')}}" method="POST" id="form_sample_1"
                          class="form-horizontal">
                        @csrf
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Insurance Category
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <select class="form-control" name="insuranceCategory">
                                        <option>Select Insurance Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"> {{$category->name}}</option>
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
                                           class="form-control" value="{{old('name')}}" placeholder="Name"/>
                                </div>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Minimum Amount
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="number" min="0" name="min_amount" data-required="1"
                                           class="form-control" value="{{old('min_amount')}}" placeholder="Minimum Amount"/>
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
                                    <input type="number" min="0" name="max_amount" data-required="1"
                                           class="form-control" value="{{old('max_amount')}}" placeholder="Maximum Amount"/>
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

