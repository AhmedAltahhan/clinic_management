@extends('doctor/navbar')

@section('content')


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Doctors</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Start hour</th>
                        <th>End hour</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                @foreach ($working__range as $range)
                <tbody>
                    <form action="/remove" method="GET">
                        @csrf
                        <tr><input type="hidden" name="id" value="{{$range -> id}}">
                            <td>{{$range -> start_hour}}</td>
                            <td>{{$range -> end_hour}}</td>
                            <td><input type="submit" class=" btn btn-outline-primary rounded-pill" value="Delete"></td>
                        </tr>
                    </form>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>


@endsection


