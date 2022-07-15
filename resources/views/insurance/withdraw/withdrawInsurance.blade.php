@extends('layouts.master')
@section('title',"$insuranceCategory - $insurance->policy_no Withdraw")
@section('breadcrumb')
    <li>
        <a class="parent-item" href="{{route('insurance.index')}}">Insurances</a>&nbsp;<i
            class="fa fa-angle-right"></i>
    </li>
    <li class="active">Print</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="white-box" id="capture-area">
                <h3><b><img src="{{ asset('images/2268_t.png') }}" style="max-width: 70px;" alt="logo"
                            class="logo-default"/> Insurance
                        Company</b></h3>
                <h4 class="text-center">{{ $insuranceCategory }} Insurance Withdraw - Policy
                    No- {{$insurance->policy_no }}</h4>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form, by injected humour, or randomised words which don't look
                            even slightly believable. </p>
                    </div>
                </div>

                <h2 class="heading">Insurance's Information</h2> <br>
                <div class="row">
                    <div class="col-md-6">
                        <b>Insurance Type:</b> {{ $insurance->insuranceType->insuranceCategory->name }}
                    </div>
                    <div class="col-md-6">
                        <b>Policy Type:</b> {{ $insurance->insuranceType->type_name }}
                    </div>

                    <div class="col-md-6">
                        <b>Policy No:</b> {{ $insurance->policy_no }}
                    </div>
                    <div class="col-md-6">
                        <b>Insurance Amount:</b> {{ $insurance->insurance_amount }}
                    </div>
                    <div class="col-md-6">
                        <b>Deposited Amount:</b> {{ $insurance->deposited_amount }}
                    </div>

                    <div class="col-md-6">
                        <b>Insurance Date:</b> <i class="fa fa-calendar"></i> {{ $insurance->insurance_date }}
                    </div>
                    <div class="col-md-6">
                        <b>Mature Date:</b> <i class="fa fa-calendar"></i> {{ $insurance->mature_date }}
                    </div>


                    <div class="col-md-6">
                        <b>Agent:</b> {{ $insurance->agent->name }}
                    </div>
                </div>

                <h2>Policyholder's Information</h2> <br>
                <div class="row">
                    <div class="col-md-6">
                        <b>Name:</b> {{ $insurance->customer->name }}
                    </div>
                    <div class="col-md-6">
                        <b>Email:</b> {{ $insurance->customer->email }}
                    </div>

                    <div class="col-md-6">
                        <b>Phone:</b> {{ $insurance->customer->phone }}
                    </div>
                    <div class="col-md-6">
                        <b>Address:</b> {{ $insurance->customer->address }}
                    </div>

                    <div class="col-md-6">
                        <b>Gender:</b> {{ $insurance->customer->gender }}
                    </div>
                    <div class="col-md-6">
                        <b>Identity:</b> {{ $insurance->customer->customer_identity }}
                    </div>
                </div>

                @if($insuranceCategory == 'Life')
                    <h2>Nominee's Information</h2> <br>
                    <div class="row">
                        <div class="col-md-6">
                            <b>Name:</b> {{ $insuranceDetails->nominee_name }}
                        </div>
                        <div class="col-md-6">
                            <b>Relation:</b> {{ $insuranceDetails->nominee_relation }}
                        </div>

                        <div class="col-md-6">
                            <b>Identity:</b> {{ $insuranceDetails->nominee_identity }}
                        </div>
                        <div class="col-md-6">
                            <b>Ensured Person name:</b> {{ $insuranceDetails->ensured_person_name }}
                        </div>

                        <div class="col-md-6">
                            <b>Ensured Person NID:</b> {{ $insuranceDetails->ensured_person_nid }}
                        </div>
                        <hr>
                    </div>
                @elseif($insuranceCategory == 'Health')
                    <h2>Other Information</h2> <br>
                    <div class="row">
                        <div class="col-md-6">
                            <b>Ensured Person name:</b> {{ $insuranceDetails->ensured_person_name }}
                        </div>

                        <div class="col-md-6">
                            <b>Ensured Person NID:</b> {{ $insuranceDetails->ensured_person_nid }}
                        </div>
                        <hr>
                    </div>
                @endif
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="clearfix"></div>
                        <form action="{{ route('withdraw.update',$insurance->id) }}" method="POST" id="form_sample_1"
                              class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label class="control-label col-md-3">With draw Reason
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-5">
                                    <textarea type="text" name="withdraw_reason" data-required="1"
                                              class="form-control">{{ old('withdraw_reason') }}</textarea>
                                </div>
                                @error('withdraw_reason')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="offset-md-3 col-md-9">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <button type="button" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


