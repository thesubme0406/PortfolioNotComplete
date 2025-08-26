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

        {{-- Basic Portfolio Info --}}
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $portfolio->name }}" required>
        </div>

        <div class="mb-3">
            <label>Birthday</label>
            <input type="date" name="birthday" class="form-control" value="{{ $portfolio->birthday }}" required>
        </div>

        <div class="mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control" value="{{ $portfolio->age }}" required>
        </div>

        {{-- Experiences --}}
        <h4>Experiences</h4>
        <div id="experiences-wrapper">
            @foreach($portfolio->experiences as $i => $exp)
            <div class="experience-item mb-2">
                <input type="text" name="experiences[{{ $i }}][title]" value="{{ $exp->title }}" class="form-control mb-1" placeholder="Title">
                <textarea name="experiences[{{ $i }}][description]" class="form-control mb-1" placeholder="Description">{{ $exp->description }}</textarea>
                <button type="button" class="btn btn-danger remove-item">Remove</button>
            </div>
            @endforeach
        </div>
        <button type="button" id="add-experience" class="btn btn-secondary mb-3">Add Experience</button>

        {{-- Skills --}}
        <h4>Skills</h4>
        <div id="skills-wrapper">
            @foreach($portfolio->skills as $i => $skill)
            <div class="skill-item mb-2">
                <input type="text" name="skills[{{ $i }}][skill_name]" value="{{ $skill->skill_name }}" class="form-control mb-1" placeholder="Skill">
                <input type="text" name="skills[{{ $i }}][proficiency_level]" value="{{ $skill->proficiency_level }}" class="form-control mb-1" placeholder="Proficiency">
                <button type="button" class="btn btn-danger remove-item">Remove</button>
            </div>
            @endforeach
        </div>
        <button type="button" id="add-skill" class="btn btn-secondary mb-3">Add Skill</button>

        {{-- Qualifications --}}
        <h4>Qualifications</h4>
        <div id="qualifications-wrapper">
            @foreach($portfolio->qualifications as $i => $q)
            <div class="qualification-item mb-2">
                <input type="text" name="qualifications[{{ $i }}][qualification_name]" value="{{ $q->qualification_name }}" class="form-control mb-1" placeholder="Qualification">
                <input type="text" name="qualifications[{{ $i }}][institution]" value="{{ $q->institution }}" class="form-control mb-1" placeholder="Institution">
                <input type="text" name="qualifications[{{ $i }}][year]" value="{{ $q->year }}" class="form-control mb-1" placeholder="Year">
                <button type="button" class="btn btn-danger remove-item">Remove</button>
            </div>
            @endforeach
        </div>
        <button type="button" id="add-qualification" class="btn btn-secondary mb-3">Add Qualification</button>

        {{-- Contacts --}}
        <h4>Contacts</h4>
        <div id="contacts-wrapper">
            @foreach($portfolio->contacts as $i => $c)
            <div class="contact-item mb-2">
                <input type="text" name="contacts[{{ $i }}][type]" value="{{ $c->type }}" class="form-control mb-1" placeholder="Type">
                <input type="text" name="contacts[{{ $i }}][value]" value="{{ $c->value }}" class="form-control mb-1" placeholder="Value">
                <button type="button" class="btn btn-danger remove-item">Remove</button>
            </div>
            @endforeach
        </div>
        <button type="button" id="add-contact" class="btn btn-secondary mb-3">Add Contact</button>

        <button type="submit" class="btn btn-primary">Update Portfolio</button>
    </form>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    function attachRemoveButtons() {
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.onclick = function() {
                this.parentElement.remove();
            };
        });
    }

    attachRemoveButtons();

    // Experiences
    let expIndex = {{ $portfolio->experiences->count() }};
    document.getElementById('add-experience').onclick = function() {
        let wrapper = document.getElementById('experiences-wrapper');
        let div = document.createElement('div');
        div.className = 'experience-item mb-2';
        div.innerHTML = `
            <input type="text" name="experiences[${expIndex}][title]" class="form-control mb-1" placeholder="Title">
            <textarea name="experiences[${expIndex}][description]" class="form-control mb-1" placeholder="Description"></textarea>
            <button type="button" class="btn btn-danger remove-item">Remove</button>
        `;
        wrapper.appendChild(div);
        attachRemoveButtons();
        expIndex++;
    };

    // Skills
    let skillIndex = {{ $portfolio->skills->count() }};
    document.getElementById('add-skill').onclick = function() {
        let wrapper = document.getElementById('skills-wrapper');
        let div = document.createElement('div');
        div.className = 'skill-item mb-2';
        div.innerHTML = `
            <input type="text" name="skills[${skillIndex}][skill_name]" class="form-control mb-1" placeholder="Skill">
            <input type="text" name="skills[${skillIndex}][proficiency_level]" class="form-control mb-1" placeholder="Proficiency">
            <button type="button" class="btn btn-danger remove-item">Remove</button>
        `;
        wrapper.appendChild(div);
        attachRemoveButtons();
        skillIndex++;
    };

    // Qualifications
    let qualIndex = {{ $portfolio->qualifications->count() }};
    document.getElementById('add-qualification').onclick = function() {
        let wrapper = document.getElementById('qualifications-wrapper');
        let div = document.createElement('div');
        div.className = 'qualification-item mb-2';
        div.innerHTML = `
            <input type="text" name="qualifications[${qualIndex}][qualification_name]" class="form-control mb-1" placeholder="Qualification">
            <input type="text" name="qualifications[${qualIndex}][institution]" class="form-control mb-1" placeholder="Institution">
            <input type="text" name="qualifications[${qualIndex}][year]" class="form-control mb-1" placeholder="Year">
            <button type="button" class="btn btn-danger remove-item">Remove</button>
        `;
        wrapper.appendChild(div);
        attachRemoveButtons();
        qualIndex++;
    };

    // Contacts
    let contactIndex = {{ $portfolio->contacts->count() }};
    document.getElementById('add-contact').onclick = function() {
        let wrapper = document.getElementById('contacts-wrapper');
        let div = document.createElement('div');
        div.className = 'contact-item mb-2';
        div.innerHTML = `
            <input type="text" name="contacts[${contactIndex}][type]" class="form-control mb-1" placeholder="Type">
            <input type="text" name="contacts[${contactIndex}][value]" class="form-control mb-1" placeholder="Value">
            <button type="button" class="btn btn-danger remove-item">Remove</button>
        `;
        wrapper.appendChild(div);
        attachRemoveButtons();
        contactIndex++;
    };
});
</script>
@endsection
