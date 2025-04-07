@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h3>Manage FAQs</h3>
    <a href="{{ route('faq.index') }}" class="btn btn-secondary mb-3">Back to FAQ View</a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Question</th>
                <th>Category</th>
                <th>Last Updated</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faqs as $index => $faq)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $faq->question }}</td>
                <td>{{ $faq->category }}</td>
                <td>{{ $faq->updated_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this FAQ?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
