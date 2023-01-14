@extends('doctor/navbar')

@section('content')


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Dates</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>User id</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($date as $da)
                <tbody>
                    <form action="add_delete" method="GET">
                        @csrf
                        <tr><input type="hidden" name="id" value="{{$da -> id}}">
                            <input type="hidden" name="doctor_id" value="{{$da -> doctor_id}}">
                            <td><input type="hidden" name="user_id" value="{{$da -> user_id}}">{{$da -> user_id}}</td>
                            <td>{{$da -> date}}</td>
                            <td>
                                <input type="submit" class=" btn btn-outline-primary rounded-pill" name="delete" value="Delete">
                            </td>
                        </tr>
                    </form>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>


@endsection


