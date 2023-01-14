@extends('client/navbar')

@section('content')

<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h3 class="m-0 font-weight-bold text-primary">Pick date</h3>
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

                    @php
                    $m = date('m') + 3;
                    $today = date("Y-m-d 00:00:00");
                    $maxt = date("Y-0$m-d 00:00:00");

                    @endphp

                    <form action=" " method="POST">
                        @csrf
                        <input type="datetime-local" name="date" min="{{$today}}" max="{{$maxt}}"  class="form-control" placeholder="please select date"><br>
                        @foreach ($doctors as $doctor)
                        <input type="hidden" name="email" value="{{$doctor -> email}}" class="form-control" placeholder="please select doctor email"><br>
                        @endforeach
                        <button type="submit" class="btn btn-primary">send</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


</div>

@endsection
