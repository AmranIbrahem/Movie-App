<?php

namespace App\Http\Controllers;

use App\Http\Responses\Response;
use App\Models\category;
use App\Models\movies;
use Illuminate\Http\Request;
use App\Models\series;
use Illuminate\Support\Facades\DB;

class ShowSeriesController extends Controller
{
    public function ShowSerie($id){
        $serie = series::find($id);
        if (!$serie) {
            return Response::Message("Serie not found",404);
        }else{
            return Response::SerieMessage($serie,200);
        }
    }

    ////////////////////////////////////////////////////
    public function Last10Series(){
        $series = series::latest()->take(10)->get(["id","main_photo", "title"]);

        if ( $series) {
            return Response::Serie($series,200);
        } else {
            return Response::Message("An error occurred",401);
        }
    }
    ////////////////////////////////////////////////////

    public function ShowSeriesEpisodes($idSeries)
    {
            $check = series::find($idSeries);
            if ($check) {
                if (count($check->get_series_episodes) != 0) {
                    return Response::SerieCategory("There are all Episodes in this Series",$check->get_series_episodes,200);
                } else {
                    return Response::Message('There are no Episodes in this serie',401);
                }
            } else {
                return Response::Message('Series Not Found',401);
            }
    }

    ////////////////////////////////////////////////////

    public function ShowSeriesByCategory($idCategory){
        $checkForIdCategory = Category::with('getSeries')->find($idCategory);

        if ($checkForIdCategory) {
            $series = $checkForIdCategory->getSeries;
            $nameCategory = $checkForIdCategory->description;

            if ($series->isNotEmpty()) {
                $seriesId = $series->pluck('id');
                $seriesData = series::select('id', 'title', 'main_photo')->whereIn('id', $seriesId)->get();

                return Response::SerieCategory("These are all my Series In $nameCategory",$seriesData,200);
            } else {
                return Response::Message("Not Found Series in this $nameCategory",200);
            }
        }else{
            return Response::Message('Error : Category Not Found',401);
        }
    }

    ////////////////////////////////////////////////////
    public function topRatedSeries()
    {
        $topRatedSeries = series::select('series.id', 'series.title', 'series.main_photo', DB::raw('AVG(ratings.rating) as average_rating'))
            ->leftJoin('ratings', 'series.id', '=', 'ratings.series_id')
            ->groupBy('series.id', 'series.title', 'series.main_photo')
            ->orderByDesc('average_rating')
            ->take(5)
            ->get();

        return response()->json([
            'top_rated_movies' => $topRatedSeries,
        ], 200);
    }

}
