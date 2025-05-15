@extends('layouts.master')

@section('content')
<div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Add FAQ</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('faq.index') }}">FAQ</a></li>
                            <li class="breadcrumb-item active">Manage</li>
                            <li class="breadcrumb-item active">Add</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('faq.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="question" class="form-label">Question</label>
                <input type="text" class="form-control" id="question" name="question" required>
            </div>

            <div class="mb-3">
                <label for="answer" class="form-label">Answer</label>
                <textarea class="form-control" id="answer" name="answer" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" class="form-control" required>
                    <option value="">-- Select Category --</option>
                    <option value="Eligibility">Eligibility</option>
                    <option value="Application">Application</option>
                    <option value="Visa">Visa</option>
                    <option value="Funding">Funding</option>
                    <option value="Credit Transfer">Credit Transfer</option>
                    <option value="Accommodation">Accommodation</option>
                    <option value="Support">Support</option>
                    <option value="After Exchange">After Exchange</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Submit FAQ</button>
        </form>



@endsection