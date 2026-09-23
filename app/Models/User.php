<?php

namespace App\Models;

use App\Models\Academic\Classroom;
use App\Models\Academic\Elective;
use App\Models\Profile\StudentDetail;
use App\Models\Profile\TeacherDetail;
use App\Models\Profile\UserAddress;
use App\Models\School\Incident;
use App\Models\School\School;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['email', 'password', 'role', 'fname', 'mname', 'lname', 'gender', 'contact', 'account_status',
    'elective_id',
    'school_id'
    ])]
class User extends Authenticatable
{
    use HasApiTokens, HasUuids, HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function enrolledClassrooms(): BelongsToMany
    {
        return $this->belongsToMany(
            Classroom::class,
            'classroom_user', // Pivot table name[cite: 3]
            'user_id',        // Foreign key of the current model in pivot[cite: 3]
            'classroom_id'    // Foreign key of the related model in pivot[cite: 3]
        )->withTimestamps(); // Includes created_at and updated_at from the pivot[cite: 3]
    }

    public function elective(): BelongsTo
    {
        return $this->belongsTo(Elective::class, 'elective_id', 'elective_id');
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }

    public function incidents(): HasMany
    {
        return $this->hasMany(Incident::class, 'caused_by', 'user_id');
    }

    public function userAddresses(): HasMany
    {
        return $this->hasMany(UserAddress::class, 'user_id', 'user_id');
    }

    public function studentDetails(): HasMany
    {
        return $this->hasMany(StudentDetail::class, 'user_id', 'user_id');
    }

    public function teacherDetails(): HasMany
    {
        return $this->hasMany(TeacherDetail::class, 'user_id', 'user_id');
    }

    public function classrooms(): HasMany
    {
        return $this->hasMany(Classroom::class, 'adviser_id', 'user_id');
    }
}
