<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reviewer_id')->constrained('users')->onDelete('cascade');
            $table->json('reviewer_data');
            $table->foreignId('review_of')->constrained('users')->onDelete('cascade');
            $table->string('review_year_month');
            $table->string('department');
            $table->text('current_goals_responsibilities');
            $table->text('completed_goals_responsibilities');
            $table->text('strengths');
            $table->text('area_of_improvement');
            $table->string('designation');
            $table->json('question_answers');
            $table->text('reviews_comments');
            $table->json('score_related_data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
};
