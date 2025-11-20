<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKbmRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idguru'  => 'required|exists:dataguru,idguru',
            'idwalas' => 'required|exists:datawalas,idwalas',
            'hari'    => 'required|string|max:20',
            'mulai'   => 'required|date_format:H:i',
            'selesai' => 'required|date_format:H:i|after:mulai',
        ];
    }
}
