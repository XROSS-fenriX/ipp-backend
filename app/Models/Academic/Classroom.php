<?php

namespace App\Models\Academic;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['classroom_name', 'subject_name', 'grade_level', 'adviser_id', 'elective_id'])]
class Classroom extends Model
{
    use HasUuids;

    protected $primaryKey = 'classroom_id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function adviser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'adviser_id', 'user_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'classroom_user',
            'classroom_id',
            'user_id'
        )->withTimestamps();
    }

    public function assessments(): BelongsToMany
    {
        return $this->belongsToMany(
            Assessment::class,
            'assessment_classroom',
            'classroom_id',
            'assessment_id'
        )->withTimestamps();
    }

    public function elective(): BelongsTo
    {
        return $this->belongsTo(Elective::class, 'elective_id', 'elective_id');
    }

    public function classroomMaterials(): HasMany
    {
        return $this->hasMany(ClassroomMaterial::class, 'classroom_id', 'classroom_id');
    }

    public function classroomAnnouncements(): HasMany
    {
        return $this->hasMany(ClassroomAnnouncement::class, 'classroom_id', 'classroom_id');
    }

    public function classroomDeadlines(): HasMany
    {
        return $this->hasMany(ClassroomDeadline::class, 'classroom_id', 'classroom_id');
    }
}
