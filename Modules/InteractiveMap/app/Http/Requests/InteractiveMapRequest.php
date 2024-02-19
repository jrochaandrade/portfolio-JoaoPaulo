<?php

namespace Modules\InteractiveMap\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InteractiveMapRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'cpf' => 'required',
            'address' => 'required',
            'city' => 'required ',
            'id_register' => 'required ',
            'area' => 'required',
            'infraction_notice' => 'required',
            'decree' => 'required',
            'embargo' => 'required',
            'ocurrence' => 'required',
            'law' => 'required',
            'type_infraction' => 'required',
            'date' => 'required',
            'team' => 'required',
            'centroid' => 'required',
            //'operation' => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function attributes()
    {
        return [
            'name' => 'nome',
            'cpf' => 'cpf',
            'address' => 'Endereço',
            'city' => 'Cidade',
            'id_register' => 'Carta Imagem',
            'area' => 'Área do dano',
            'infraction_notice' => 'Auto de Infração',
            'decree' => 'Tipificação do Auto',
            'embargo' => 'Embargo',
            'ocurrence' => 'Ocorrência',
            'law' => 'Tipificação da ocorrência',
            'type_infraction' => 'Tipo de infração',
            'date' => 'Data',
            'team' => 'Equipe que registrou',
            'centroid' => 'Coordenadas do dano',
            //'operation' => 'xxxx',
        ];
    }
}
