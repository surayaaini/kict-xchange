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
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </div>


    @foreach ($faqs as $category => $items)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">
                {{ $category }}
            </div>
            <div class="card-body">
                <div class="accordion" id="accordion-{{ Str::slug($category) }}">
                    @foreach ($items as $index => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-{{ $faq->id }}">
                                <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse-{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading-{{ $faq->id }}" data-bs-parent="#accordion-{{ Str::slug($category) }}">
                                <div class="accordion-body">
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
