<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['choice', 'is_correct', 'question_id'])]
class McqChoice extends Model
{
    use HasUuids;

    protected $primaryKey = 'choice_id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function question(): BelongsTo
    {
        return $this->belongsTo(AssessmentQuestion::class, 'question_id', 'question_id');
    }
}
