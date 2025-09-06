@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Portfolio</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('portfolio.update', $portfolio->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Basic Info --}}
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" 
                   value="{{ old('name', $portfolio->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Birthday</label>
            <input type="date" name="birthday" class="form-control" 
                   value="{{ old('birthday', $portfolio->birthday) }}" required>
        </div>

        <div class="mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control" 
                   value="{{ old('age', $portfolio->age) }}" required>
        </div>

        {{-- Experiences --}}
        <h4>Experiences</h4>
        <div id="experiences-wrapper">
            @php $expIndex = 0; @endphp
            @foreach(old('experiences', $portfolio->experiences->toArray()) as $exp)
            <div class="experience-item border rounded p-2 mb-2">
                <input type="text" name="experiences[{{ $expIndex }}][title]" 
                       class="form-control mb-1" placeholder="Title" 
                       value="{{ $exp['title'] ?? '' }}">
                <textarea name="experiences[{{ $expIndex }}][description]" 
                          class="form-control mb-1" placeholder="Description">{{ $exp['description'] ?? '' }}</textarea>
                <button type="button" class="btn btn-danger btn-sm remove-experience">Remove</button>
            </div>
            @php $expIndex++; @endphp
            @endforeach
        </div>
        <button type="button" id="add-experience" class="btn btn-secondary mb-3">Add Experience</button>

        {{-- Skills --}}
        <h4>Skills</h4>
        <div id="skills-wrapper">
            @php $skillIndex = 0; @endphp
            @foreach(old('skills', $portfolio->skills->toArray()) as $skill)
            <div class="skill-item border rounded p-2 mb-2">
                <input type="text" name="skills[{{ $skillIndex }}][skill_name]" 
                       class="form-control mb-1" placeholder="Skill" 
                       value="{{ $skill['skill_name'] ?? '' }}">
                <input type="text" name="skills[{{ $skillIndex }}][proficiency_level]" 
                       class="form-control mb-1" placeholder="Proficiency" 
                       value="{{ $skill['proficiency_level'] ?? '' }}">
                <button type="button" class="btn btn-danger btn-sm remove-skill">Remove</button>
            </div>
            @php $skillIndex++; @endphp
            @endforeach
        </div>
        <button type="button" id="add-skill" class="btn btn-secondary mb-3">Add Skill</button>

        {{-- Qualifications --}}
        <h4>Qualifications</h4>
        <div id="qualifications-wrapper">
            @php $qualIndex = 0; @endphp
            @foreach(old('qualifications', $portfolio->qualifications->toArray()) as $q)
            <div class="qualification-item border rounded p-2 mb-2">
                <input type="text" name="qualifications[{{ $qualIndex }}][qualification_name]" 
                       class="form-control mb-1" placeholder="Qualification" 
                       value="{{ $q['qualification_name'] ?? '' }}">
                <input type="text" name="qualifications[{{ $qualIndex }}][institution]" 
                       class="form-control mb-1" placeholder="Institution" 
                       value="{{ $q['institution'] ?? '' }}">
                <input type="text" name="qualifications[{{ $qualIndex }}][year]" 
                       class="form-control mb-1" placeholder="Year" 
                       value="{{ $q['year'] ?? '' }}">
                <button type="button" class="btn btn-danger btn-sm remove-qualification">Remove</button>
            </div>
            @php $qualIndex++; @endphp
            @endforeach
        </div>
        <button type="button" id="add-qualification" class="btn btn-secondary mb-3">Add Qualification</button>

        {{-- Contacts --}}
        <h4>Contacts</h4>
        <div id="contacts-wrapper">
            @php $contactIndex = 0; @endphp
            @foreach(old('contacts', $portfolio->contacts->toArray()) as $c)
            <div class="contact-item border rounded p-2 mb-2">
                <input type="text" name="contacts[{{ $contactIndex }}][type]" 
                       class="form-control mb-1" placeholder="Type" 
                       value="{{ $c['type'] ?? '' }}">
                <input type="text" name="contacts[{{ $contactIndex }}][value]" 
                       class="form-control mb-1" placeholder="Value" 
                       value="{{ $c['value'] ?? '' }}">
                <button type="button" class="btn btn-danger btn-sm remove-contact">Remove</button>
            </div>
            @php $contactIndex++; @endphp
            @endforeach
        </div>
        <button type="button" id="add-contact" class="btn btn-secondary mb-3">Add Contact</button>

        <button type="submit" class="btn btn-primary">Update Portfolio</button>
    </form>
</div>

<script>
document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove-experience')) e.target.closest('.experience-item').remove();
    if(e.target.classList.contains('remove-skill')) e.target.closest('.skill-item').remove();
    if(e.target.classList.contains('remove-qualification')) e.target.closest('.qualification-item').remove();
    if(e.target.classList.contains('remove-contact')) e.target.closest('.contact-item').remove();
});

let expIndex = {{ $expIndex }};
document.getElementById('add-experience').addEventListener('click', function(){
    let div = document.createElement('div');
    div.classList.add('experience-item','border','rounded','p-2','mb-2');
    div.innerHTML = `
        <input type="text" name="experiences[${expIndex}][title]" class="form-control mb-1" placeholder="Title">
        <textarea name="experiences[${expIndex}][description]" class="form-control mb-1" placeholder="Description"></textarea>
        <button type="button" class="btn btn-danger btn-sm remove-experience">Remove</button>
    `;
    document.getElementById('experiences-wrapper').appendChild(div);
    expIndex++;
});

let skillIndex = {{ $skillIndex }};
document.getElementById('add-skill').addEventListener('click', function(){
    let div = document.createElement('div');
    div.classList.add('skill-item','border','rounded','p-2','mb-2');
    div.innerHTML = `
        <input type="text" name="skills[${skillIndex}][skill_name]" class="form-control mb-1" placeholder="Skill">
        <input type="text" name="skills[${skillIndex}][proficiency_level]" class="form-control mb-1" placeholder="Proficiency">
        <button type="button" class="btn btn-danger btn-sm remove-skill">Remove</button>
    `;
    document.getElementById('skills-wrapper').appendChild(div);
    skillIndex++;
});

let qualIndex = {{ $qualIndex }};
document.getElementById('add-qualification').addEventListener('click', function(){
    let div = document.createElement('div');
    div.classList.add('qualification-item','border','rounded','p-2','mb-2');
    div.innerHTML = `
        <input type="text" name="qualifications[${qualIndex}][qualification_name]" class="form-control mb-1" placeholder="Qualification">
        <input type="text" name="qualifications[${qualIndex}][institution]" class="form-control mb-1" placeholder="Institution">
        <input type="text" name="qualifications[${qualIndex}][year]" class="form-control mb-1" placeholder="Year">
        <button type="button" class="btn btn-danger btn-sm remove-qualification">Remove</button>
    `;
    document.getElementById('qualifications-wrapper').appendChild(div);
    qualIndex++;
});

let contactIndex = {{ $contactIndex }};
document.getElementById('add-contact').addEventListener('click', function(){
    let div = document.createElement('div');
    div.classList.add('contact-item','border','rounded','p-2','mb-2');
    div.innerHTML = `
        <input type="text" name="contacts[${contactIndex}][type]" class="form-control mb-1" placeholder="Type">
        <input type="text" name="contacts[${contactIndex}][value]" class="form-control mb-1" placeholder="Value">
        <button type="button" class="btn btn-danger btn-sm remove-contact">Remove</button>
    `;
    document.getElementById('contacts-wrapper').appendChild(div);
    contactIndex++;
});
</script>
@endsection
