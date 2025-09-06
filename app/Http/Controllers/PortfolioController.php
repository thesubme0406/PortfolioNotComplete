<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Qualification;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;


class PortfolioController extends Controller
{
    // CREATE (show form)
    public function create()
    {
        return view('portfolio.create');
    }

    // STORE (save new portfolio)
    public function edit(Portfolio $portfolio)
    {
        $portfolio->load(['experiences', 'skills', 'qualifications', 'contacts']);
        return view('portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'birthday' => 'required|date',
        'age' => 'required|integer',
        'experiences.*.title' => 'nullable|string',
        'experiences.*.description' => 'nullable|string',
        'skills.*.skill_name' => 'nullable|string',
        'skills.*.proficiency_level' => 'nullable|string',
        'qualifications.*.qualification_name' => 'nullable|string',
        'qualifications.*.institution' => 'nullable|string',
        'qualifications.*.year' => 'nullable|string',
        'contacts.*.type' => 'nullable|string',
        'contacts.*.value' => 'nullable|string',
    ]);

    // Update portfolio basic info
    $portfolio->update([
        'name' => $data['name'],
        'birthday' => $data['birthday'],
        'age' => $data['age'],
    ]);

    // Delete old related records
    $portfolio->experiences()->delete();
    $portfolio->skills()->delete();
    $portfolio->qualifications()->delete();
    $portfolio->contacts()->delete();

    // Recreate related records
    if (!empty($data['experiences'])) {
        foreach ($data['experiences'] as $exp) {
            if (!empty($exp['title']) || !empty($exp['description'])) {
                $portfolio->experiences()->create($exp);
            }
        }
    }

    if (!empty($data['skills'])) {
        foreach ($data['skills'] as $skill) {
            if (!empty($skill['skill_name'])) {
                $portfolio->skills()->create($skill);
            }
        }
    }

    if (!empty($data['qualifications'])) {
        foreach ($data['qualifications'] as $q) {
            if (!empty($q['qualification_name'])) {
                $portfolio->qualifications()->create($q);
            }
        }
    }

    if (!empty($data['contacts'])) {
        foreach ($data['contacts'] as $c) {
            if (!empty($c['type']) || !empty($c['value'])) {
                $portfolio->contacts()->create($c);
            }
        }
    }

    return redirect()->route('dashboard')->with('success', 'Portfolio updated successfully.');
}


    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'birthday'  => 'required|date',
            'age'       => 'required|integer',
            'experiences.*.title'       => 'nullable|string',
            'experiences.*.description' => 'nullable|string',
            'skills.*.skill_name'       => 'nullable|string',
            'skills.*.proficiency_level'=> 'nullable|string',
            'qualifications.*.qualification_name' => 'nullable|string',
            'qualifications.*.institution'        => 'nullable|string',
            'qualifications.*.year'               => 'nullable|string',
            'contacts.*.type'   => 'nullable|string',
            'contacts.*.value'  => 'nullable|string',
        ]);

        $portfolio = Auth::user()->portfolio()->create([
            'name' => $data['name'],
            'birthday' => $data['birthday'],
            'age' => $data['age'],
        ]);

        if(!empty($data['experiences'])) {
            foreach ($data['experiences'] as $exp) {
                if(!empty($exp['title']) || !empty($exp['description'])){
                    $portfolio->experiences()->create($exp);
                }
            }
        }

        if(!empty($data['skills'])) {
            foreach ($data['skills'] as $skill) {
                if(!empty($skill['skill_name'])) {
                    $portfolio->skills()->create($skill);
                }
            }
        }

        if(!empty($data['qualifications'])) {
            foreach ($data['qualifications'] as $q) {
                if(!empty($q['qualification_name'])) {
                    $portfolio->qualifications()->create($q);
                }
            }
        }

        if(!empty($data['contacts'])) {
            foreach ($data['contacts'] as $c) {
                if(!empty($c['type']) || !empty($c['value'])) {
                    $portfolio->contacts()->create($c);
                }
            }
        }

        return redirect()->route('dashboard')->with('success', 'Portfolio created successfully!');
    }


    // DELETE
    public function destroy(Portfolio $portfolio)
    {
        $portfolio->experiences()->delete();
        $portfolio->skills()->delete();
        $portfolio->qualifications()->delete();
        $portfolio->contacts()->delete();
        $portfolio->delete();

        return redirect()->route('dashboard')->with('success', 'Portfolio deleted successfully!');
    }

} 