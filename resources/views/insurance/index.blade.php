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
                    <div class="pull-right mr-2">
                        <a href="{{ route('selectInsuranceType') }}" id="addRow" class="btn btn-info">
                            Create New <i class="fa fa-plus"></i>
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
                                <th class="center">Action</th>
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

                                    <td class="center">
                                        <a href=""
                                           class="btn btn-tbl-edit btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('insurance.print',$insurance->id) }}"
                                           class="label label-sm label-success">
                                            <i class="fa fa-print"></i>
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
    <script type="text/javascript">
        function deleteCategory(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You can not get back this data!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Canceled',
                        'Data is safe 🙂',
                        'error'
                    )
                }
            })

        }
    </script>
@endpush


