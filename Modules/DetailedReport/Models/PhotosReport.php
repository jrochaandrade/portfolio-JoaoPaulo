<?php

namespace Modules\DetailedReport\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhotosReport extends Model
{
    use SoftDeletes;
    protected $fillable = ['image', 'report_report_ID', 'type_image'];

    public function report() {
        return $this->belongsTo(Report::class, 'report_report_ID', 'report_ID');
    }

    use HasFactory;
}
