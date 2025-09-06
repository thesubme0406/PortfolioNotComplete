@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Portfolio</h1>

    <form action="{{ route('portfolio.store') }}" method="POST">
        @csrf

        {{-- Basic Info --}}
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label>Birthday</label>
            <input type="date" name="birthday" class="form-control" value="{{ old('birthday') }}" required>
        </div>

        <div class="mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control" value="{{ old('age') }}" required>
        </div>

        {{-- Experiences --}}
        <h4>Experiences</h4>
        <div id="experiences-wrapper">
            <div class="experience-item mb-2">
                <input type="text" name="experiences[0][title]" class="form-control mb-1" placeholder="Title">
                <textarea name="experiences[0][description]" class="form-control mb-1" placeholder="Description"></textarea>
            </div>
        </div>
        <button type="button" id="add-experience" class="btn btn-secondary mb-3">Add Experience</button>

        {{-- Skills --}}
        <h4>Skills</h4>
        <div id="skills-wrapper">
            <div class="skill-item mb-2">
                <input type="text" name="skills[0][name]" class="form-control mb-1" placeholder="Skill">
            </div>
        </div>
        <button type="button" id="add-skill" class="btn btn-secondary mb-3">Add Skill</button>

        {{-- Qualifications --}}
        <h4>Qualifications</h4>
        <div id="qualifications-wrapper">
            <div class="qualification-item mb-2">
                <input type="text" name="qualifications[0][title]" class="form-control mb-1" placeholder="Title">
                <textarea name="qualifications[0][institution]" class="form-control mb-1" placeholder="Institution"></textarea>
            </div>
        </div>
        <button type="button" id="add-qualification" class="btn btn-secondary mb-3">Add Qualification</button>

        {{-- Contacts --}}
        <h4>Contacts</h4>
        <div id="contacts-wrapper">
            <div class="contact-item mb-2">
                <input type="text" name="contacts[0][type]" class="form-control mb-1" placeholder="Type">
                <input type="text" name="contacts[0][detail]" class="form-control mb-1" placeholder="Detail">
            </div>
        </div>
        <button type="button" id="add-contact" class="btn btn-secondary mb-3">Add Contact</button>

        <button type="submit" class="btn btn-success">Save Portfolio</button>
    </form>
</div>

<script>
let expCount = 1;
let skillCount = 1;
let qualCount = 1;
let contactCount = 1;

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
