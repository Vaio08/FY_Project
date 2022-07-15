@extends('layouts.master')
@section('title',"Dashboard")
@section('breadcrumb')
    <li class="active">Dashboard</li>
@endsection

@section('content')
    <!-- start widget -->
    <div class="state-overview">
        <div class="row">
            <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-blue">
                    <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Orders</span>
                        <span class="info-box-number">450</span>
                        <div class="progress">
                            <div class="progress-bar width-60"></div>
                        </div>
                        <span class="progress-description">
											60% Increase in 28 Days
										</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-orange">
									<span class="info-box-icon push-bottom"><i
                                            class="material-icons">card_travel</i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">New Booking</span>
                        <span class="info-box-number">155</span>
                        <div class="progress">
                            <div class="progress-bar width-40"></div>
                        </div>
                        <span class="progress-description">
											40% Increase in 28 Days
										</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-purple">
									<span class="info-box-icon push-bottom"><i
                                            class="material-icons">phone_in_talk</i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Inquiry</span>
                        <span class="info-box-number">52</span>
                        <div class="progress">
                            <div class="progress-bar width-80"></div>
                        </div>
                        <span class="progress-description">
											80% Increase in 28 Days
										</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="info-box bg-success">
									<span class="info-box-icon push-bottom"><i
                                            class="material-icons">monetization_on</i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Earning</span>
                        <span class="info-box-number">13,921</span><span>$</span>
                        <div class="progress">
                            <div class="progress-bar width-60"></div>
                        </div>
                        <span class="progress-description">
											60% Increase in 28 Days
										</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
    </div>
@endsection
