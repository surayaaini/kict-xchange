

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif


@extends('layouts.master')

@section('content')
<div class="container">
    <h1>MOU/MOA List</h1>

    <table class="table">
        <thead>
            <tr>
                <th>University</th>
                <th>Country</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Details</th>
                @if(auth()->user()->role_id == 1)  <!-- Admin Only -->
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($moumoas as $moumoa)
                <tr>
                    <td>{{ $moumoa->university_name }}</td>
                    <td>{{ $moumoa->country }}</td>
                    <td>{{ $moumoa->start_date }}</td>
                    <td>{{ $moumoa->end_date ?? 'N/A' }}</td>
                    <td>{{ $moumoa->details }}</td>

                    @if(auth()->user()->role_id == 1)  <!-- Admin Only -->
                        <td>
                            <a href="{{ route('moumoa.edit', $moumoa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('moumoa.destroy', $moumoa->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    @endif
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
