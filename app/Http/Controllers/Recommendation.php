<?php

namespace App\Http\Controllers;

use App\Models\Recommendation as ModelsRecommendation;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Recommendation extends Controller
{
    //


    public function index()
    {
        $recommendations = ModelsRecommendation::with('user')->orderBy('created_at', 'desc')->get();
        return view('pages.recommendation.index', compact('recommendations'));
    }

    public function show(ModelsRecommendation $recommendation)
    {
        $comments = $recommendation->comments()->with('user')->orderBy('created_at', 'desc')->paginate(5);
        return view('pages.recommendation.show', compact('recommendation', 'comments'));
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('login');
        }
        $validated = $request->validate([
            'description' => ['required', 'min:8', 'string'],
            'title' => ['required', 'min:5', 'string'],
            'rating' => ['integer']
        ]);


        $validated['description'] = fake()->realText();


        $user->recommendations()->create($validated);

        return to_route('recommendations.index')->with('success', 'Recommendation added successfully');
    }

    public function destroy(ModelsRecommendation $recommendation)
    {
        $recommendation->delete();
        return redirect()->route('recommendations.index')->with('success', 'Recommendation has been deleted');
    }
}
