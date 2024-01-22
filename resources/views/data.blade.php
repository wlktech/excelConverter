<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4>Address List</h4>
                <div>
                    <a href="{{ route('export') }}" class="btn btn-sm btn-success">Export</a>
                    <form class="d-inline" action="{{ route('bulk-delete') }}" method="post">
                        @csrf
                        <button class="btn btn-sm btn-danger">Bulk Delete</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
