<div class="sidemenu-container navbar-collapse collapse fixed-menu">
    <div id="remove-scroll">
        <ul class="sidemenu page-header-fixed p-t-20" data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="sidebar-user-panel">
                <div class="user-panel">
                    <div class="row">
                        <div class="sidebar-userpic">
                            <img src="{{ asset(auth()->user()->image) }}" class="img-responsive" alt=""></div>
                    </div>
                    <div class="profile-usertitle">
                        <div class="sidebar-userpic-name"> {{ auth()->user()->name }}</div>
                        <div class="profile-usertitle-job">
                            @if(auth()->user()->role == 1)
                                Admin
                            @elseif(auth()->user()->role == 2)
                                Employee
                            @elseif(auth()->user()->role == 3)
                                Agent
                            @elseif(auth()->user()->role == 4)
                                Customer
                            @endif
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item start">
                <a href="{{ route('dashboard') }}" class="nav-link nav-toggle">
                    <i class="material-icons">dashboard</i>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            {{--  Admin  --}}
            @if (auth()->user()->role == 1)
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link nav-toggle"> <i class="material-icons">perm_identity</i>
                        <span class="title">User</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('insuranceCategory.index') }}" class="nav-link nav-toggle"> <i
                            class="material-icons">widgets</i>
                        <span class="title">Insurance Categories</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('insuranceType.index') }}" class="nav-link nav-toggle"> <i class="material-icons">widgets</i>
                        <span class="title">Insurance Type</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('rule.index') }}" class="nav-link nav-toggle"> <i class="material-icons">list</i>
                        <span class="title">Rule</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('insuranceRule.index') }}" class="nav-link nav-toggle"> <i class="material-icons">filter_list </i>
                        <span class="title">Insurance Rule</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('report.payment.index') }}" class="nav-link nav-toggle"> <i class="material-icons">filter_list </i>
                        <span class="title">Payment Report</span>
                    </a>
                </li>

            @endif

            {{--   Employee or admin   /--}}
            @if (auth()->user()->role == 1 || auth()->user()->role == 2)
                <li class="nav-item">
                    <a href="{{ route('insurance.index') }}" class="nav-link nav-toggle"> <i class="material-icons">account_balance</i>
                        <span class="title">Insurance</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('payment.index') }}" class="nav-link nav-toggle"> <i class="material-icons">payment</i>
                        <span class="title">Payment</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('insurance.withdraw') }}" class="nav-link nav-toggle"> <i class="material-icons">attach_money</i>
                        <span class="title">Insurance Withdraw</span>
                    </a>
                </li>
            @endif

            {{--   Customer or admin   /--}}
            @if (auth()->user()->role == 4)
                <li class="nav-item">
                    <a href="{{ route('customer.insurances') }}" class="nav-link nav-toggle"> <i class="material-icons">account_balance</i>
                        <span class="title">Insurances</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('customer.payments') }}" class="nav-link nav-toggle"> <i class="material-icons">payment</i>
                        <span class="title">Payment History</span>
                    </a>
                </li>
            @endif


        </ul>
    </div>
</div>
