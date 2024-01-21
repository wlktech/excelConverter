@extends('master')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between mb-5">
        <h4>Address List</h4>
        <div>
            <a href="{{ route('export') }}" class="btn btn-sm btn-primary">Export</a>
            <a href="{{ url('/') }}" class="btn btn-sm btn-secondary">Back</a>
        </div>
    </div>
    {{-- datatable --}}
    <div class="">
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>အိမ်အမှတ်</th>
                        <th>လမ်း</th>
                        <th>ရပ်ကွက်</th>
                        <th>မြို့</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$d)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $d->homeNo }}</td>
                            <td>{{ $d->road }}</td>
                            <td>{{ $d->ward }}</td>
                            <td>{{ $d->township }}</td>
                            <td>
                                <a href="" class="btn btn-sm btn-primary">Edit</a>
                                <a href="" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection