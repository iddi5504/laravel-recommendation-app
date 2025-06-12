<?php

namespace App\Http\Controllers;

use App\Models\Recommendation as ModelsRecommendation;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Auth\Access\Gate as AccessGate;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Recommendation extends Controller
{


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


    public function edit(Request $request, ModelsRecommendation $recommendation)
    {
        Gate::authorize('update', $recommendation);

        return view('pages.recommendation.edit', compact('recommendation'));
    }


    public function update(Request $request, ModelsRecommendation $recommendation)
    {


        Gate::authorize('update', $recommendation);

        $validated = $request->validate([
            'description' => ['required', 'min:8', 'string'],
            'title' => ['required', 'min:5', 'string'],
            'rating' => ['integer']
        ]);

        $recommendation->update($validated);

        return redirect()->route('recommendation.show', $recommendation)->with('success', 'You have updated a recommendatino');
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
            'imagePath' => ['image'],
            'rating' => ['integer']
        ]);


        $validated['description'] = fake()->realText();

        $imagePath = $validated['imagePath']->store('uploads', 'public');

        $validated['imagePath'] = $imagePath;



        $user->recommendations()->create($validated);

        return to_route('recommendations.index')->with('success', 'Recommendation added successfully');
    }

    public function destroy(Request $request, ModelsRecommendation $recommendation)
    {


        $canDelete = $request->user()->can('delete', $recommendation);

        if (!$canDelete) {
            return redirect()->route('recommendation.show', $recommendation)->with('success', 'User cannot perform this action');
        }



        $recommendation->delete();
        return redirect()->route('recommendations.index')->with('success', 'Recommendation has been deleted');
    }
}
