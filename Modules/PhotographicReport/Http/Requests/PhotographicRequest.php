<?php

namespace Modules\PhotographicReport\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotographicRequest extends FormRequest
{
    public function rules()
    {
        return [
            'photos' => 'required|array|min:1',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096'
        ];
    }

    public function messages()
    {
        return [
            'photos.required' => 'É necessário enviar pelo menos uma foto.',
            'photos.array' => 'O campo fotos deve ser um array.',
            'photos.min' => 'O campo fotos deve ter pelo menos uma foto.',
            'photos.*.required' => 'Cada foto é obrigatória.',
            'photos.*.image' => 'Cada arquivo deve ser uma imagem.',
            'photos.*.mimes' => 'Cada imagem deve ser do tipo jpeg, png, jpg.',
            'photos.*.max' => 'Cada imagem não pode ter mais de 4096 kilobytes.',
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
