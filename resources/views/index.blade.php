@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card p-4 border border-0 shadow" id="form">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="text-center">Excel Format Converter</h5>
                    <div>
                        <a href="{{ route('data') }}" class="btn btn-sm btn-primary">See List</a>
                    </div>
                </div>
                {{-- @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
                @endif --}}
                
                <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="excel" class="form-label">Excel File</label>
                        <input type="file" class="form-control" name="excel" id="excel" accept=".xls,.xlsx">
                        @error('excel')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-secondary">Convert</button>
                    </div>
                </form>
                
                {{-- Session Messages --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                
            </div>
        </div>
    </div>    
</div> 
@endsection