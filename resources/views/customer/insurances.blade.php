@extends('layouts.master')
@section('title',"Insurances")
@push('css')
    <!-- data tables -->
    <link href="{{ asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css"/>
@endpush

@section('breadcrumb')

    <li class="active">Insurances</li>
@endsection

@section('content')
    <!-- start widget -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>All Insurances</header>
                </div>
                <div class="card-body ">

                    <div class="table-scrollable">
                        <table class="table table-hover table-checkable order-column full-width"
                               id="example4">
                            <thead>
                            <tr>
                                <th class="center">Sr. No</th>
                                <th class="center">Policy No</th>
                                <th class="center">Customer</th>
                                <th class="center">Insurance Type</th>
                                <th class="center">Insurance Category</th>
                                <th class="center">Insurance Amount</th>
                                <th class="center">Deposited Money</th>
                                <th class="center">Insurance Date</th>
                                <th class="center">mature Date</th>
                                <th class="center">Withdraw Status</th>
                                <th class="center">Withdraw Reason</th>
                                <th class="center">Withdraw date</th>
                                <th class="center">Agent</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($insurances as $key=>$insurance)
                                <tr class="odd gradeX">
                                    <td class="center">{{ $key +1 }}</td>
                                    <td class="center">{{ $insurance->policy_no }}</td>
                                    <td class="center">{{ $insurance->customer->name }}</td>
                                    <td class="center">{{ $insurance->insuranceType->type_name }}</td>
                                    <td class="center">{{ $insurance->insuranceType->insuranceCategory->name }}</td>
                                    <td class="center">{{ $insurance->insurance_amount }}</td>
                                    <td class="center">{{ $insurance->deposited_money }}</td>
                                    <td class="center">{{ $insurance->insurance_date }}</td>
                                    <td class="center">{{ $insurance->mature_date }}</td>
                                    <td class="center">{{ $insurance->withdraw_status }}</td>
                                    <td class="center">{{ $insurance->withdraw_reason }}</td>
                                    <td class="center">{{ $insurance->withdraw_date }}</td>
                                    <td class="center">{{ $insurance->agent->name }}</td>

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
@endpush



