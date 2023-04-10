<?php

namespace App\Actions\Bitly;

use App\Models\Bitlink;
use App\Services\BitlyService;
use Illuminate\Support\Facades\Gate;

class DeleteBitlink
{
    public function delete(Bitlink $bitlink): void
    {
        Gate::authorize('delete', $bitlink);
        $service = new BitlyService();

        $response = $service->delete($bitlink->bitlink_id);

        if ($response->ok()) {
            $bitlink->delete();
        }

    }
}
