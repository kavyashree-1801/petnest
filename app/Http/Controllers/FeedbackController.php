<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::latest()->get();
        return view('feedback', compact('feedbacks'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'rating' => 'required',
            'message' => 'required',
        ]);

        Feedback::create($request->all());

        return redirect()->route('feedback')->with('success', 'Feedback submitted!');
    }
}