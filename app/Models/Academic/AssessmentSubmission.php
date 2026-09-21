<?php

namespace App\Models\Academic;

use App\Models\Profile\StudentDetail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['score', 'assessment_id', 'student_lrn'])]
class AssessmentSubmission extends Model
{
    use HasUuids;

    protected $primaryKey = 'submission_id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'assessment_id');
    }

    public function studentLrn(): BelongsTo
    {
        return $this->belongsTo(StudentDetail::class, 'student_lrn', 'student_lrn');
    }

    public function assessmentAnswers(): HasMany
    {
        return $this->hasMany(AssessmentAnswer::class, 'submission_id', 'submission_id');
    }
}
