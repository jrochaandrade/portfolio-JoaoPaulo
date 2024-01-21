<?php

namespace Modules\DetailedReport\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{

    use SoftDeletes;
    protected $primaryKey = 'report_ID'; // Nome da sua chave primária
    public $incrementing = false; // Indica que a chave primária não é incremental
    protected $keyType = 'string'; // Indica que o tipo da chave primária é string

    protected $fillable = [
        'name', 'cpf', 'rg', 'phone', 'birthday', 'affiliation', 'address', 'location', 'historic', 'number_BO', 'type_BO', 'article_BO', 'id_infraction_bo','number_AI', 'value_AI', 'id_infraction', 'type_AI', 'unit_measure', 'size_deforestation', 'size_deforestation_intereger', 'size_deforestation_fraction', 'area_deforestation', 'number_embargo', 'quantity_wood', 'number_letter', 'text_administrative', 'text_embargo', 'text_type_wood', 'motive', 'mitigating', 'aggravating', 'name_CMT', 'name_MOT', 'name_PTR1', 'name_PTR2', 'name_PTR3', 'unit_CMT', 'unit_MOT', 'unit_PTR1', 'unit_PTR2', 'unit_PTR3', 'unic_id_report', 'term_seizure', 'seized_objects', 'deposit_location', 'name_faithful', 'name_responsible', 'value_infraction', 'type_deforestation', 'use_fire', 'id_user_created_at', 'id_user_last_updated_at', 'id_user_deleted_at'
    ];

    public function photos() {
        return $this->hasMany(PhotosReport::class);
    }
    use HasFactory;
}
