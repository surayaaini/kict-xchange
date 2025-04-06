@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following errors:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Edit MOU/MOA List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">MOU/MOA List</li>
                        <li class="breadcrumb-item active">Edit</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('moumoa.update', $moumoa->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to update this entry?')">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="collaborator" class="form-label">Name of Collaborator</label>
            <input type="text" class="form-control" name="collaborator" value="{{ old('collaborator', $moumoa->collaborator) }}" required>
        </div>


        <div class="mb-3">
            <label for="signed_date" class="form-label">Signed Date</label>
            <input type="date" name="signed_date" value="{{ $moumoa->signed_date }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="expiry_date" class="form-label">Expiry Date</label>
            <input type="date" name="expiry_date" value="{{ $moumoa->expiry_date }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="focal_person" class="form-label">Focal Person</label>
            <input type="text" name="focal_person" value="{{ $moumoa->focal_person }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type (MoU / MoA)</label>
            <select name="type" class="form-control" required>
                <option value="MoU" {{ $moumoa->type == 'MoU' ? 'selected' : '' }}>MoU</option>
                <option value="MoA" {{ $moumoa->type == 'MoA' ? 'selected' : '' }}>MoA</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="impact" class="form-label">Impact</label>
            <select class="form-select" name="impact" required>
                <option value="">Select impact</option>
                <option value="Medical – Research Collaboration" {{ $moumoa->impact == 'Medical – Research Collaboration' ? 'selected' : '' }}>Medical – Research Collaboration</option>
                <option value="General - Research Collaboration and Teaching & Learning" {{ $moumoa->impact == 'General - Research Collaboration and Teaching & Learning' ? 'selected' : '' }}>General - Research Collaboration and Teaching & Learning</option>
                <option value="Esport – Teaching & Learning" {{ $moumoa->impact == 'Esport – Teaching & Learning' ? 'selected' : '' }}>Esport – Teaching & Learning</option>
                <option value="General – Teaching & Learning" {{ $moumoa->impact == 'General – Teaching & Learning' ? 'selected' : '' }}>General – Teaching & Learning</option>
                <option value="Health, Environment, Engineering trades, any other areas of cooperation – Research Collaboration and Teaching & Learning" {{ $moumoa->impact == 'Health, Environment, Engineering trades, any other areas of cooperation – Research Collaboration and Teaching & Learning' ? 'selected' : '' }}>Health, Environment, Engineering trades, any other areas of cooperation – Research Collaboration and Teaching & Learning</option>
                <option value="Biometric-Computer-on-Card – Research Collaboration" {{ $moumoa->impact == 'Biometric-Computer-on-Card – Research Collaboration' ? 'selected' : '' }}>Biometric-Computer-on-Card – Research Collaboration</option>
                <option value="Others" {{ $moumoa->impact == 'Others' ? 'selected' : '' }}>Others</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Entry</button>
        <a href="{{ route('moumoa.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
