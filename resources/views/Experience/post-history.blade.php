@extends('layouts.master')

@section('content')
<div class="container">
    <h3>All Submitted Posts</h3>

    <a href="{{ route('admin.dashboard'). '#mobility' }}" class="btn btn-outline-primary mb-3" style="font-size: 20px">
        &laquo; Back
    </a>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Submitted At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>
                        <span class="badge bg-{{ $post->status == 'pending' ? 'warning' : ($post->status == 'Approve' ? 'success' : 'danger') }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </td>
                    <td>{{ $post->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
