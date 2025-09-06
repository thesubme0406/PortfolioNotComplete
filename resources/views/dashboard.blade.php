@extends('layouts.app')

@section('content')
<div class="portfolio-dashboard container py-5">

    {{-- Header --}}
    <div class="dashboard-header d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold mb-1">{{ $portfolio->name ?? Auth::user()->name }}</h1>
        </div>

        @if($portfolio)
            <div class="button-group d-flex gap-2">
                <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="btn btn-gradient shadow-sm">
                    Edit
                </a>

                {{-- Delete Form --}}
                <form action="{{ route('portfolio.destroy', $portfolio->id) }}" method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this portfolio?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete shadow-sm">
                        Delete
                    </button>
                </form>
            </div>
        @else
            <a href="{{ route('portfolio.create') }}" class="btn btn-gradient shadow-sm">
                Create Portfolio
            </a>
        @endif
    </div>

    {{-- Content --}}
    @if($portfolio)

        {{-- Experiences --}}
        <section class="portfolio-section mb-5">
            <h2 class="section-title">Experiences</h2>
            @if($portfolio->experiences->count())
                <div class="card-grid">
                    @foreach($portfolio->experiences as $exp)
                        <div class="info-card p-3 border rounded shadow-sm mb-2">
                            <h5 class="fw-semibold">{{ $exp->title }}</h5>
                            <p class="text-muted mb-0">{{ $exp->description }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="empty-state">No experiences yet.</p>
            @endif
        </section>

        {{-- Skills --}}
        <section class="portfolio-section mb-5">
            <h2 class="section-title">Skills</h2>
            @if($portfolio->skills->count())
                <div class="skills-wrapper d-flex flex-wrap gap-2">
                    @foreach($portfolio->skills as $skill)
                        <span class="skill-badge badge bg-primary">
                            {{ $skill->skill_name }}
                            @if($skill->proficiency_level) 
                                <small>({{ $skill->proficiency_level }})</small>
                            @endif
                        </span>
                    @endforeach
                </div>
            @else
                <p class="empty-state">No skills yet.</p>
            @endif
        </section>

        {{-- Qualifications --}}
        <section class="portfolio-section mb-5">
            <h2 class="section-title">Qualifications</h2>
            @if($portfolio->qualifications->count())
                <ul class="timeline list-unstyled">
                    @foreach($portfolio->qualifications as $q)
                        <li class="mb-2">
                            <span class="fw-semibold">{{ $q->qualification_name }}</span>  
                            <span class="text-muted">
                                - {{ $q->institution }} {{ $q->year ? "($q->year)" : '' }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="empty-state">No qualifications yet.</p>
            @endif
        </section>

        {{-- Contacts --}}
        <section class="portfolio-section mb-5">
            <h2 class="section-title">Contacts</h2>
            @if($portfolio->contacts->count())
                <div class="contact-grid row">
                    @foreach($portfolio->contacts as $c)
                        <div class="contact-card col-md-4 mb-3">
                            <div class="p-3 border rounded shadow-sm h-100">
                                <strong>{{ ucfirst($c->type) }}</strong>
                                <p class="mb-0">{{ $c->value }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="empty-state">No contact info yet.</p>
            @endif
        </section>

    @else
        <div class="alert alert-light text-center rounded-4 shadow-sm p-5">
            <p class="mb-3">You don’t have a portfolio yet.</p>
            <a href="{{ route('portfolio.create') }}" class="btn btn-gradient">
                Create Portfolio
            </a>
        </div>
    @endif
</div>
@endsection
