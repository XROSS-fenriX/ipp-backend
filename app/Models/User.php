<?php

namespace App\Models;

// use App\Models\Academic\Classroom;
// use App\Models\Academic\ClassroomStudent;
// use App\Models\Academic\Elective;
// use App\Models\Community\Community;
// use App\Models\Community\CommunityChat;
// use App\Models\Community\CommunityChatReact;
// use App\Models\Community\CommunityMember;
// use App\Models\Profile\StudentDetail;
// use App\Models\Profile\TeacherDetail;
// use App\Models\Profile\UserAddress;
// use App\Models\School\Incident;
// use App\Models\School\School;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['email', 'password', 'role', 'fname', 'mname', 'lname', 'gender', 'contact', 'account_status',
    // 'elective_id',
    // 'school_id'
    ])]
class User extends Authenticatable
{
    use HasApiTokens, HasUuids, Notifiable;

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

    // public function elective(): BelongsTo
    // {
    //     return $this->belongsTo(Elective::class, 'elective_id', 'elective_id');
    // }

    // public function school(): BelongsTo
    // {
    //     return $this->belongsTo(School::class, 'school_id', 'school_id');
    // }

    // public function incidents(): HasMany
    // {
    //     return $this->hasMany(Incident::class, 'caused_by', 'user_id');
    // }

    // public function userAddresses(): HasMany
    // {
    //     return $this->hasMany(UserAddress::class, 'user_id', 'user_id');
    // }

    // public function studentDetails(): HasMany
    // {
    //     return $this->hasMany(StudentDetail::class, 'user_id', 'user_id');
    // }

    // public function teacherDetails(): HasMany
    // {
    //     return $this->hasMany(TeacherDetail::class, 'user_id', 'user_id');
    // }

    // public function communities(): HasMany
    // {
    //     return $this->hasMany(Community::class, 'admin_id', 'user_id');
    // }

    // public function communityMembers(): HasMany
    // {
    //     return $this->hasMany(CommunityMember::class, 'user_id', 'user_id');
    // }

    // public function communityChats(): HasMany
    // {
    //     return $this->hasMany(CommunityChat::class, 'sent_by', 'user_id');
    // }

    // public function communityChatReacts(): HasMany
    // {
    //     return $this->hasMany(CommunityChatReact::class, 'reacted_by', 'user_id');
    // }

    // public function classrooms(): HasMany
    // {
    //     return $this->hasMany(Classroom::class, 'adviser_id', 'user_id');
    // }

    // public function classroomStudents(): HasMany
    // {
    //     return $this->hasMany(ClassroomStudent::class, 'user_id', 'user_id');
    // }
}
