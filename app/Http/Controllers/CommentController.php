<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    //

    public function index(Recommendation $recommendation)
    {
        $comments = $recommendation->comments()->with('user')->orderBy('created_at', 'desc')->paginate(10)->get();
        return $comments;
    }

    public function store(Recommendation $recommendation, Request $request)
    {
        $validated = $request->validate(
            [
                'content' => ['required', 'max:400', 'min:3'],
            ]
        );

        $recommendation->comments()->create([
            'content' => $validated['content'],
            'user_id' => Auth::id()
        ]);


        return redirect()->route('recommendation.show', $recommendation);
    }

    public function destroy(Recommendation $recommendation,  Comment $comment)
    {
        $comment->delete();
        return redirect()->route('recommendation.show',  $recommendation)->with('success', 'Comment has been deleted');
    }
}
