@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">MOU/MOA List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">MOU/MOA List</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No.</th>
                <th>Collaborator</th>
                <th>Signed Date</th>
                <th>Expiry Date</th>
                <th>Focal Person</th>
                <th>MoU/MoA</th>
                <th>Impact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($moumoas as $index => $moumoa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $moumoa->collaborator }}</td>
                    <td>{{ $moumoa->signed_date }}</td>
                    <td>{{ $moumoa->expiry_date }}</td>
                    <td>{{ $moumoa->focal_person }}</td>
                    <td>{{ $moumoa->type }}</td>
                    <td>{{ $moumoa->impact }}</td>
                    <td>
                        @if(auth()->user()->role_id == 1)
                            <a href="{{ route('moumoa.edit', $moumoa->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Delete Button triggers modal -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $moumoa->id }}">
                                Delete
                            </button>
                        @endif
                    </td>
                </tr>

                <!-- Delete Confirmation Modal (outside of <tr>) -->
                @if(auth()->user()->role_id == 1)
                    <div class="modal fade" id="deleteModal{{ $moumoa->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $moumoa->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deleteModalLabel{{ $moumoa->id }}">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this MOU/MOA entry for <strong>{{ $moumoa->collaborator }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('moumoa.destroy', $moumoa->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </tbody>
    </table>

    <!-- ➕ Add Button (Only for Admin) -->
    @if(auth()->user()->role_id == 1)
        <a href="{{ route('moumoa.create') }}" class="btn btn-primary mt-3">Add MOU/MOA</a>
    @endif

    <br>
    <br>

</div>
@endsection
