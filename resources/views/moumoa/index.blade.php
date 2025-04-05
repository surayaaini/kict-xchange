

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif


@extends('layouts.master')

@section('content')
<div class="content container-fluid">
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
    <table class="table">
        <thead>
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
                    <td><!-- Edit/Delete buttons here --></td>
                </tr>
            @endforeach
        </tbody>
    </table>


        <!-- Show Add Button only for Admin (Role ID: 1) -->
        @if(auth()->user()->role_id == 1)
        <a href="{{ route('moumoa.create') }}" class="btn btn-primary">Add MOU/MOA</a>
    @endif

</div>
@endsection
