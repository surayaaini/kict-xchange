
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
                        <li class="breadcrumb-item active">Add New</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Add MOU/MOA Form Section -->
    <form method="POST" action="{{ route('moumoa.store') }}">
        @csrf

        <div class="mb-3">
            <label for="collaborator" class="form-label">Name of Collaborator</label>
            <input type="text" class="form-control" name="collaborator" required>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="signed_date" class="form-label">Signed Date</label>
                <input type="date" class="form-control" name="signed_date" required>
            </div>
            <div class="col">
                <label for="expiry_date" class="form-label">Expiry Date</label>
                <input type="date" class="form-control" name="expiry_date">
            </div>
        </div>

        <div class="mb-3">
            <label for="focal_person" class="form-label">Focal Person</label>
            <input type="text" class="form-control" name="focal_person" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">MoU or MoA</label>
            <select class="form-select" name="type" required>
                <option value="">Select type</option>
                <option value="MoU">MoU</option>
                <option value="MoA">MoA</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="impact" class="form-label">Impact</label>
            <select class="form-select" name="impact" required>
                <option value="">Select impact</option>
                <option value="Medical – Research Collaboration">Medical – Research Collaboration</option>
                <option value="General - Research Collaboration and Teaching & Learning">General - Research Collaboration and Teaching & Learning</option>
                <option value="Esport – Teaching & Learning">Esport – Teaching & Learning</option>
                <option value="General – Teaching & Learning">General – Teaching & Learning</option>
                <option value="Health, Environment, Engineering trades, any other areas of cooperation – Research Collaboration and Teaching & Learning">Health, Environment, Engineering trades, any other areas of cooperation – Research Collaboration and Teaching & Learning</option>
                <option value="Biometric-Computer-on-Card – Research Collaboration">Biometric-Computer-on-Card – Research Collaboration</option>
                <option value="Others">Others</option>

            </select>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection
