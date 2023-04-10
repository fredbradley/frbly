<?php

namespace App\Services;

use App\Actions\HexToRgb;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeGeneratorService
{
    public $qrCode;

    public function __construct()
    {
        $this->qrCode = QrCode::size(512)->format('png')->errorCorrection('H')->margin(1);
        /*$data = QrCode::size(512)
            //->style('round')
                      ->eye('circle')
                      ->margin('1')
                      ->color(12,34,63)
                      ->eyeColor(0,255,198,39,12,34,63)
                      ->eyeColor(1,171,22,43,12,34,63)
                      ->eyeColor(2,140,183,232,12,34,63)
                      ->format('png')
                      ->merge('/storage/app/crest.png')
                      ->errorCorrection('H')
                      ->generate('https://www.google.com');
       // return response($data)->header('Content-type', 'image/png');*/
    }

    public function setEye(int $eye, HexToRgb|string $foreground, HexToRgb|string $background): QRCodeGeneratorService
    {
        if (!in_array($eye, [0, 1, 2])) {
            throw new \InvalidArgumentException('Eye must be 0, 1 or 2');
        }
        if (is_string($foreground)) {
            $foreground = new HexToRgb($foreground);
        }
        if (is_string($background)) {
            $background = new HexToRgb($background);
        }

        $this->qrCode->eye($eye, $foreground->red, $foreground->green, $foreground->blue, $background->red, $background->green, $background->blue);
        return $this;
    }
}
