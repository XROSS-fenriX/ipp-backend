<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

#[Fillable(['type', 'intensity', 'is_actioned', 'description', 'caused_by'])]
class Incident extends Model
{
    use HasUuids;

    protected $primaryKey = 'incident_id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function causedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'caused_by', 'user_id');
    }
}
