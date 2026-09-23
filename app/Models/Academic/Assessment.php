<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['assessment_title', 'assessment_type'])]
class Assessment extends Model
{
    use HasUuids;

    protected $primaryKey = 'assessment_id';
    protected $keyType = 'string';
    public $incrementing = false;

    // public function classroomAssessments(): HasMany
    // {
    //     return $this->hasMany(ClassroomAssessment::class, 'assessment_id', 'assessment_id');
    // }

    // public function communityAssessments(): HasMany
    // {
    //     return $this->hasMany(CommunityAssessment::class, 'assessment_id', 'assessment_id');
    // }

    public function classrooms(): BelongsToMany
    {
        return $this->belongsToMany(
            Assessment::class,
            'assessment_classroom',
            'classroom_id',
            'assessment_id'
        )->withTimestamps();
    }

    public function assessmentQuestions(): HasMany
    {
        return $this->hasMany(AssessmentQuestion::class, 'assessment_id', 'assessment_id');
    }

    public function assessmentSubmissions(): HasMany
    {
        return $this->hasMany(AssessmentSubmission::class, 'assessment_id', 'assessment_id');
    }
}
