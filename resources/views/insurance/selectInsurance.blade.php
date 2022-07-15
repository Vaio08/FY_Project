@extends('layouts.master')
@section('title',"Select Insurance Category")
@section('breadcrumb')
    <li>
        <a class="parent-item" href="{{route('insurance.index')}}">Insurances</a>&nbsp;<i
            class="fa fa-angle-right"></i>
    </li>
    <li class="active">Select Insurance Category</li>
@endsection
@section('content')
    <!-- start widget -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>Select Insurance Category</header>
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
                    <form action="{{route('checkInsuranceType')}}" method="GET" id="form_sample_1"
                          class="form-horizontal">

                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Insurance Type
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <select class="form-control" name="insuranceType">
                                        <option>Select Insurance Type</option>
                                        @foreach($insuranceCategories as $IC)
                                            <option value="{{$IC->id}}"> {{$IC->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('insuranceType')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="offset-md-3 col-md-9">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <button type="button" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

