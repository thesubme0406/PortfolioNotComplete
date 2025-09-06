@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Portfolio</h1>

    <form action="{{ route('portfolio.update', $portfolio->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Basic Info --}}
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $portfolio->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Birthday</label>
            <input type="date" name="birthday" class="form-control" value="{{ old('birthday', $portfolio->birthday) }}" required>
        </div>

        <div class="mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control" value="{{ old('age', $portfolio->age) }}" required>
        </div>

        {{-- Experiences --}}
        <h4>Experiences</h4>
        <div id="experiences-wrapper">
            @foreach($portfolio->experiences as $i => $exp)
            <div class="experience-item mb-2">
                <input type="text" name="experiences[{{ $i }}][title]" value="{{ $exp->title }}" class="form-control mb-1">
                <textarea name="experiences[{{ $i }}][description]" class="form-control mb-1">{{ $exp->description }}</textarea>
                <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
            </div>
            @endforeach
        </div>
        <button type="button" id="add-experience" class="btn btn-secondary mb-3">Add Experience</button>

        {{-- Skills --}}
        <h4>Skills</h4>
        <div id="skills-wrapper">
            @foreach($portfolio->skills as $i => $skill)
            <div class="skill-item mb-2">
                <input type="text" name="skills[{{ $i }}][name]" value="{{ $skill->name }}" class="form-control mb-1">
                <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
            </div>
            @endforeach
        </div>
        <button type="button" id="add-skill" class="btn btn-secondary mb-3">Add Skill</button>

        {{-- Qualifications --}}
        <h4>Qualifications</h4>
        <div id="qualifications-wrapper">
            @foreach($portfolio->qualifications as $i => $q)
            <div class="qualification-item mb-2">
                <input type="text" name="qualifications[{{ $i }}][title]" value="{{ $q->title }}" class="form-control mb-1">
                <textarea name="qualifications[{{ $i }}][institution]" class="form-control mb-1">{{ $q->institution }}</textarea>
                <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
            </div>
            @endforeach
        </div>
        <button type="button" id="add-qualification" class="btn btn-secondary mb-3">Add Qualification</button>

        {{-- Contacts --}}
        <h4>Contacts</h4>
        <div id="contacts-wrapper">
            @foreach($portfolio->contacts as $i => $c)
            <div class="contact-item mb-2">
                <input type="text" name="contacts[{{ $i }}][type]" value="{{ $c->type }}" class="form-control mb-1">
                <input type="text" name="contacts[{{ $i }}][detail]" value="{{ $c->detail }}" class="form-control mb-1">
                <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
            </div>
            @endforeach
        </div>
        <button type="button" id="add-contact" class="btn btn-secondary mb-3">Add Contact</button>

        <button type="submit" class="btn btn-primary">Update Portfolio</button>
    </form>
</div>

<script>
let expCount = {{ $portfolio->experiences->count() }};
let skillCount = {{ $portfolio->skills->count() }};
let qualCount = {{ $portfolio->qualifications->count() }};
let contactCount = {{ $portfolio->contacts->count() }};

// Add Experience
document.getElementById('add-experience').addEventListener('click', () => {
    const wrapper = document.getElementById('experiences-wrapper');
    const div = document.createElement('div');
    div.classList.add('experience-item','mb-2');
    div.innerHTML = `
        <input type="text" name="experiences[${expCount}][title]" class="form-control mb-1" placeholder="Title">
        <textarea name="experiences[${expCount}][description]" class="form-control mb-1" placeholder="Description"></textarea>
        <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
    `;
    wrapper.appendChild(div);
    expCount++;
});

// Add Skill
document.getElementById('add-skill').addEventListener('click', () => {
    const wrapper = document.getElementById('skills-wrapper');
    const div = document.createElement('div');
    div.classList.add('skill-item','mb-2');
    div.innerHTML = `
        <input type="text" name="skills[${skillCount}][name]" class="form-control mb-1" placeholder="Skill">
        <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
    `;
    wrapper.appendChild(div);
    skillCount++;
});

// Add Qualification
document.getElementById('add-qualification').addEventListener('click', () => {
    const wrapper = document.getElementById('qualifications-wrapper');
    const div = document.createElement('div');
    div.classList.add('qualification-item','mb-2');
    div.innerHTML = `
        <input type="text" name="qualifications[${qualCount}][title]" class="form-control mb-1" placeholder="Title">
        <textarea name="qualifications[${qualCount}][institution]" class="form-control mb-1" placeholder="Institution"></textarea>
        <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
    `;
    wrapper.appendChild(div);
    qualCount++;
});

// Add Contact
document.getElementById('add-contact').addEventListener('click', () => {
    const wrapper = document.getElementById('contacts-wrapper');
    const div = document.createElement('div');
    div.classList.add('contact-item','mb-2');
    div.innerHTML = `
        <input type="text" name="contacts[${contactCount}][type]" class="form-control mb-1" placeholder="Type">
        <input type="text" name="contacts[${contactCount}][detail]" class="form-control mb-1" placeholder="Detail">
        <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
    `;
    wrapper.appendChild(div);
    contactCount++;
});

// Remove any item
document.addEventListener('click', e => {
    if(e.target.classList.contains('remove-item')) e.target.closest('div').remove();
});
</script>
@endsection
