<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode;

it('can create qr code', function () {
    $data = QrCode::size(512)
        //->style('round')
                  ->eye('circle')
                  ->margin('1')
                  ->color(12,34,63)
                  ->eyeColor(0,255,198,39,12,34,63)
                  ->eyeColor(1,171,22,43,12,34,63)
                  ->eyeColor(2,140,183,232,12,34,63)
                  ->format('png')
                  ->merge('/storage/app/senior-crest.png')
                  ->errorCorrection('H')
                  ->generate('https://www.google.com');

    expect($data)->toBeInstanceOf(\Illuminate\Support\HtmlString::class);
});
