<?php

namespace Modules\DetailedReport\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $primaryKey = 'report_ID'; // Nome da sua chave primária
    public $incrementing = false; // Indica que a chave primária não é incremental
    protected $keyType = 'string'; // Indica que o tipo da chave primária é string

    protected $fillable = [
        'name', 'cpf', 'rg', 'phone', 'birthday', 'affiliation', 'address', 'location', 'historic', 'number_BO', 'type_BO', 'article_BO', 'number_AI', 'value_AI', 'article_AI', 'type_AI', 'size_deforestation', 'size_deforestation_intereger', 'size_deforestation_fraction', 'area_deforestation', 'number_embargo', 'number_letter', 'text_administrative', 'text_embargo', 'motive', 'mitigating', 'aggravating', 'name_CMT', 'name_MOT', 'name_PTR1', 'name_PTR2', 'name_PTR3', 'unit_CMT', 'unit_MOT', 'unit_PTR1', 'unit_PTR2', 'unit_PTR3', 'unic_id_report', 'seized_objects', 'deposit_location', 'name_faithful', 'name_responsible'
    ];

    public function photos() {
        return $this->hasMany(PhotosReport::class);
    }
    use HasFactory;
}
