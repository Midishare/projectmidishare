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
            </div>
        </div>
    </section>
@endsection
