<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:dataadmin,username',
            'password' => 'required|string|min:6',
            'nama' => 'required|string|max:100',
            'tb' => 'required|numeric|min:30|max:250',
            'bb' => 'required|numeric|min:10|max:200',
        ];
    }
}
