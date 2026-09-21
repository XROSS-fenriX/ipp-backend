<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['event_name', 'start_date', 'end_date', 'event_scope', 'event_type', 'event_description', 'event_location', 'color_tag', 'school_id'])]
class SchoolEvent extends Model
{
    use HasUuids;

    protected $primaryKey = 'event_id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }
}
