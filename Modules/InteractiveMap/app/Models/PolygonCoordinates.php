<?php

namespace Modules\InteractiveMap\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PolygonCoordinates extends Model
{

    use SoftDeletes;

    protected $table = 'polygon_coordinates';

    protected $fillable = [
        'unique_id_coord', 'polygon_data_id_fk', 'latitude', 'longitude', 'type_polygon', 'unique_id_external'
    ];

    protected $primaryKey = 'id_polygon';

    public $timestamps = true;

    public function polygonData() {
        return $this->belongsTo(PolygonData::class, 'polygon_data_id_fk', 'id_polygon');
    }


    use HasFactory;
}
