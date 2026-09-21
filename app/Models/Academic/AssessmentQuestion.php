<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['question', 'question_type', 'points', 'assessment_id'])]
class AssessmentQuestion extends Model
{
    use HasUuids;

    protected $primaryKey = 'question_id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'assessment_id');
    }

    public function mcqChoices(): HasMany
    {
        return $this->hasMany(McqChoice::class, 'question_id', 'question_id');
    }

    public function identificationAnswers(): HasMany
    {
        return $this->hasMany(IdentificationAnswer::class, 'question_id', 'question_id');
    }

    public function enumerationAnswers(): HasMany
    {
        return $this->hasMany(EnumerationAnswer::class, 'question_id', 'question_id');
    }

    public function assessmentAnswers(): HasMany
    {
        return $this->hasMany(AssessmentAnswer::class, 'question_id', 'question_id');
    }
}
