<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $question = Question::with('answers')->first();
        return view('exam', compact('question'));
    }
}
