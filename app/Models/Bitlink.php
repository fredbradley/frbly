<?php

namespace App\Models;

use App\Traits\ModelLogger;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\Authorable;

class Bitlink extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;
    use Authorable, ModelLogger;

    protected $fillable = [
        'long_url',
        'domain',
        'bitlink_id',
        'custom_bitlinks',
        'slug',
        'title',
        'created_by',
        'updated_by',
        'created_at',
    ];

    protected $with = ['creator', 'updater'];

    public function customBitlinks(): Attribute
    {
        return new Attribute(
            get: fn($value) => json_decode($value),
            set: fn($value) => json_encode($value)
        );
    }
}
