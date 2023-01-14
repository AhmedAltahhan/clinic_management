@extends('doctor/navbar')

@section('content')

<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h3 class="m-0 font-weight-bold text-primary">Add Working Hours</h3>
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

                    <form action="/add_range" method="POST">
                    @csrf
                    <br>
                    <input type="number" name="start" class="form-control" id="exampleFormControlInput1" placeholder="starting hour" min="0" max="24"><br>
                    <input type="number" name="end" class="form-control" id="exampleFormControlInput1" placeholder="ending hour" min="0" max="24"><br><br>
                    <button type="submit" class="btn btn-primary">submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


</div>

@endsection
