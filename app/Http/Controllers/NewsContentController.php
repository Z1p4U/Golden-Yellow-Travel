<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsContentRequest;
use App\Http\Requests\UpdateNewsContentRequest;
use App\Http\Resources\NewsContentResource;
use App\Models\NewsContent;
use Illuminate\Support\Facades\Gate;

class NewsContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsContentContent = NewsContent::searchQuery()
            ->sortingQuery()
            ->paginationQuery();

        return response()->json([
            "message" => "News Content",
            "data" => NewsContentResource::collection($newsContentContent)
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsContentRequest $request)
    {
        $newsContent = NewsContent::create([
            'news_id' => $request->news_id,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request->content,
            'content_photo' => $request->content_photo
        ]);


        return response()->json([
            'message' => 'News Created successfully',
            'data' => $newsContent,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $news = NewsContent::find($id);

        if (is_null($news)) {
            return response()->json([
                'message' => 'News Content Not Found',
            ], 404);
        }

        $newsResource = new NewsContentResource($news);


        return response()->json([
            'message' => 'News Content Detail',
            'data' => $newsResource
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsContent $newsContentContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsContentRequest $request, String $id)
    {
        $news = NewsContent::find($id);

        if (is_null($news)) {
            return response()->json([
                'message' => 'News Content Not Found',
            ], 404);
        }

        $news->title = $request->title;
        $news->subtitle = $request->subtitle;
        $news->content = $request->content;
        $news->content_photo = $request->content_photo;

        $news->update();

        return response()->json([
            'message' => 'News Content Updated successfully',
            'data' => $news
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $news = NewsContent::find($id);

        if (is_null($news)) {
            return response()->json([
                'message' => 'News Content not Found',
            ], 404);
        }

        if (Gate::denies('delete', $news)) {
            return response()->json([
                'message' => 'You are no allowed',
            ], 404);
        }

        $news->delete();

        return response()->json([
            'message' => 'News Content deleted successfully',
        ]);
    }
}