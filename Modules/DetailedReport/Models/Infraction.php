<?php

namespace Modules\DetailedReport\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infraction extends Model
{
    
    protected $fillable = ['id', 'article', 'verb', 'value_infraction', 'area_deforestation', 'article_AI'];

    

    use HasFactory;
}
