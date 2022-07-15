@extends('layouts.master')
@section('title',"Payments")
@push('css')
    <!-- data tables -->
    <link href="{{ asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css"/>
@endpush

@section('breadcrumb')

    <li class="active">Payment History</li>
@endsection

@section('content')
    <!-- start widget -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>All Payments</header>

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
                            </tr>
                            </thead>
                            <tbody>
                            @if($payments != null)
                                @foreach($payments as $key=>$payment)
                                    <tr class="odd gradeX">
                                        <td class="center">{{ $key +1 }}</td>
                                        <td class="center">{{ $payment->policy_no }}</td>
                                        <td class="center">{{ $payment->amount }}</td>
                                        <td class="center">{{ $payment->payment_method }}</td>
                                        <td class="center">{{ $payment->payer_name }}</td>
                                        <td class="center">{{ $payment->payer_phone }}</td>
                                        <td class="center">{{ $payment->created_at }}</td>
                                    </tr>
                                @endforeach
                            @endif
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
@endpush



