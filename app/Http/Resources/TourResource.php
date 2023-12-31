<?php

namespace App\Http\Resources;

use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        // dd($this);

        return [
            "id" => $this->id,
            "name" => $this->name,
            "package_name" => $this->package_name,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "country_name" => $this->city->country->name,
            "city_name" => $this->city->name,
            "city_id" => $this->city_id,
            "overview" => $this->overview,
            "price" => $this->price,
            "sale_price" => $this->sale_price,
            "location" => $this->location,
            "departure" => $this->departure,
            "theme" => $this->theme,
            "duration" => $this->duration,
            "rating" => $this->rating,
            "type" => $this->type,
            "style" => $this->style,
            "for_whom" => $this->for_whom,
            "tour_photo" => $this->tour_photo,
            "created_at" => $this->created_at->format('d m Y'),
            "updated_at" => $this->updated_at->format('d m Y'),

            // Itinerary
            "itineraries" => $this->itinerary,

            // Inclusion
            "inclusions" => $this->inclusion,

            // Tour Price
            "price" => $this->price,

            //Tour List
            "list" => Tour::with('city')->orderBy('city_id', 'desc')->paginate(1)


        ];
    }
}
