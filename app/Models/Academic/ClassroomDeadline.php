<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['cd_name', 'start_date', 'end_date', 'deadline_type', 'deadline_description', 'deadline_location', 'classroom_id'])]
class ClassroomDeadline extends Model
{
    use HasUuids;

    protected $primaryKey = 'cd_id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'classroom_id', 'classroom_id');
    }
}
