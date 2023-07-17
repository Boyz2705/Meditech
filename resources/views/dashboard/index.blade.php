@extends('layouts.main')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Chart Member Meditech </h3>
        {{-- <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Charts</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chart-js</li>
            </ol>
        </nav> --}}
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Member</h4>
                    <canvas id="barChart" style="height:230px"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="../../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../../assets/js/chart.js"></script>
@endsection

