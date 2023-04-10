<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function index()
    {
        return view('qr-codes.index');
    }
    public function show()
    {
        $data = QrCode::size(512)
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
        return response($data)->header('Content-type', 'image/png');
    }
}
