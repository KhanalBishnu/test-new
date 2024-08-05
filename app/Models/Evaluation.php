<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $casts = [
        'reviewer_data' => 'array',
        'question_answers' => 'array',
        'score_related_data' => 'array',
    ];

    protected $fillable = [
        'reviewer_id',
        'reviewer_data',
        'review_of',
        'review_year_month',
        'department',
        'current_goals_responsibilities',
        'completed_goals_responsibilities',
        'strengths',
        'area_of_improvement',
        'designation',
        'question_answers',
        'reviews_comments',
        'score_related_data',
    ];
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function reviewedUser()
    {
        return $this->belongsTo(User::class, 'review_of');
    }


    // public function questions(){
    //     $this->attributes['question_answers']=json_decode($value);
    // }
}
