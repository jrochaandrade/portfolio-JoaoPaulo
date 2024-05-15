<?php

namespace Modules\PhotographicReport\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'path', 'date_time', 'description', 'photographic_report_id'];
    
    public function photographicReport()
    {
        return $this->belongsTo(PhotographicReport::class, 'photographic_report_id');
    }
}
