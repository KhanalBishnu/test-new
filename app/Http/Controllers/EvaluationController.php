<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EvaluationController extends Controller
{
    public function create()
    {
        return view('evaluation.create');
    }

    public function store(Request $request)
    {
        $data=$request->all();
      // Custom validation rule to check for duplicate evaluations in the same month
      $validator = Validator::make($request->all(), [
        'reviewer_id' => 'required|exists:users,id',
        'reviewer_data' => 'required',
        'review_of' => 'required|exists:users,id',
        // 'review_year_month' => 'required|date_format:Y-m', // Ensuring correct format
        'review_year_month' => 'required|date', // Ensuring correct format
        'department' => 'required|string',
        'current_goals_responsibilities' => 'required|string',
        'completed_goals_responsibilities' => 'required|string',
        'strengths' => 'required|string',
        'area_of_improvement' => 'required|string',
        'designation' => 'required|string',
        'question_answers' => 'required',
        'reviews_comments' => 'required|string',
        'score_related_data' => 'required',
    ], [
        // Custom validation message
        // 'review_year_month.unique_for_user' => 'An evaluation for this user already exists for the selected month.',
    ]);
    
    // $validator->after(function ($validator) use ($request) {
    //     $date = Carbon::createFromFormat('Y-m', $request->review_year_month)->startOfMonth();
    //     $exists = Evaluation::where('review_of', $request->review_of)
    //                         ->where('review_year_month', $date)
    //                         ->exists();

    //     if ($exists) {
    //         $validator->errors()->add('review_year_month', 'An evaluation for this user already exists for the selected month.');
    //     }
    // });

    if ($validator->fails()) {
        dd($validator->errors());
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

        $evaluation = new Evaluation();
        $evaluation->reviewer_id = $request->reviewer_id;
        $evaluation->reviewer_data = $request->reviewer_data;
        $evaluation->review_of = $request->review_of;
        $evaluation->review_year_month = $request->review_year_month;
        $evaluation->department = $request->department;
        $evaluation->current_goals_responsibilities = $request->current_goals_responsibilities;
        $evaluation->completed_goals_responsibilities = $request->completed_goals_responsibilities;
        $evaluation->strengths = $request->strengths;
        $evaluation->area_of_improvement = $request->area_of_improvement;
        $evaluation->designation = $request->designation;
        $evaluation->question_answers = json_encode($request->question_answers);
        $evaluation->reviews_comments = $request->reviews_comments;
        $evaluation->score_related_data = $request->score_related_data;
        $evaluation->save();

        return redirect()->route('evaluations.index')->with('success', 'Evaluation created successfully.');
    }

    public function index()
    {
        $evaluations = Evaluation::all();
        return view('evaluation.index', compact('evaluations'));
    }

    public function show($id)
    {
        // Fetch a single evaluation by ID
        $evaluation = Evaluation::findOrFail($id);

        // Pass the evaluation data to the view
        return view('evaluation.view', compact('evaluation'));
    }

    public function edit($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        return view('evaluation.edit', compact('evaluation'));
    }

    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'reviewer_id' => 'required|integer',
        'reviewer_data' => 'required|string',
        'review_of' => 'required|integer',
        'review_year_month' => 'required|date_format:Y-m',
        'department' => 'required|string',
        'question_answers.*.question' => 'required|string',
        'question_answers.*.answer' => 'required|string'
    ]);
    $data=$request->all();

    // Find the existing record by ID and update it
    $record = Evaluation::find($id);

    $data['question_answers']=json_encode($data['question_answers']);
    $record->update($data);

    // Update questions and answers
    foreach ($validated['question_answers'] as $answer) {
        // Update or create logic for questions
    }

    return redirect()->route('evaluations.index')->with('success', 'Record updated successfully.');
}


   

}
