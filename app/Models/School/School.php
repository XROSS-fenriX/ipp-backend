<?php

namespace App\Models\School;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['school_name', 'street', 'barangay', 'municipality', 'province', 'type'])]
class School extends Model
{
    use HasUuids, HasFactory;

    protected $primaryKey = 'school_id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'school_id', 'school_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(SchoolEvent::class, 'school_id', 'school_id');
    }
}
