@extends('layouts.master')
@section('title',"Payment Report")
@section('breadcrumb')
    <li>
        <a class="parent-item" href="{{route('report.payment.index')}}">Payment Report</a>&nbsp;<i
            class="fa fa-angle-right"></i>
    </li>
    <li class="active">Report</li>
@endsection
@section('content')
    <!-- start widget -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3><b>Payment Report</b></h3>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">


                        </div>
                        <div class="pull-right text-right">
                            <address>
                                <p class="m-t-30">
                                    <b>From Date :</b> <i class="fa fa-calendar"></i> {{ $request['fromDate'] }}
                                </p>
                                <p class="m-t-30">
                                    <b>To Date :</b> <i class="fa fa-calendar"></i> {{ $request['toDate'] }}
                                </p>
                            </address>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Invoice No</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Payment Method</th>
                                    <th class="text-center">Payer Name</th>
                                    <th class="text-center">Payer Phone</th>
                                    <th class="text-right">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($paymentDetails as $key=>$payment)
                                <tr>
                                    <td class="text-center">{{ $key +1 }}</td>
                                    <td class="text-center">{{ $payment->insurance->policy_no }}</td>
                                    <td class="text-center">{{ $payment->amount }}</td>
                                    <td class="text-center">{{ $payment->payment_method }}</td>
                                    <td class="text-center">{{ $payment->payer_name }}</td>
                                    <td class="text-center">{{ $payment->payer_phone }}</td>
                                    <td class="text-right">{{ $payment->created_at }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right">

                            <hr>
                            <h3><b>Total :</b> {{ $totalAmount }} BDT</h3>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="text-right">
                            <button onclick="javascript:window.print();"
                                    class="btn btn-default btn-outline" type="button"> <span><i
                                        class="fa fa-print"></i> Print</span> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

