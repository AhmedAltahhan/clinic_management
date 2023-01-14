@extends('client/navbar')

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
                        <th>id doctor</th>
                        <th>Number Specializations</th>
                        <th>Start Hour</th>
                        <th>End Hour</th>
                        <th>Appointment booking</th>
                    </tr>
                </thead>
                @foreach ($doctors as $doctor)
                <tbody>
                    <tr>
                        <form action="pick_date" method="GET">
                            @csrf
                            <td><input type="hidden" name="id" class="form-control" value="{{$doctor -> user_id}}">{{$doctor -> user_id}}</td>
                            <td>{{$doctor -> specialization_id}}</td>
                            <td>{{$doctor -> range[0] -> start_hour ?? null}}</td>
                            <td>{{$doctor -> range[0] -> end_hour ?? null}}</td>
                            <td><input type="submit" class=" btn btn-outline-primary rounded-pill" name="booking" value="booking"></td>

                        </form>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>


@endsection


