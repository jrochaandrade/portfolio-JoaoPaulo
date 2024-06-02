<?php

namespace Modules\PhotographicReport\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotographicRequest extends FormRequest
{
    public function rules()
    {
        return [
            'photos' => 'required|array|min:1',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Verifica se cada item no array é uma imagem válida
        ];
    }

    public function attributes()
    {
        return [
            'photos' => 'fotos',
            'photos.*' => 'foto'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
