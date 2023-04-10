<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Authorable
{
    public function updatedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, "updated_by", "id");
    }

    public function updater(): BelongsTo
    {
        return $this->updatedBy();
    }

    public function creator(): BelongsTo
    {
        return $this->createdBy();
    }

    public function createdBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, "created_by", "id");
    }
}
