<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['ca_title', 'ca_description', 'file_link', 'classroom_id'])]
class ClassroomAnnouncement extends Model
{
    use HasUuids;

    protected $primaryKey = 'ca_id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'classroom_id', 'classroom_id');
    }
}
