@extends('admin/navbar')

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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Specializations</th>
                        <th>Appointments</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                @foreach ($doctors as $doctor)
                <tbody>
                    <tr>
                        <form action="updatedelete" method="GET">
                            @csrf
                            <input type="hidden" name="id" value="{{$doctor -> id}}">
                            <td><input type="hidden" name="name" value="{{$doctor -> name}}">{{$doctor -> name}}</td>
                            <td><input type="hidden" name="email" value="{{$doctor -> email}}">{{$doctor -> email}}</td>
                            {{-- <td><input type="hidden" name="doctor_specializations" value="{{$doctor -> doctor_specializations}}">{{$doctor -> doctor_specializations[0] -> specialization -> name ?? 'null'}}</td> --}}
                            <td><input type="hidden" name="specializations" value={{$doctor -> Sp[0] -> name }}>{{$doctor -> Sp[0] -> name }}</td>
                            <input type="hidden" name="id_specializations" value={{$doctor -> Sp[0] -> id }}>
                            <td>{{count($doctor -> dates)}}</td>
                            <td><input type="submit" class=" btn btn-outline-primary rounded-pill" name="update" value="Update"></td>
                            <td><input type="submit" class=" btn btn-outline-primary rounded-pill" name="delete" value="Delete"></td>
                        </form>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>


@endsection


