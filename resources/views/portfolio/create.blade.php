@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Portfolio</h1>

    <form action="{{ route('portfolio.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Birthday</label>
            <input type="date" name="birthday" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control" required>
        </div>

        {{-- Experiences --}}
        <h4>Experiences</h4>
        <div id="experiences-wrapper">
            <div class="experience-item mb-2">
                <input type="text" name="experiences[0][title]" placeholder="Title" class="form-control mb-1">
                <textarea name="experiences[0][description]" placeholder="Description" class="form-control mb-1"></textarea>
            </div>
        </div>
        <button type="button" id="add-experience" class="btn btn-secondary mb-3">Add Experience</button>

        {{-- Skills --}}
        <h4>Skills</h4>
        <div id="skills-wrapper">
            <div class="skill-item mb-2">
                <input type="text" name="skills[0][skill_name]" placeholder="Skill" class="form-control mb-1">
                <input type="text" name="skills[0][proficiency_level]" placeholder="Proficiency" class="form-control mb-1">
            </div>
        </div>
        <button type="button" id="add-skill" class="btn btn-secondary mb-3">Add Skill</button>

        {{-- Qualifications --}}
        <h4>Qualifications</h4>
        <div id="qualifications-wrapper">
            <div class="qualification-item mb-2">
                <input type="text" name="qualifications[0][qualification_name]" placeholder="Qualification" class="form-control mb-1">
                <input type="text" name="qualifications[0][institution]" placeholder="Institution" class="form-control mb-1">
                <input type="text" name="qualifications[0][year]" placeholder="Year" class="form-control mb-1">
            </div>
        </div>
        <button type="button" id="add-qualification" class="btn btn-secondary mb-3">Add Qualification</button>


        <h4>Contacts</h4>
        <div id="contacts-wrapper">
            <div class="contact-item mb-2">
                <input type="text" name="contacts[0][type]" placeholder="Type (email, phone...)" class="form-control mb-1">
                <input type="text" name="contacts[0][value]" placeholder="Value" class="form-control mb-1">
            </div>
        </div>
        <button type="button" id="add-contact" class="btn btn-secondary mb-3">Add Contact</button>

        <button type="submit" class="btn btn-success">Create Portfolio</button>
    </form>
</div>


<script>
let expCount = 1;
document.getElementById('add-experience').addEventListener('click', () => {
    const wrapper = document.getElementById('experiences-wrapper');
    const div = document.createElement('div');
    div.classList.add('experience-item','mb-2');
    div.innerHTML = `
        <input type="text" name="experiences[${expCount}][title]" placeholder="Title" class="form-control mb-1">
        <textarea name="experiences[${expCount}][description]" placeholder="Description" class="form-control mb-1"></textarea>
    `;
    wrapper.appendChild(div);
    expCount++;
});

let skillCount = 1;
document.getElementById('add-skill').addEventListener('click', () => {
    const wrapper = document.getElementById('skills-wrapper');
    const div = document.createElement('div');
    div.classList.add('skill-item','mb-2');
    div.innerHTML = `
        <input type="text" name="skills[${skillCount}][skill_name]" placeholder="Skill" class="form-control mb-1">
        <input type="text" name="skills[${skillCount}][proficiency_level]" placeholder="Proficiency" class="form-control mb-1">
    `;
    wrapper.appendChild(div);
    skillCount++;
});

let qualCount = 1;
document.getElementById('add-qualification').addEventListener('click', () => {
    const wrapper = document.getElementById('qualifications-wrapper');
    const div = document.createElement('div');
    div.classList.add('qualification-item','mb-2');
    div.innerHTML = `
        <input type="text" name="qualifications[${qualCount}][qualification_name]" placeholder="Qualification" class="form-control mb-1">
        <input type="text" name="qualifications[${qualCount}][institution]" placeholder="Institution" class="form-control mb-1">
        <input type="text" name="qualifications[${qualCount}][year]" placeholder="Year" class="form-control mb-1">
    `;
    wrapper.appendChild(div);
    qualCount++;
});

let contactCount = 1;
document.getElementById('add-contact').addEventListener('click', () => {
    const wrapper = document.getElementById('contacts-wrapper');
    const div = document.createElement('div');
    div.classList.add('contact-item','mb-2');
    div.innerHTML = `
        <input type="text" name="contacts[${contactCount}][type]" placeholder="Type" class="form-control mb-1">
        <input type="text" name="contacts[${contactCount}][value]" placeholder="Value" class="form-control mb-1">
    `;
    wrapper.appendChild(div);
    contactCount++;
});
</script>
@endsection
