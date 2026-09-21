<?php

namespace App\Models\Profile;

use App\Models\Academic\AssessmentSubmission;
use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * student_lrn is the DepEd-issued Learner Reference Number, supplied
 * by the client rather than system-generated, so this model does NOT
 * use HasHashedPrimaryKey — the primary key value is provided on create().
 */
#[Fillable(['student_lrn', 'guardian_contact', 'grade_level', 'strand', 'user_id'])]
class StudentDetail extends Model
{
    use HasUuids;

    protected $primaryKey = 'student_lrn';
    protected $keyType = 'string';
    public $incrementing = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // public function assessmentSubmissions(): HasMany
    // {
    //     return $this->hasMany(AssessmentSubmission::class, 'student_lrn', 'student_lrn');
    // }
}
