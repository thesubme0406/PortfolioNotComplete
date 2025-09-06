<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    // CREATE (show form)
    public function create()
    {
        return view('portfolio.create');
    }

    // STORE (save new portfolio)
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'birthday'  => 'required|date',
            'age'       => 'required|integer',
            'experiences.*.title'       => 'nullable|string',
            'experiences.*.description' => 'nullable|string',
            'skills.*.name'             => 'nullable|string',
            'skills.*.proficiency_level'=> 'nullable|string',
            'qualifications.*.title'    => 'nullable|string',
            'qualifications.*.institution'=> 'nullable|string',
            'qualifications.*.year'     => 'nullable|string',
            'contacts.*.type'           => 'nullable|string',
            'contacts.*.detail'         => 'nullable|string',
        ]);

        $user = Auth::user();

        // Create Portfolio
        $portfolio = $user->portfolio()->create([
            'name'     => $data['name'],
            'birthday' => $data['birthday'],
            'age'      => $data['age'],
        ]);

        // Experiences
        $experiences = collect($data['experiences'] ?? [])
            ->filter(fn($exp) => !empty($exp['title']))
            ->values()
            ->all();
        if (!empty($experiences)) {
            $portfolio->experiences()->createMany($experiences);
        }

        // Skills
        $skills = collect($data['skills'] ?? [])
            ->filter(fn($s) => !empty($s['name']))
            ->map(fn($s) => [
                'skill_name'        => $s['name'],
                'proficiency_level' => $s['proficiency_level'] ?? null
            ])
            ->values()
            ->all();
        if (!empty($skills)) {
            $portfolio->skills()->createMany($skills);
        }

        // Qualifications
        $qualifications = collect($data['qualifications'] ?? [])
            ->filter(fn($q) => !empty($q['title']))
            ->map(fn($q) => [
                'qualification_name' => $q['title'],
                'institution'        => $q['institution'] ?? null,
                'year'               => $q['year'] ?? null
            ])
            ->values()
            ->all();
        if (!empty($qualifications)) {
            $portfolio->qualifications()->createMany($qualifications);
        }

        // Contacts
        $contacts = collect($data['contacts'] ?? [])
            ->filter(fn($c) => !empty($c['type']) && !empty($c['detail']))
            ->map(fn($c) => [
                'type'   => $c['type'],
                'value'  => $c['detail']
            ])
            ->values()
            ->all();
        if (!empty($contacts)) {
            $portfolio->contacts()->createMany($contacts);
        }

        return redirect()->route('dashboard')->with('success', 'Portfolio created successfully!');
    }

    // EDIT (show form)
    public function edit(Portfolio $portfolio)
    {
        return view('portfolio.edit', compact('portfolio'));
    }

    // UPDATE (save changes)
    public function update(Request $request, Portfolio $portfolio)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'birthday'  => 'required|date',
            'age'       => 'required|integer',
            'experiences.*.title'       => 'nullable|string',
            'experiences.*.description' => 'nullable|string',
            'skills.*.name'             => 'nullable|string',
            'skills.*.proficiency_level'=> 'nullable|string',
            'qualifications.*.title'    => 'nullable|string',
            'qualifications.*.institution'=> 'nullable|string',
            'qualifications.*.year'     => 'nullable|string',
            'contacts.*.type'           => 'nullable|string',
            'contacts.*.detail'         => 'nullable|string',
        ]);

        // Update basic portfolio info
        $portfolio->update([
            'name'     => $data['name'],
            'birthday' => $data['birthday'],
            'age'      => $data['age'],
        ]);

        // Delete old nested items
        $portfolio->experiences()->delete();
        $portfolio->skills()->delete();
        $portfolio->qualifications()->delete();
        $portfolio->contacts()->delete();

        // Recreate nested items (same as store)
        if (!empty($data['experiences'])) {
            $experiences = collect($data['experiences'])
                ->filter(fn($exp) => !empty($exp['title']))
                ->values()
                ->all();
            $portfolio->experiences()->createMany($experiences);
        }

        if (!empty($data['skills'])) {
            $skills = collect($data['skills'])
                ->filter(fn($s) => !empty($s['name']))
                ->map(fn($s) => [
                    'skill_name'        => $s['name'],
                    'proficiency_level' => $s['proficiency_level'] ?? null
                ])
                ->values()
                ->all();
            $portfolio->skills()->createMany($skills);
        }

        if (!empty($data['qualifications'])) {
            $qualifications = collect($data['qualifications'])
                ->filter(fn($q) => !empty($q['title']))
                ->map(fn($q) => [
                    'qualification_name' => $q['title'],
                    'institution'        => $q['institution'] ?? null,
                    'year'               => $q['year'] ?? null
                ])
                ->values()
                ->all();
            $portfolio->qualifications()->createMany($qualifications);
        }

        if (!empty($data['contacts'])) {
            $contacts = collect($data['contacts'])
                ->filter(fn($c) => !empty($c['type']) && !empty($c['detail']))
                ->map(fn($c) => [
                    'type'   => $c['type'],
                    'value'  => $c['detail']
                ])
                ->values()
                ->all();
            $portfolio->contacts()->createMany($contacts);
        }

        return redirect()->route('dashboard')->with('success', 'Portfolio updated successfully!');
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