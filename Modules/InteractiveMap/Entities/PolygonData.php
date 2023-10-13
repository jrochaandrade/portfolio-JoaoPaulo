<?php

namespace Modules\InteractiveMap\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PolygonData extends Model
{
    use SoftDeletes;

    protected $table = 'polygon_data';

    protected $fillable = [
        'id_polygon', 'id_register', 'unique_id', 'name', 'cpf', 'cnpj', 'address', 'city', 'area', 'infraction_notice', 'decree', 'embargo', 'ocurrence', 'law', 'type_infraction', 'date', 'team', 'centroid', 'operation', 'geo_manager', 'id_user_created_at', 'id_user_updated_at', 'id_user_deleted_at', 
    ];

    protected $primaryKey = 'id_polygon';

    public $timestamps = true;

    public function polygonCoordinates() {
        return $this->hasMany(PolygonCoordinates::class, 'polygon_data_id_fk', 'id_polygon');
    } 

    use HasFactory;
}
