<?php

namespace App\Http\Controllers;

use App\Http\Responses\Response;
use Illuminate\Http\Request;
use App\Models\movies;
use App\Models\series;

class SearchController extends Controller
{
    public function SearchByMovie($MovieName){
        $movie = movies::where("title", "like", "%" . $MovieName . "%")->get(['id','title','main_photo']);

        if (count($movie) >= 1 ) {
            return Response::Search('movies',$movie,200);

        } else {
            return Response::Message('There is no movies with this name',401);
        }
    }

    ////////////////////////////////////////////////////////////////
    public function SearchBySeries($SeriesName){
        $Serie = series::where("title", "like", "%" . $SeriesName . "%")->get(['id','title','main_photo']);

        if (count($Serie) >= 1 ) {
            return Response::Search('series',$Serie,200);

        } else {
            return Response::Message('There is no series with this name',401);
        }
    }

    ////////////////////////////////////////////////////////////////
    public function SearchAll($Name) {
        $series = series::where("title", "like", "%" . $Name . "%")->get(['id', 'title', 'main_photo']);

        $movies = movies::where("title", "like", "%" . $Name . "%")->get(['id', 'title', 'main_photo']);

        if ($series->isNotEmpty() || $movies->isNotEmpty()) {
            return response()->json([
                'movies' => $movies,
                'series' => $series
            ], 200);
        } else {
            return Response::Message('There is no series and movie with this name',401);
        }
    }

}
