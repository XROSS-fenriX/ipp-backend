<?php

namespace App\Models\Academic;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['elective_name', 'track_id'])]
class Elective extends Model
{
    use HasUuids, HasFactory;

    protected $primaryKey = 'elective_id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class, 'track_id', 'track_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'elective_id', 'elective_id');
    }

    public function classrooms(): HasMany
    {
        return $this->hasMany(Classroom::class, 'elective_id', 'elective_id');
    }
}
