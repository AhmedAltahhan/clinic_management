@extends('doctor/navbar')

@section('content')

<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h3 class="m-0 font-weight-bold text-primary">Update Time for each client</h3>
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
                    <br>
                    <form action="/update_user_time" method="POST">
                        @csrf
                        <input type="number" name="duration" class="form-control" value="{{Auth::user() -> duration}}" placeholder="Time for each client hour" min="0" max="60"><br><br>
                        <button type="submit" class="btn btn-primary">submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


</div>

@endsection
