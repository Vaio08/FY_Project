@extends('layouts.master')
@section('title',"Insurance Category")
@push('css')
    <!-- data tables -->
    <link href="{{ asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css"/>
@endpush

@section('breadcrumb')

    <li class="active">Insurance Category</li>
@endsection

@section('content')
    <!-- start widget -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>All Categories</header>
                    <div class="pull-right mr-2">
                        <a href="{{ route('insuranceCategory.create') }}" id="addRow" class="btn btn-info">
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
                                <th class="center">Name</th>
                                <th class="center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($insuranceCategory as $key=>$InC)
                                <tr class="odd gradeX">
                                    <td class="center">{{ $key +1 }}</td>
                                    <td class="center">{{ $InC->name }}</td>

                                    <td class="center">
                                        <a href="{{ route('insuranceCategory.edit',$InC->id) }}" class="btn btn-tbl-edit btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-tbl-delete btn-xs"
                                                onclick="deleteCategory({{$InC->id}})">
                                            <i class="fa fa-trash-o "></i>
                                        </button>
                                        <form id="delete-form-{{$InC->id}}"
                                              action="{{route('insuranceCategory.destroy', $InC->id)}}"
                                              method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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


