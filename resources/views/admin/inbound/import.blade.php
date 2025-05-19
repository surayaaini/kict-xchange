@extends('layouts.master')

@section('content')
<div class="container">
    <h3>Import Inbound Students (Excel)</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('inbounds.import') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="excel_file" class="form-label">Upload Excel File</label>
            <input type="file" name="excel_file" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Import</button>
    </form>
</div>
@endsection
