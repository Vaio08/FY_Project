@extends('layouts.master')
@section('title',"User")
@push('css')
    <!-- data tables -->
    <link href="{{ asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css"/>
@endpush

@section('breadcrumb')

    <li class="active">User Profile</li>
@endsection

@section('content')
    <!-- start widget -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <div class="card card-topline-aqua">
                    <div class="card-body no-padding height-9">
                        <div class="row">
                            <div class="profile-userpic">
                                <img src="{{ asset($userData->image) }}" class="img-responsive" alt=""> </div>
                        </div>
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> {{ $userData->name }} </div>
                            <div class="profile-usertitle-job"> {{ $userData->role }} </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="profile-tab-box">
                        <div class="p-l-20">
                            <ul class="nav ">
                                <li class="nav-item tab-all"><a class="nav-link active show"
                                                                href="#tab1" data-toggle="tab">About Me</a></li>

                                <li class="nav-item tab-all p-l-20"><a class="nav-link" href="#tab3"
                                                                       data-toggle="tab">Settings</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="white-box">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active fontawesome-demo" id="tab1">
                                <div id="biography">
                                    <div class="row">
                                        <div class="col-md-3 col-6 b-r"> <strong>Full Name</strong>
                                            <br>
                                            <p class="text-muted">{{ $userData->name }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 b-r"> <strong>Mobile</strong>
                                            <br>
                                            <p class="text-muted">{{ $userData->phone }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 b-r"> <strong>Email</strong>
                                            <br>
                                            <p class="text-muted">{{ $userData->email }}</p>
                                        </div>
                                        <div class="col-md-3 col-6"> <strong>User Identity</strong>
                                            <br>
                                            <p class="text-muted">{{ $userData->user_identity }}</p>
                                        </div>
                                    </div>
                                    <hr>

                                </div>
                            </div>

                            <div class="tab-pane" id="tab3">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="card-head">
                                            <header>Password Change</header>
                                            <button id="panel-button2"
                                                    class="mdl-button mdl-js-button mdl-button--icon pull-right"
                                                    data-upgraded=",MaterialButton">
                                                <i class="material-icons">more_vert</i>
                                            </button>
                                            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                                                data-mdl-for="panel-button2">
                                                <li class="mdl-menu__item"><i
                                                        class="material-icons">assistant_photo</i>Action
                                                </li>
                                                <li class="mdl-menu__item"><i
                                                        class="material-icons">print</i>Another action
                                                </li>
                                                <li class="mdl-menu__item"><i
                                                        class="material-icons">favorite</i>Something
                                                    else here</li>
                                            </ul>
                                        </div>
                                        <div class="card-body " id="bar-parent1">
                                            <form>
                                                <div class="form-group">
                                                    <label for="simpleFormEmail">User Name</label>
                                                    <input type="email" class="form-control"
                                                           id="simpleFormEmail"
                                                           placeholder="Enter user name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="simpleFormPassword">Current
                                                        Password</label>
                                                    <input type="password" class="form-control"
                                                           id="simpleFormPassword"
                                                           placeholder="Current Password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="simpleFormPassword">New Password</label>
                                                    <input type="password" class="form-control"
                                                           id="newpassword" placeholder="New Password">
                                                </div>
                                                <button type="submit"
                                                        class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
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



