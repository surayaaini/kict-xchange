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

    <div class="mb-3">
        <form action="{{ route('faq.index') }}" method="GET" class="d-flex" role="search">
            <input
                type="search"
                name="search"
                class="form-control me-2"
                placeholder="Search FAQs..."
                value="{{ request('search') }}"
            >
            <button class="btn btn-primary me-2" type="submit">Search</button>

            @if(auth()->user()->role_id === 1)
            <a href="{{ route('faq.admin') }}" class="btn btn-outline-secondary">Manage FAQs</a>
            @endif
        </form>
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
