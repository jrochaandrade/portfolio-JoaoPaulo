<?php

namespace Modules\PhotographicReport\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhotographicReport extends Model
{
    use HasFactory;

    protected $fillable = ['operation'];
    
    public function photo()
    {
        return $this->hasMany(Photo::class, 'photographic_report_id');
    }
}
