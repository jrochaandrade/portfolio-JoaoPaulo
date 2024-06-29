<?php

namespace Modules\PhotographicReport\Repository;

use Modules\PhotographicReport\Models\PhotographicReport;

class PhotographicReportRepository extends PhotographicReport
{
    public static function search($request)
    {
        $reports = PhotographicReport::select('photographic_reports.*')->when($request->search_data, function($query, $role) use($request){
            return $query->where(function($query) use($request){
                $query->where('user', 'LIKE', "%$request->search_data%")->orWhere('Operation', 'LIKE', "%$request->search_data%")->orWhere('created_at', 'LIKE', "%$request->search_data%");
            });
        });

        return $reports;
    }
}