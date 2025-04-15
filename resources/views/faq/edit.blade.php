@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Edit FAQ</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('faq.index') }}">FAQ</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="card p-4 shadow-sm">
        <form action="{{ route('faqs.update', $faq->id) }}" method="POST" onsubmit="return confirm('Update this FAQ?')">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category" class="form-select" required>
                    <option value="">Select a category</option>
                    @php
                        $categories = [
                            'Eligibility',
                            'Application',
                            'Visa',
                            'Funding',
                            'Credit Transfer',
                            'Accommodation',
                            'Support',
                            'After Exchange'
                        ];
                    @endphp
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ $faq->category === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="question" class="form-label">Question</label>
                <textarea class="form-control" name="question" rows="2" required>{{ old('question', $faq->question) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="answer" class="form-label">Answer</label>
                <textarea class="form-control" name="answer" rows="5" required>{{ old('answer', $faq->answer) }}</textarea>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('faq.admin') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Update FAQ</button>
            </div>
        </form>
    </div>

</div>
@endsection
