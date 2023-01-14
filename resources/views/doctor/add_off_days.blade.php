@extends('doctor/navbar')

@section('content')

<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h3 class="m-0 font-weight-bold text-primary">Add Off Days</h3>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    @if (isset($error))
                    <small style="color:red">{{$error}}</small>
                    @endif

                    @if (isset($success))
                    <small style="color:green">{{$success}}</small>
                    @endif

                    <form action="/off_days" method="POST">
                    @php
                    $today = date("Y-m-d");
                    @endphp
                    @csrf
                    <br>
                    <input type="date" name="date" min="{{$today}}" class="form-control"><br>
                    <button type="submit" class="btn btn-primary">submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


</div>

@endsection
