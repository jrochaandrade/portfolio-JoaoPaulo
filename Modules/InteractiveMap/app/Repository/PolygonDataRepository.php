<?php

namespace Modules\InteractiveMap\app\Repository;

use Hamcrest\Type\IsNumeric;
use Modules\InteractiveMap\app\Models\PolygonData;

class PolygonDataRepository extends PolygonData
{
    public static function search($request)
    {   
        // Inicializar a consulta na tabela polygon_data
        $polygons = PolygonData::select('polygon_data.*')->when($request->searchData, function($query, $role) use($request){
            return $query->where(function($query) use($request){
                $query->where('name', 'LIKE', "%$request->searchData%")->orWhere('cpf', 'LIKE', "%$request->searchData%")->orWhere('address', 'LIKE', "%$request->searchData%");
            });
        });
        
        //dd($request->searchData);
        return $polygons;
    }
}
