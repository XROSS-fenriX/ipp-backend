<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['track_name'])]
class Track extends Model
{
    use HasUuids, HasFactory;

    protected $primaryKey = 'track_id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function electives(): HasMany
    {
        return $this->hasMany(Elective::class, 'track_id', 'track_id');
    }
}
