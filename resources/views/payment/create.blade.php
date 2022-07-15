@extends('layouts.master')
@section('title',"Insurance Type Create")
@section('breadcrumb')
    <li>
        <a class="parent-item" href="{{route('payment.index')}}">Payment Create</a>&nbsp;<i
            class="fa fa-angle-right"></i>
    </li>
    <li class="active">Payment Create</li>
@endsection
@section('content')
    <!-- start widget -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>Payment Create</header>
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
                    <form action="{{route('payment.store')}}" method="POST" id="form_sample_1"
                          class="form-horizontal">
                        @csrf
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Policy No
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="policy_no" data-required="1"
                                           class="form-control" value="{{old('policy_no')}}" placeholder="Name"/>
                                </div>
                                @error('policy_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Amount
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="number" min="0" name="amount" data-required="1"
                                           class="form-control" value="{{old('amount')}}"
                                           placeholder="Amount"/>
                                </div>
                                @error('amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Payment Method
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="payment_method" data-required="1"
                                           class="form-control" value="{{old('payment_method')}}" placeholder="Payment Method"/>
                                </div>
                                @error('payment_method')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Payer Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="payer_name" data-required="1"
                                           class="form-control" value="{{old('payer_name')}}"
                                           placeholder="Payer Name"/>
                                </div>
                                @error('payer_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Payer Phone
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="payer_phone" data-required="1"
                                           class="form-control" value="{{old('payer_phone')}}"
                                           placeholder="Payer Phone"/>
                                </div>
                                @error('payer_phone')
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

