<?php

namespace App\Observers;

use App\Models\Bitlink;

class BitlinkObserver
{
    /**
     * Handle the Bitlink "created" event.
     */
    public function created(Bitlink $bitlink): void
    {
        //
    }

    /**
     * Handle the Bitlink "updated" event.
     */
    public function updated(Bitlink $bitlink): void
    {
        //
    }

    /**
     * Handle the Bitlink "deleted" event.
     */
    public function deleted(Bitlink $bitlink): void
    {
        //
    }

    /**
     * Handle the Bitlink "restored" event.
     */
    public function restored(Bitlink $bitlink): void
    {
        //
    }

    /**
     * Handle the Bitlink "force deleted" event.
     */
    public function forceDeleted(Bitlink $bitlink): void
    {
        //
    }

    public function saving(Bitlink $bitlink): void
    {
        if (auth()->user()) {
            if (! isset($bitlink->created_by)) {
                $bitlink->created_by = auth()->user()->id;
            }
            if (! isset($bitlink->updated_by)) {
                $bitlink->updated_by = auth()->user()->id;
            }
        }
    }
}
