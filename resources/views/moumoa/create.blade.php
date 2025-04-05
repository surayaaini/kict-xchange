
@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Add MOU/MOA List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">MOU/MOA List</li>
                        <li class="breadcrumb-item active">Add</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Add MOU/MOA Form Section -->
    <form method="POST" action="{{ route('moumoa.store') }}">
        @csrf

        <div class="row mb-3">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control" id="title" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="partner" class="col-sm-2 col-form-label">Partner Institution</label>
            <div class="col-sm-10">
                <input type="text" name="partner" class="form-control" id="partner" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
            <div class="col-sm-4">
                <input type="date" name="start_date" class="form-control" id="start_date" required>
            </div>

            <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
            <div class="col-sm-4">
                <input type="date" name="end_date" class="form-control" id="end_date">
            </div>
        </div>

        <div class="row mb-3">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea name="description" class="form-control" id="description" rows="3"></textarea>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Save MOU/MOA</button>
        </div>
    </form>
</div>
@endsection
