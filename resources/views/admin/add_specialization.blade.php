@extends('admin/navbar')

@section('content')

<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h3 class="m-0 font-weight-bold text-primary">Add Specialization</h3>
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
                        <form action="/add_specialization" method="POST">
                            @csrf
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Entet your name"><br>
                            <textarea name="details" cols="30" rows="5" class="form-control" id="exampleFormControlInput1" placeholder="enter the description"></textarea><br>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>

@endsection
