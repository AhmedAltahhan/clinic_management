@extends('client/navbar')

@section('content')


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Date</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Doctor ID </th>
                        <th>doctor </th>
                        <th>Date </th>
                        <th>Delete </th>

                    </tr>
                </thead>
                @foreach ($date as $range)
                <tbody>
                    <form action="delete" method="GET">
                    <tr>
                        <input type="hidden" name="id" value="{{$range -> id}}">
                        <td>{{$range -> dates[0] -> id}}</td>
                        <td>{{$range -> dates[0] -> name}}</td>
                        <td>{{$range -> date}}</td>
                        <td><input type="submit" class=" btn btn-outline-primary rounded-pill" name="delete" value="Delete"></td>

                    </tr>
                    </form>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>


@endsection


