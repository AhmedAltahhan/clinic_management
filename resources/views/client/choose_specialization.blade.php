@php
    use App\Models\Specialization;
@endphp
@extends('client/navbar')

@section('content')

<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h3 class="m-0 font-weight-bold text-primary">Choose Specialization</h3>
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


                    <form action="choose_doctor" method="get">
                        @csrf
                        <select name="specialization" required>
                            <option value="-1" selected disabled>Select Specialization</option>
                            @foreach (Specialization::all() as $s )
                                <option value="{{$s -> id}}">{{$s -> name}}</option>
                            @endforeach
                        </select><br><br>
                        <button type="submit" class="btn btn-primary">send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
