<?php

namespace Modules\PhotographicReport\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use HasFactory;
    //use SoftDeletes;
    protected $fillable = ['id', 'path', 'date_time', 'photographic_report_id'];
    
    public function photographicReports()
    {
        return $this->belongsTo(PhotographicReport::class, 'photographic_report_id');
    }
}
