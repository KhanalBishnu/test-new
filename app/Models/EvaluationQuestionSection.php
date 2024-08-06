<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationQuestionSection extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_section_has_questions', 'section_id', 'question_id');
    }

    public function designations()
    {
        return $this->belongsToMany(Designation::class, 'designation_has_question_sections', 'section_id', 'designation_id');
    }
}
