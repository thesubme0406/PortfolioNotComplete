@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $portfolio->name ?? 'Your Portfolio' }}</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($portfolio)
    <p><strong>Birthday:</strong> {{ $portfolio->birthday }}</p>
    <p><strong>Age:</strong> {{ $portfolio->age }}</p>

    <h2>Experiences</h2>
    <ul>
        @foreach($portfolio->experiences as $exp)
            <li>{{ $exp->title }} - {{ $exp->description }}</li>
        @endforeach
    </ul>

    <h2>Skills</h2>
    <ul>
        @foreach($portfolio->skills as $skill)
            <li>{{ $skill->skill_name }} - {{ $skill->proficiency_level }}</li>
        @endforeach
    </ul>

    <h2>Qualifications</h2>
    <ul>
        @foreach($portfolio->qualifications as $q)
            <li>{{ $q->qualification_name }} - {{ $q->institution }} - {{ $q->year }}</li>
        @endforeach
    </ul>

    <h2>Contacts</h2>
    <ul>
        @foreach($portfolio->contacts as $c)
            <li>{{ $c->type }}: {{ $c->value }}</li>
        @endforeach
    </ul>

    <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="btn btn-primary">Edit Portfolio</a>
    <form action="{{ route('portfolio.destroy', $portfolio->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" onclick="return confirm('Delete portfolio?')">Delete Portfolio</button>
    </form>

    @else
        <p>You don't have a portfolio yet.</p>
        <a href="{{ route('portfolio.create') }}" class="btn btn-success">Create Portfolio</a>
    @endif
</div>
@endsection
