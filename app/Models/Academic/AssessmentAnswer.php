<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['score', 'student_answer', 'submission_id', 'question_id'])]
class AssessmentAnswer extends Model
{
    use HasUuids;

    protected $primaryKey = 'answer_id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function submission(): BelongsTo
    {
        return $this->belongsTo(AssessmentSubmission::class, 'submission_id', 'submission_id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(AssessmentQuestion::class, 'question_id', 'question_id');
    }
}
