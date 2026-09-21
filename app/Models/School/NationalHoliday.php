<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['holiday_name', 'date'])]
class NationalHoliday extends Model
{
    use HasUuids;

    protected $primaryKey = 'holiday_id';
    protected $keyType = 'string';
    public $incrementing = false;
}
