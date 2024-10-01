@extends('layouts.layoutsadmin')

@section('content')

<section style="margin-top: 100px;">
    <div class="container" style="margin-left: 3.5rem;">
        <h4></h4>
    </div>
</section>
<section style="margin-top: 35px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="card bg-primary" style="height: 180px;">
                    <div class="card-body">
                        <h3 class="card-title" style="color: #F0FFFF;">{{ $jml_user }}</h3>
                        <p class="card-text" style="color: #F0FFFF;">Total Jumlah</p>
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
<section>
            <div class="row" style="margin-top: 3rem;">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4 mt-8">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                        </div>
                        <div class="card-body">
                            <h4 class="small font-weight-bold">Server Migration <span
                                    class="float-right">20%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Sales Tracking <span
                                    class="float-right">40%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Customer Database <span
                                    class="float-right">60%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar" style="width: 60%"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Payout Details <span
                                    class="float-right">80%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Account Setup <span
                                    class="float-right">Complete!</span></h4>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4 mt-8">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Server Migration <span
                            class="float-right">20%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Sales Tracking <span
                            class="float-right">40%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Customer Database <span
                            class="float-right">60%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: 60%"
                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Payout Details <span
                            class="float-right">80%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Account Setup <span
                            class="float-right">Complete!</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section>
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                Primary
                <div class="text-white-50 small">#4e73df</div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                Success
                <div class="text-white-50 small">#1cc88a</div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                Info
                <div class="text-white-50 small">#36b9cc</div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card bg-warning text-white shadow">
            <div class="card-body">
                Warning
                <div class="text-white-50 small">#f6c23e</div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card bg-danger text-white shadow">
            <div class="card-body">
                Danger
                <div class="text-white-50 small">#e74a3b</div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card bg-secondary text-white shadow">
            <div class="card-body">
                Secondary
                <div class="text-white-50 small">#858796</div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card bg-light text-black shadow">
            <div class="card-body">
                Light
                <div class="text-black-50 small">#f8f9fc</div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card bg-dark text-white shadow">
            <div class="card-body">
                Dark
                <div class="text-white-50 small">#5a5c69</div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
@endsection
