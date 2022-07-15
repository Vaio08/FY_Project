@extends('layouts.master')
@section('title',"Insurance Rule Edit")
@section('breadcrumb')
    <li>
        <a class="parent-item" href="{{route('insuranceRule.index')}}">Insurance Rules</a>&nbsp;<i
            class="fa fa-angle-right"></i>
    </li>
    <li class="active">Insurance Rule Edit</li>
@endsection
@section('content')
    <!-- start widget -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>Insurance Rule Edit</header>
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
                    <form action="{{route('insuranceRule.update',$insuranceRule->id)}}" method="POST" id="form_sample_1"
                          class="form-horizontal">
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Insurance Type
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <select class="form-control" name="insuranceType">
                                        <option>Select Insurance Type</option>
                                        @foreach($insuranceTypes as $IT)
                                            <option @if($insuranceRule->insurance_type_id == $IT->id) selected
                                                    @endif value="{{$IT->id}}"> {{$IT->type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('insuranceType')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Rule
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <select class="form-control" name="rule_id">
                                        <option>Select Insurance Type</option>
                                        @foreach($rules as $rule)
                                            <option @if( $insuranceRule->rule_id == $rule->id ) selected
                                                    @endif value="{{ $rule->id }}"> {{ $rule->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('rule_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Value
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="value" data-required="1"
                                           class="form-control"
                                           value="{{ old('rule',isset($insuranceRule->value) ? $insuranceRule->value:null) }}"
                                           placeholder="Value"/>
                                </div>
                                @error('value')
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

