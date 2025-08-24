@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    @if($portfolio)
        <h2>{{ $portfolio->name }}'s Portfolio</h2>

        {{-- Experiences --}}
        <h4>Experiences</h4>
        @if($portfolio->experiences->count())
            <ul>
            @foreach($portfolio->experiences as $exp)
                <li><strong>{{ $exp->title }}</strong> - {{ $exp->description }}</li>
            @endforeach
            </ul>
        @else
            <p>No experiences yet.</p>
        @endif

        {{-- Skills --}}
        <h4>Skills</h4>
        @if($portfolio->skills->count())
            <ul>
            @foreach($portfolio->skills as $skill)
                <li>{{ $skill->skill_name }} @if($skill->proficiency_level) ({{ $skill->proficiency_level }}) @endif</li>
            @endforeach
            </ul>
        @else
            <p>No skills yet.</p>
        @endif

        {{-- Qualifications --}}
        <h4>Qualifications</h4>
        @if($portfolio->qualifications->count())
            <ul>
            @foreach($portfolio->qualifications as $q)
                <li>{{ $q->qualification_name }} @if($q->institution) - {{ $q->institution }} @endif @if($q->year) ({{ $q->year }}) @endif</li>
            @endforeach
            </ul>
        @else
            <p>No qualifications yet.</p>
        @endif

        {{-- Contacts --}}
        <h4>Contacts</h4>
        @if($portfolio->contacts->count())
            <ul>
            @foreach($portfolio->contacts as $c)
                <li>{{ $c->type }}: {{ $c->value }}</li>
            @endforeach
            </ul>
        @else
            <p>No contact info yet.</p>
        @endif

        <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="btn btn-primary mt-3">Edit Portfolio</a>

    @else
        <p>You don’t have a portfolio yet.</p>
        <a href="{{ route('portfolio.create') }}" class="btn btn-success">Create Portfolio</a>
    @endif
</div>
@endsection
