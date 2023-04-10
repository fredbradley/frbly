<?php

namespace App\Http\Livewire;

use App\Services\QRCodeGeneratorService;
use Livewire\Component;

class QrCode extends Component
{
    public function render()
    {
        $qr = new QRCodeGeneratorService();
        $image = $qr->qrCode->generate('https://www.google.com');
        //$image = $qr->generate();
        return view('livewire.qr-code', compact('image'));
    }


}
