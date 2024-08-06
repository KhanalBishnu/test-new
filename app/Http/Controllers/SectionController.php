<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\EvaluationQuestionSection;
use App\Models\Question;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $questions = Question::with('sections')->get();
        $designations = Designation::with('sections')->get();
        $sections = EvaluationQuestionSection::with('questions')->get();

        return view('questions.index', compact('questions','sections','designations'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        EvaluationQuestionSection::create($request->all());

        return redirect()->route('questions.index')->with('success', 'Section created successfully.');
    }

    public function edit($id)
    {
        $section = EvaluationQuestionSection::findOrFail($id);
        $questions = Question::all();
    
        return response()->json([
            'id' => $section->id,
            'name' => $section->name,
            'description' => $section->description,
            'questions' => $questions
        ]);
    }
    
    public function show($id)
    {
        $section = EvaluationQuestionSection::findOrFail($id);
        $questions = Question::all();

        return view('sections.edit', compact('section', 'questions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $section = EvaluationQuestionSection::findOrFail($id);
        $section->update($request->all());

        return redirect()->route('questions.index')->with('success', 'Section updated successfully.');
    }

    public function delete( EvaluationQuestionSection $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'Section deleted successfully.');
    }

    public function addQuestion($id)
    {
        $section = EvaluationQuestionSection::findOrFail($id);
        $questions = Question::all();

        return view('sections.add-question', compact('section', 'questions'));
    }

    public function storeQuestion(Request $request, $id)
{
    $request->validate([
        'question_ids' => 'required|array',
        'question_ids.*' => 'exists:questions,id',
    ]);

    $section = EvaluationQuestionSection::findOrFail($id);
    $section->questions()->sync($request->question_ids);

    return redirect()->route('sections.index')->with('success', 'Questions added to section successfully.');
}


public function getSelectedQuestions(EvaluationQuestionSection $section)
{

    $selectedQuestionIds = [];
    if ($section) {
        $selectedQuestionIds = $section->questions->pluck('id')->toArray();
    }
    return response()->json(['selected_questions' => $selectedQuestionIds]);
}

}
