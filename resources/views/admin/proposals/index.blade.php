@extends('layouts.master')

@section('content')
<div class="content container-fluid">

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
                    <h3 class="page-title">Mobility Proposals</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Proposals</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Proposals Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Submitted By</th>
                            <th>Partner University</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($proposals as $index => $proposal)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $proposal->submitted_by_name }}</td>
                            <td>{{ $proposal->partner_university }}</td>
                            <td>{{ $proposal->start_date }}</td>
                            <td>{{ $proposal->end_date }}</td>
                            <td>
                                <span class="badge
                                    {{ $proposal->status == 'Pending' ? 'bg-warning text-dark' : ($proposal->status == 'Approved' ? 'bg-success' : 'bg-danger') }}">
                                    {{ $proposal->status }}
                                </span>

                            </td>
                            <td class="text-end d-flex justify-content-end gap-2 flex-wrap">
                                <!-- View Button -->
                                <a href="{{ route('admin.proposals.show', $proposal->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>

                                <!-- Approve Button -->
                                <form action="{{ route('admin.proposals.approve', $proposal->id) }}" method="POST" onsubmit="confirmApprove(event, this)">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Approve</button>
                                </form>

                                <!-- Reject Button -->
                                <form action="{{ route('admin.proposals.reject', $proposal->id) }}" method="POST" onsubmit="confirmReject(event, this)">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Reject</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No proposals found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- JS Confirmation Dialogs -->
<script>
function confirmApprove() {
    return confirm('Are you sure you want to APPROVE this proposal?');
}

function confirmReject() {
    return confirm('Are you sure you want to REJECT this proposal?');
}
</script>
@endsection
