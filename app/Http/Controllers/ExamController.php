<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index(Request $request, $category = null)
    {
        $answeredQuestions = session('answered_questions', []);
        $currentQuestionId = session('current_question_id');

        $query = Question::with('answers');

        if ($category) {
            $query->where('category', $category);
        }

        if ($currentQuestionId && !in_array($currentQuestionId, $answeredQuestions)) {
            $question = $query->find($currentQuestionId);
        } else {
            $question = $query->whereNotIn('id', $answeredQuestions)->inRandomOrder()->first();
        }

        if (!$question) {
            return redirect()->route('exam.results');
        }

        session(['current_question_id' => $question->id]);

        return view('exam', compact('question', 'category'));
    }

    public function storeAnswer(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer_id' => 'required|exists:answers,id',
        ]);

        $questionId = $request->input('question_id');
        $answerId = $request->input('answer_id');

        $answeredQuestions = session('answered_questions', []);
        $userAnswers = session('user_answers', []);

        // Store the answer
        $userAnswers[$questionId] = $answerId;
        session(['user_answers' => $userAnswers]);

        // Mark question as answered
        $answeredQuestions[] = $questionId;
        session(['answered_questions' => array_unique($answeredQuestions)]);

        // Clear current question ID to fetch a new one
        session()->forget('current_question_id');

        return redirect()->route('exam.index');
    }

    public function results()
    {
        $userAnswers = session('user_answers', []);
        $score = 0;
        $totalQuestions = count($userAnswers);
        $results = [];
        $category = session('current_exam_category'); // Retrieve category from session

        foreach ($userAnswers as $questionId => $selectedAnswerId) {
            $question = Question::with('answers')->find($questionId);
            $selectedAnswer = Answer::find($selectedAnswerId);
            $correctAnswer = $question->answers->where('is_correct', true)->first();

            $isCorrect = ($selectedAnswerId == $correctAnswer->id);
            if ($isCorrect) {
                $score++;
            }

            $results[] = [
                'question' => $question,
                'selected_answer' => $selectedAnswer,
                'correct_answer' => $correctAnswer,
                'is_correct' => $isCorrect,
            ];
        }

        // Clear session data after showing results
        session()->forget(['answered_questions', 'user_answers', 'current_question_id', 'current_exam_category']);

        return view('results', compact('score', 'totalQuestions', 'results', 'category'));
    }

    public function startExam(Request $request)
    {
        $category = $request->input('category');
        session()->forget(['answered_questions', 'user_answers', 'current_question_id']);
        if ($category) {
            session(['current_exam_category' => $category]);
            return redirect()->route('exam.index', ['category' => $category]);
        }
        return redirect()->route('exam.index');
    }
}
