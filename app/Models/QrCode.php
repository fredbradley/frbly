<?php

namespace App\Models;

use App\Traits\Authorable;
use App\Traits\ModelLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QrCode extends Model
{
    use HasFactory, Authorable, ModelLogger, SoftDeletes;

    protected $with = ['creator', 'updater'];

}
