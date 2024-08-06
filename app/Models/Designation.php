<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $fillable = ['department_id', 'company_id', 'name'];

    public function sections()
    {
        return $this->belongsToMany(EvaluationQuestionSection::class, 'designation_has_question_sections', 'designation_id', 'section_id');
    }
}
