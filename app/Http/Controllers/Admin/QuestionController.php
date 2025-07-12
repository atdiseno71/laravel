<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'answers.*.text' => 'required|string|max:255',
            'answers.*.is_correct' => 'boolean',
        ]);

        $question = Question::create(['text' => $request->text]);

        foreach ($request->answers as $answerData) {
            $question->answers()->create([
                'text' => $answerData['text'],
                'is_correct' => isset($answerData['is_correct']) ? true : false,
            ]);
        }

        return redirect()->route('admin.questions.index')->with('success', 'Question created successfully.');
    }

    public function edit(Question $question)
    {
        $question->load('answers');
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'answers.*.text' => 'required|string|max:255',
            'answers.*.is_correct' => 'boolean',
        ]);

        $question->update(['text' => $request->text]);

        $existingAnswerIds = $question->answers->pluck('id')->toArray();
        $updatedAnswerIds = [];

        foreach ($request->answers as $answerData) {
            if (isset($answerData['id'])) {
                // Update existing answer
                $answer = $question->answers()->where('id', $answerData['id'])->first();
                if ($answer) {
                    $answer->update([
                        'text' => $answerData['text'],
                        'is_correct' => isset($answerData['is_correct']) ? true : false,
                    ]);
                    $updatedAnswerIds[] = $answer->id;
                }
            } else {
                // Create new answer
                $newAnswer = $question->answers()->create([
                    'text' => $answerData['text'],
                    'is_correct' => isset($answerData['is_correct']) ? true : false,
                ]);
                $updatedAnswerIds[] = $newAnswer->id;
            }
        }

        // Delete answers that were removed from the form
        $answersToDelete = array_diff($existingAnswerIds, $updatedAnswerIds);
        if (!empty($answersToDelete)) {
            $question->answers()->whereIn('id', $answersToDelete)->delete();
        }

        return redirect()->route('admin.questions.index')->with('success', 'Question updated successfully.');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index')->with('success', 'Question deleted successfully.');
    }
}
