<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Portfolio;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Qualification;
use App\Models\Contact;

class PortfolioController extends Controller
{
    
    public function create()
    {
        return view('portfolio.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Create portfolio
        $portfolio = Portfolio::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'birthday' => $request->birthday,
            'age' => $request->age,
        ]);

        // Nested items
        if($request->experiences) {
            foreach($request->experiences as $exp){
                $portfolio->experiences()->create($exp);
            }
        }

        if($request->skills) {
            foreach($request->skills as $skill){
                $portfolio->skills()->create($skill);
            }
        }

        if($request->qualifications) {
            foreach($request->qualifications as $q){
                $portfolio->qualifications()->create($q);
            }
        }

        if($request->contacts) {
            foreach($request->contacts as $c){
                $portfolio->contacts()->create($c);
            }
        }

        return redirect()->route('dashboard')->with('success','Portfolio created!');
    }

    public function edit(Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio); // Optional if you use Policies
        return view('portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio); // Optional

        $portfolio->update([
            'name' => $request->name,
            'birthday' => $request->birthday,
            'age' => $request->age,
        ]);

        // Clear old nested items
        $portfolio->experiences()->delete();
        $portfolio->skills()->delete();
        $portfolio->qualifications()->delete();
        $portfolio->contacts()->delete();

        // Add new nested items
        if($request->experiences) {
            foreach($request->experiences as $exp){
                $portfolio->experiences()->create($exp);
            }
        }

        if($request->skills) {
            foreach($request->skills as $skill){
                $portfolio->skills()->create($skill);
            }
        }

        if($request->qualifications) {
            foreach($request->qualifications as $q){
                $portfolio->qualifications()->create($q);
            }
        }

        if($request->contacts) {
            foreach($request->contacts as $c){
                $portfolio->contacts()->create($c);
            }
        }

        return redirect()->route('dashboard')->with('success','Portfolio updated!');
    }

//     public function index()
// {
//     $user = auth()->user();
//     $portfolio = $user->portfolio()->first();

//     if($portfolio){
//         return redirect()->route('portfolio.edit', $portfolio->id);
//     }

//     return redirect()->route('portfolio.create');
// }
public function destroy(Portfolio $portfolio)
{
    $this->authorize('delete', $portfolio); // Optional

    $portfolio->experiences()->delete();
    $portfolio->skills()->delete();
    $portfolio->qualifications()->delete();
    $portfolio->contacts()->delete();
    $portfolio->delete();

    return redirect()->route('dashboard')->with('success', 'Portfolio deleted!');
}

}
