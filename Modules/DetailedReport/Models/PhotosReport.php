<?php

namespace Modules\DetailedReport\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotosReport extends Model
{
    protected $fillable = ['image', 'report_report_ID'];

    public function report() {
        return $this->belongsTo(Report::class, 'report_report_ID', 'report_ID');
    }

    use HasFactory;
}
