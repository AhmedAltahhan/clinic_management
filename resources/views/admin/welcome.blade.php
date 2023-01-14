@extends('admin/navbar')

@section('content')

<div class="row">

    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Information</h6>

            </div>
            <div class="card-body">
                <div class="chart-area">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Update</th>
                        </tr>
                        </thead>
                        @foreach ($admins as $admin)
                        <tbody>
                        <tr>
                            <form action="update" method="GET">
                                @csrf
                                <th scope="row"><input type="hidden" name="id" value="{{$admin -> id}}">{{$admin -> id}}</th>
                                <td><input type="hidden" name="name" value="{{$admin -> name}}">{{$admin -> name}}</td>
                                <td><input type="hidden" name="email" value="{{$admin -> email}}">{{$admin -> email}}</td>
                                <input type="hidden" name="role" value="{{$admin -> role}}">
                                <input type="hidden" name="duration" value="{{$admin -> duration}}">
                                <td><input type="submit" class=" btn btn-outline-primary rounded-pill" name="update" value="Update"></td>
                            </form>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
