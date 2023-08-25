<?php

namespace App\Models;

use App\Traits\BasicAudit;
use App\Traits\SnowflakeID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
    use HasFactory, SnowflakeID, BasicAudit;

    protected $fillable = ["name", "city_id", "date", "overview", "price", "sale_price", "location", "departure", "theme", "duration", "rating", "type", "for_whom", 'style', "tour_photo"];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }
}
