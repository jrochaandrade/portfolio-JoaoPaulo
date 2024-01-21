<?php

namespace Modules\DetailedReport\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'number_BO' => 'required|max:10',
            'type_BO' => 'required|in:Termo Circunstanciado de Ocorrência - TCO,Comunicado de Ocorrência Policial - COP,Prisão e Apreensão - PA',
            //'article_BO' => 'required',
            'search_article_BO' => 'required',
            'number_AI' => 'required',
            'unit_measure' => 'required',
            'search_article' => 'required',
            //'article_AI' => 'required',
            //'type_AI' => 'required',
            'name' => 'required|string',
            'cpf' => 'required',
            //'rg' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
            'affiliation' => 'required',
            'address' => 'required',
            'location' => 'required',
            'historic' => 'required',
            //'images1[]' => 'required|array',
            //'images1' => 'required',
            //'images1.*' => 'max:2048',
            'motive' => 'required',
            'name_CMT' => 'required',
            'name_MOT' => 'required',
            /* 'name_PTR1' => 'required',
            'name_PTR2' => 'required',
            'name_PTR3' => 'required', */
            'unit_CMT' => 'required',
            'unit_MOT' => 'required',
            /* 'unit_PTR1' => 'required',
            'unit_PTR2' => 'required',
            'unit_PTR3' => 'required', */
            
        ];
    }

    public function messages()
    {
        return [
            'number_BO' => 'O campo Numero da Ocorrência é obrigatório',
            'type_BO' => 'Selecione uma das opções',
            //'article_BO' => 'O campo Artigo Criminal é obrigatório',
            'search_article_BO' => 'O campo Artigo Criminal é obrigatório',
            'number_AI' => 'O campo Auto de Infração é obrigatório',
            'article_AI' => 'O campo Artigo Administrativo é obrigatório',
            'type_AI' => 'Selecione uma opção',
            'unit_measure' => 'Selecione uma unidade de medida',
            'search_article' => 'O campo Artigo Administrativo é obrigatório',
            'name' => 'O campo Nome do Envolvido é obrigatório',
            'cpf' => 'O campo CPF é obrigatório',
            //'rg' => 'O campo RG é obrigatório',
            'phone' => 'O campo Telefone é obrigatório',
            'birthday' => 'O campo Data de Nascimento é obrigatório',
            'affiliation' => 'O campo Filiação é obrigatório ',
            'address' => 'O campo Endereço é obrigatório',
            'location' => 'O campo Local do fato é obrigatório',
            'historic' => 'O campo Histórico é obrigatório',
            'images1' => 'Obrigatório o envio de 4 imagens',
            'motive' => 'O campo Motivo é obrigatório',
            'name_CMT' => 'O campo Comandante é obrigatório',
            'name_MOT' => 'O campo Motorista é obrigatório',
            /* 'name_PTR1' => 'O campo Patrulheiro 1 é obrigatório',
            'name_PTR2' => 'O campo Patrulheiro 2 é obrigatório',
            'name_PTR3' => 'O campo Patrulheiro 3 é obrigatório', */
            'unit_CMT' => 'O campo Unidade Comandante é obrigatório',
            'unit_MOT' => 'O campo Unidade Motorista é obrigatório',
            /* 'unit_PTR1' => 'O campo Patrulheiro 1 é obrigatório',
            'unit_PTR2' => 'O campo Patrulheiro 2 é obrigatório',
            'unit_PTR3' => 'O campo Patrulheiro 3 é obrigatório', */
            
        ];
    }
}
