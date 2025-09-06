@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Portfolio: {{ $portfolio->name }}</h1>
    <p><strong>Age:</strong> {{ $portfolio->age }}</p>

    <h4>Experiences</h4>
    <ul>
        @foreach($portfolio->experiences as $exp)
            <li><strong>{{ $exp->title }}</strong> – {{ $exp->description }}</li>
        @endforeach
    </ul>

    <h4>Skills</h4>
    <ul>
        @foreach($portfolio->skills as $skill)
            <li>{{ $skill->name }}</li>
        @endforeach
    </ul>

    <h4>Qualifications</h4>
    <ul>
        @foreach($portfolio->qualifications as $q)
            <li><strong>{{ $q->title }}</strong> – {{ $q->institution }}</li>
        @endforeach
    </ul>

    <h4>Contacts</h4>
    <ul>
        @foreach($portfolio->contacts as $c)
            <li><strong>{{ $c->type }}</strong>: {{ $c->detail }}</li>
        @endforeach
    </ul>

    <div class="mt-3">
        <a href="{{ route('portfolios.edit', $portfolio) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('portfolio.destroy', $portfolio->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete shadow-sm">Delete</button>
        </form>
        <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="btn btn-gradient shadow-sm">Edit</a>
        
    </div>
</div>
@endsection
