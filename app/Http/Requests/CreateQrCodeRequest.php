<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateQrCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // TODO: implement authorization
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'style' => 'required|string|in:square,dot,round',
            'eye' => 'required|string|in:circle,square',
            'margin' => 'required|integer',
            'error_correction' => 'required|string|in:L,M,Q,H',
            'encoding' => 'required|string',
            'format' => 'required|string|in:png,eps,svg',
            'size' => 'required|integer',
            'color' => 'required',           // TODO: validate color (could be hex or rgb)
            'backgroundColor' => 'required', // TOdo: validate color (could be hex or rgb)
        ];
    }

    public function prepareForValidation()
    {
        $this->mergeIfMissing([
            'style' => 'round',
            'eye' => 'circle',
            'margin' => 1,
            'error_correction' => 'H',
            'encoding' => 'ISO-8859-1',
            'size' => 512,
            'format' => 'png',
            'color' => '#0c223f',
            'backgroundColor' => '#ffffff',
        ]);
    }

    protected function f()
    {
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
}
