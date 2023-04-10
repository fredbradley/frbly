<?php

use App\Services\BitlyService;
use Illuminate\Support\Facades\Storage;

it('has senior crest', function () {
    Storage::assertExists('senior-crest.png');
});
it('has prep crest', function () {
    Storage::assertExists('prep-crest.png');
});
it('has_bitly_connection', function () {
    $service = new BitlyService();
    $planLimits = $service->getPlanLimits();
    expect($planLimits)->toHaveKey('plan_limits');
    expect($planLimits['plan_limits'])->toBeArray();
    expect($planLimits['plan_limits'][0])->toHaveKey('name');
});
