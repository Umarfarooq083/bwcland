@php
    $user = auth()->user();
@endphp
<div id="left-sidebar" class="sidebar">
    <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-arrow-left"></i></button>
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="{{ url('admin/assets/images/user.png') }}" class="rounded-circle user-photo" alt="User Profile Picture">
            <div class="dropdown">
                <span class="text-capitalize">{{ optional(Auth::user())->role ?? 'Guest' }},</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong class="text-capitalize">{{ optional(Auth::user())->name ?? 'BWC' }}</strong></a>
                <ul class="p-0 dropdown-menu dropdown-menu-right account">
                    <li>
                        <a href="#" onclick="document.getElementById('logoutForm').submit();">
                            <i class="icon-power"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>                
            <hr>
        </div>
            
        <div class="tab-content padding-0">
            <div class="tab-pane active" id="menu">
                <nav id="left-sidebar-nav" class="sidebar-nav">
                    <ul class="metismenu li_animation_delay">
                        <li class="active">
                            <a href="/dashboard">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        @if(in_array($user->role, ['admin', 'superadmin']))
                            <li>
                                <a href="/tariff-list" class="has-arrow">
                                    <i class="fa fa-dollar"></i>
                                    <span>Tariff</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('tariffs.index') }}" id="add_tariff">Add Tariff</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('tariffs.list') }}" id="tariff_list">Tariff List</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="/consumer-list" class="has-arrow">
                                    <i class="fa fa-users"></i>
                                    <span>Consumers</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('consumers.index') }}" id="add_consumer">Add Consumer</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('consumers.list') }}" id="consumers_list">Consumers List</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="/readings-list" class="has-arrow">
                                    <i class="fa fa-sticky-note"></i>
                                    <span>Meter Reading</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('readings.index') }}" id="add_reading">Add Reading</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('readings.list') }}" id="reading_list">Reading List</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="/readings-list" class="has-arrow">
                                    <i class="fa fa-money"></i>
                                    <span>Bill</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('bills.index') }}" id="add_bill">Generate Bill</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('bills.list') }}" id="bill_list">Bill List</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('bills.getbill') }}" id="regen_bill">ReGenerate Bill</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('arrears.index') }}" id="add_arrear">Bill Collection</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div> 
        </div>          
    </div>
</div>
