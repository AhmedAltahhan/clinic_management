@php
    use App\Models\Specialization;
@endphp

@extends('admin/navbar')


@section('content')
<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Add Doctor</h6>
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

                    <div>
                        <form action="/add_doctor" method="POST">
                            @csrf
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Enter the name"><br>
                            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter the email"><br>
                            <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="Enter the password"><br>
                            <select name="specialization" >
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


</div>

@endsection
