<?php

namespace Modules\PhotographicReport\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhotographicReport extends Model
{
    use HasFactory;
    //use SoftDeletes;
    protected $fillable = ['header', 'logo', 'operation', 'user'];
    
    public function photo()
    {
        return $this->hasMany(Photo::class, 'photographic_report_id');
    }
}
