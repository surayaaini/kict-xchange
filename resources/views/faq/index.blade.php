@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">FAQ</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">FAQ</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
            <!-- Search Bar -->
            <form action="{{ route('faq.index') }}" method="GET" class="d-flex flex-grow-1" role="search">
                <input
                    class="form-control form-control-sm me-2 w-50"
                    type="search"
                    name="search"
                    placeholder="Search FAQs..."
                    value="{{ request('search') }}"
                    aria-label="Search"
                >
                <button class="btn btn-outline-primary btn-sm" type="submit">
                    <i class="fas fa-search"></i>
                </button>

                @if(request('search'))
                    <a href="{{ route('faq.index') }}" class="btn btn-outline-secondary btn-sm ms-2">
                        Reset
                    </a>
                @endif
            </form>

            <!-- Feedback Message (optional, below form) -->
            @if(request('search'))
            <div class="alert alert-info mt-2 mb-0 w-100">
                Showing results for "<strong>{{ request('search') }}</strong>"
            </div>
            @endif

            <!-- Manage FAQs Button (Admins only) -->
            @if(auth()->check() && auth()->user()->role_id === 1)
                <a href="{{ route('faq.admin') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-cogs me-1"></i> Manage FAQs
                </a>
            @endif
        </div>
    </div>


    @foreach ($groupedFaqs as $category => $items)
    <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header fw-bold" style="background-color: #0a2647; color: white;">
                {{ $category }}
            </div>
            <div class="card-body bg-white p-3">
                <div class="accordion" id="accordion-{{ Str::slug($category) }}">
                    @foreach ($items as $index => $faq)
                        <div class="accordion-item border mb-3" style="border-color: #e3e6ea;">
                            <h2 class="accordion-header" id="heading-{{ $faq->id }}">
                                <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }} bg-white text-dark fw-normal" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" style="box-shadow: none;">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse-{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading-{{ $faq->id }}" data-bs-parent="#accordion-{{ Str::slug($category) }}">
                                <div class="accordion-body text-muted" style="background-color: #f9f9f9;">
                                    {!! nl2br(e($faq->answer)) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach


</div>
@endsection
