<?php

namespace App\Models\Profile;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['address_type', 'house_no', 'street', 'barangay', 'municipality', 'province', 'user_id'])]
class UserAddress extends Model
{
    use HasUuids;

    protected $primaryKey = 'address_id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
