<?php

use App\Services\BitlyService;
use Illuminate\Support\Facades\Storage;

it('has all logos', function () {
    foreach (\App\Enums\LogoImage::cases() as $logo) {
        Storage::disk('logos')->assertExists($logo->value);
    }
});
it('has_bitly_connection', function () {
    $service = new BitlyService();
    $planLimits = $service->getPlanLimits();
    expect($planLimits)->toHaveKey('plan_limits');
    expect($planLimits['plan_limits'])->toBeArray();
    expect($planLimits['plan_limits'][0])->toHaveKey('name');
});
