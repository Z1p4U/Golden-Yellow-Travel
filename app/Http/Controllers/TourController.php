<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use PhpParser\Node\Expr\Cast\String_;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tour = Tour::searchQuery()
            ->sortingQuery()
            ->paginationQuery();

        $tourResource =  TourResource::collection($tour);

        // return response()->json([
        //     'data' => $tourResource,
        //     'pagination' => [
        //         'total' => $tour->total(),
        //         'count' => $tour->count(),
        //         'per_page' => $tour->perPage(),
        //         'current_page' => $tour->currentPage(),
        //         'total_pages' => $tour->lastPage(),
        //     ],
        // ], 200);

        return $this->success("Tour List", $tour);
    }

    public function filteredTour(Request $request)
    {
        $tour = Tour::query();

        if ($request->filled('city_id')) {
            $tour->orWhere('city_id', 'like', '%' . $request->input('city_id') . '%');
        }

        if ($request->filled('start_date')) {
            $tour->orWhere('start_date', 'like', '%' . $request->input('start_date') . '%');
        }

        if ($request->filled('duration')) {
            $tour->orWhere('duration', 'like', '%' . $request->input('duration') . '%');
        }

        $tours = $tour->sortingQuery()->paginationQuery();

        return $this->success("Tour List", $tours);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourRequest $request)
    {
        $tour = Tour::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            "city_id" => $request->city_id,
            "package_name" => $request->package_name,
            "overview" => $request->overview,
            "price" => $request->price,
            "sale_price" => $request->sale_price,
            "location" => $request->location,
            "departure" => $request->departure,
            "theme" => $request->theme,
            "duration" => $request->duration,
            "rating" => $request->rating,
            "type" => $request->type,
            "style" => $request->style,
            "for_whom" => $request->for_whom,
            'tour_photo' => $request->tour_photo
        ]);


        return response()->json([
            'message' => 'Tour Created successfully',
            'data' => $tour,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $tour = Tour::find($id);

        if (is_null($tour)) {
            return response()->json([
                'message' => 'Tour Not Found',
            ], 404);
        }

        $tourResource = new TourResource($tour);

        // $tour = Tour::with('city')
        //     ->orderBy('city_id', 'desc')->paginate(1);

        return response()->json([
            'message' => 'Tour Detail',
            // 'list' =>   $tour,
            'data' => $tourResource
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourRequest $request, String $id)
    {
        $tour = Tour::find($id);
        if (is_null($tour)) {
            return response()->json([
                'message' => 'Tour Not Found',
            ], 404);
        }

        $tour->name = $request->name;
        $tour->city_id = $request->city_id;
        $tour->start_date = $request->start_date;
        $tour->end_date = $request->end_date;
        $tour->package_name = $request->package_name;
        $tour->overview = $request->overview;
        $tour->price = $request->price;
        $tour->sale_price = $request->sale_price;
        $tour->location = $request->location;
        $tour->departure = $request->departure;
        $tour->theme = $request->theme;
        $tour->duration = $request->duration;
        $tour->rating = $request->rating;
        $tour->type = $request->type;
        $tour->style = $request->style;
        $tour->for_whom = $request->for_whom;
        $tour->tour_photo = $request->tour_photo;

        $tour->update();

        return response()->json([
            'message' => 'Tour Updated successfully',
            'data' => $tour
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $tour = Tour::find($id);

        if (is_null($tour)) {
            return response()->json([
                'message' => 'Tour not Found',
            ], 404);
        }

        if (Gate::denies('delete', $tour)) {
            return response()->json([
                'message' => 'You are no allowed',
            ], 404);
        }

        $tour->delete();

        return response()->json([
            'message' => 'Tour deleted successfully',
        ], 200);
    }

    public function dateFilter(Request $request)
    {
        $start_date = $request->date;

        $result = Tour::whereDate('date', "<=", $start_date)->get();

        return response()->json([
            'message' => "Filtered Result",
            "data" => $result
        ], 200);
    }
}
