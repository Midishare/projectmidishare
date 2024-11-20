@extends('layouts.layoutsadmin')

@section('content')
    <section style="margin-top: 35px; margin-top: 100px;">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="card bg-primary" style="height: 180px;">
                        <div class="card-body">
                            <h3 class="card-title" style="color: #F0FFFF;">{{ $jml_user }}</h3>
                            <p class="card-text" style="color: #F0FFFF;">Total User</p>
                        </div>
                        <div class="card-footer" style="color: #F0FFFF;">
                            <i class="ion bi bi-box-arrow-in-down" style="color: #F0FFFF;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card bg-primary" style="height: 180px;">
                        <div class="card-body">
                            <h3 class="card-title" style="color: #F0FFFF;">{{ $jml_perhari }}</h3>
                            <p class="card-text" style="color: #F0FFFF;">Total User Update</p>
                        </div>
                        <div class="card-footer" style="color: #F0FFFF;">
                            <i class="ion bi bi-box-arrow-in-down" style="color: #F0FFFF;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card bg-primary" style="height: 180px;">
                        <div class="card-body" style="color: #F0FFFF;">
                            <h3 class="card-title" style="color: #F0FFFF;">{{ $onlineUsersCount }}</h3>
                            <p class="card-text" style="color: #F0FFFF;">Total Akses User</p>
                        </div>
                        <div class="card-footer">
                            <i class="ion bi bi-box-arrow-in-down" style="color: #F0FFFF;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="bi bi-person-check me-2"></i>Currently Active Sessions
                            </h5>
                            <span class="badge bg-light text-dark">{{ count($currentSessions) }} Active</span>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>IP Address</th>
                                            <th>Login Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($currentSessions as $session)
                                            <tr>
                                                <td>{{ $session['user_name'] }}</td>
                                                <td>{{ $session['ip_address'] }}</td>
                                                <td>{{ $session['login_time'] }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-3">
                                                    No active sessions
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="bi bi-calendar-week me-2"></i>Weekly Login Activities
                            </h5>
                            <span class="badge bg-light text-dark">Last 7 Days</span>
                        </div>
                        <div class="card-body">
                            @forelse($weeklyLogins as $date => $logins)
                                <div class="mb-4">
                                    <h5 class="mb-3">
                                        {{ Carbon\Carbon::parse($date)->format('d M Y') }}
                                        <span class="badge bg-secondary ms-2">{{ count($logins) }} Logins</span>
                                    </h5>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Login Time</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($logins as $login)
                                                    <tr>
                                                        <td>{{ $login['user_name'] }}</td>
                                                        <td>{{ $login['login_time'] }}</td>
                                                        <td>
                                                            <span
                                                                class="badge {{ $login['status'] == 'login' ? 'bg-success' : 'bg-warning' }}">
                                                                {{ ucfirst($login['status']) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info text-center">
                                    No login activities in the past week
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="bi bi-calendar-month me-2"></i>Monthly Login Activities
                            </h5>
                            <span class="badge bg-light text-dark">Last 30 Days</span>
                        </div>
                        <div class="card-body">
                            @forelse($monthlyLogins as $month => $logins)
                                <div class="mb-4">
                                    <h5 class="mb-3">
                                        {{ Carbon\Carbon::parse($month . '-01')->format('F Y') }}
                                        <span
                                            class="badge bg-secondary ms-2">{{ is_countable($logins) ? count($logins) : 0 }}
                                            Logins</span>
                                    </h5>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Login Time</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($logins as $login)
                                                    <tr>
                                                        <td>{{ $login['user_name'] }}</td>
                                                        <td>{{ $login['login_time'] }}</td>
                                                        <td>
                                                            <span
                                                                class="badge {{ $login['status'] == 'login' ? 'bg-success' : 'bg-warning' }}">
                                                                {{ ucfirst($login['status']) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info text-center">
                                    No login activities in the past month
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        // Optional: Add any additional JavaScript for interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Example: Add tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        /* Optional: Add custom styles */
        .table-responsive {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
@endpush
