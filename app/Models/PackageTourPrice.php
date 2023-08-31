<?php

namespace App\Models;

use App\Traits\BasicAudit;
use App\Traits\HistoryRecord;
use App\Traits\SnowflakeID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageTourPrice extends Model
{
    use HasFactory, SnowflakeID, BasicAudit, HistoryRecord;

    protected $fillable = ["package_tour_id", "category", "price", "sale_price", "private_price", "sale_private_price"];

    public function packageTour()
    {
        return $this->belongsTo(PackageTour::class);
    }
}