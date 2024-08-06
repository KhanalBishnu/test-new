<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\EvaluationQuestionSection;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('sections')->get();
        $designations = Designation::with('sections')->get();
        $sections = EvaluationQuestionSection::with('questions')->get();

        $selectedQuestionIds = [];
        foreach ($sections as $section) {
            $selectedQuestionIds[$section->id] = $section->questions->pluck('id')->toArray();
        }
        return view('questions.index', compact('questions','sections','designations','selectedQuestionIds'));
    }

    public function create()
    {
        $sections = EvaluationQuestionSection::all();
        return view('questions.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'status' => 'required',
        ]);

        $question = Question::create($data);
        // $question->sections()->attach($data['sections']);

        return redirect()->route('questions.index')->with('success', 'Question created successfully');
    }

    public function edit(Question $question)
    {
        $sections = EvaluationQuestionSection::all();
        return view('questions.edit', compact('question', 'sections'));
    }

    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'status' => 'required|string',
            'sections' => 'array',
        ]);

        $question->update($data);
        $question->sections()->sync($data['sections']);

        return redirect()->route('questions.index')->with('success', 'Question updated successfully');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully');
    }
    public function toggleStatus(Question $question)
    {
        $question->update(['status'=>!$question->status]);
        return redirect()->route('questions.index')->with('success', 'Question updated successfully');
    }

    
}
