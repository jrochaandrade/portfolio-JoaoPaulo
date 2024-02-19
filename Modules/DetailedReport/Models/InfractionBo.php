<?php

namespace Modules\DetailedReport\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfractionBo extends Model
{
    
    protected $fillable = ['id', 'article'];

    

    use HasFactory;
}
