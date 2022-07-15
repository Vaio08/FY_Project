@extends('layouts.master')
@section('title',"$insuranceCategory - $insurance->policy_no Withdraw")
@section('breadcrumb')
    <li>
        <a class="parent-item" href="{{route('insurance.index')}}">Insurances</a>&nbsp;<i
            class="fa fa-angle-right"></i>
    </li>
    <li class="active">Print</li>
@endsection
@push('css')
    <style>
        @media print {
            .logo-default {
                max-width: 70px !important;
            }
        }
        @page {
            margin-top: 0;
            margin-bottom: 0;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div id="capture-area">
                    <h3><b><img src="{{ asset('images/2268_t.png') }}" style="max-width: 70px;" alt="logo"
                                class="logo-default"/> Insurance
                            Company</b></h3>
                    <h4 class="text-center">{{ $insuranceCategory }} Insurance Withdraw - Policy
                        No- {{$insurance->policy_no }}</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form, by injected humour, or randomised words which don't
                                look
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
                    <hr>

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
                    <hr>

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

                    <h2 class="heading">Withdraw Information</h2> <br>
                    <div class="row">
                        <div class="col-md-6">
                            <b>Withdraw Date:</b> {{ $insurance->withdraw_date }}
                        </div>

                        <div class="col-md-12">
                            <b>Withdraw Reason:</b> {{ $insurance->withdraw_reason }}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        The information that I have provided are all true which are authorized with
                                        documents
                                        provided to the company.
                                    </p>

                                    <div class="pull-left">
                                        Policyholder’s Signature: ____________________
                                    </div>
                                    <div class="pull-right">
                                        Date: ____________________
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="text-right">
                        <button onclick="printDiv()" class="btn btn-info btn-outline" type="button">
                            <span><i class="fa fa-print"></i> Print</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function printDiv() {
            let restorepage = document.body.innerHTML;
            let printcontent = document.getElementById('capture-area').innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
        }
    </script>
@endpush



