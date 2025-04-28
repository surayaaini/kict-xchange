@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">My Mobility Proposals</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Proposals</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Introduction Section -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Submit your Mobility Programme Proposal</h5>
            <p class="card-text">Before a Mobility Programme can be offered to students, a formal proposal must be submitted for DDAI/Admin approval.
            Please ensure that all required information is complete and that the MOU/MOA with the partner univeristy is established beforehand. You may monitor your submissions below.</p>
            <a href="{{ route('proposal.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Submit New Proposal
            </a>
        </div>
    </div>

    <!-- Proposals Table Section -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
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
                                <td>{{ $proposal->partner_university }}</td>
                                <td>{{ \Carbon\Carbon::parse($proposal->start_date)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($proposal->end_date)->format('d M Y') }}</td>
                                <td>
                                     @if($proposal->status == 'Pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($proposal->status == 'Approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($proposal->status == 'Rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-secondary">Unknown</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('proposal.show', $proposal->id) }}" class="btn btn-info btn-sm me-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('proposal.destroy', $proposal->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to withdraw this proposal?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No proposals submitted yet.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>
@endsection
