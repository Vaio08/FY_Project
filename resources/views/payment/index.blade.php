@extends('layouts.master')
@section('title',"Payments")
@push('css')
    <!-- data tables -->
    <link href="{{ asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css"/>
@endpush

@section('breadcrumb')

    <li class="active">Payments</li>
@endsection

@section('content')
    <!-- start widget -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>All Payments</header>
                    <div class="pull-right mr-2">
                        <a href="{{ route('payment.create') }}" id="addRow" class="btn btn-info">
                            ADD New <i class="fa fa-plus"></i>
                        </a>
                    </div>

                </div>
                <div class="card-body ">

                    <div class="table-scrollable">
                        <table class="table table-hover table-checkable order-column full-width"
                               id="example4">
                            <thead>
                            <tr>
                                <th class="center">Sr. No</th>
                                <th class="center">Insurance Policy No</th>
                                <th class="center">Amount</th>
                                <th class="center">Payment Method</th>
                                <th class="center">Payer Name</th>
                                <th class="center">Payer phone</th>
                                <th class="center">Payment Date</th>
                                <th class="center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $key=>$payment)
                                <tr class="odd gradeX">
                                    <td class="center">{{ $key +1 }}</td>
                                    <td class="center">{{ $payment->insurance->policy_no }}</td>
                                    <td class="center">{{ $payment->amount }}</td>
                                    <td class="center">{{ $payment->payment_method }}</td>
                                    <td class="center">{{ $payment->payer_name }}</td>
                                    <td class="center">{{ $payment->payer_phone }}</td>
                                    <td class="center">{{ $payment->created_at }}</td>

                                    <td class="center">
                                        <a href="{{ route('payment.edit',$payment->id) }}"
                                           class="btn btn-tbl-edit btn-xs">
                                            <i class="fa fa-pencil"></i>
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

@push('js')
    <!-- data tables -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script
        src="{{ asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.j') }}s"></script>
    <script src="{{ asset('assets/js/pages/table/table_data.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css" rel="stylesheet"
          type="text/css"/>
    <script src="https://unpkg.com/sweetalert2@8.18.6/dist/sweetalert2.all.js"></script>
    <script src="{{ asset('assets/js/sweetAlertDelete.js') }}"></script>
@endpush



