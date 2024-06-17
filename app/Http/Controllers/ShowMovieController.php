<?php

namespace App\Http\Controllers;

use App\Http\Responses\Response;
use App\Models\series;
use Illuminate\Http\Request;
use App\Models\movies;
use App\Models\category;
use Illuminate\Support\Facades\DB;

class ShowMovieController extends Controller
{
    public function ShowMovie($id){
        $movie = movies::find($id);
        if (!$movie) {
            return Response::Message("Movie not found ",404);
        }else{
            return Response::MovieMessage($movie,404);
        }
    }
    ////////////////////////////////////////////////////

    public function Last10Movie(){
        $movie = movies::latest()->take(10)->get(["id","main_photo", "title"]);
        if ( $movie) {
            return Response::Movie($movie,200);
        } else {
            return Response::Message("An error occurred",401);
        }
    }

    ////////////////////////////////////////////////////

    public function ShowMovieByCategory($idCategory){
        $checkForIdCategory = Category::with('getMovie')->find($idCategory);

        if ($checkForIdCategory) {
            $movies = $checkForIdCategory->getMovie;
            $nameCategory = $checkForIdCategory->description;

            if ($movies->isNotEmpty()) {
                $moviesId = $movies->pluck('id');
                $movieData = movies::select('id', 'title', 'main_photo')->whereIn('id', $moviesId)->get();

                return Response::MovieCategory($nameCategory,$movieData,200);

            } else {
                return Response::Message("Not Found Movies in this $nameCategory",200);
            }
        }else{
            return Response::Message("Error : Category Not Found",404);
        }
    }

    ////////////////////////////////////////////////////
    public function topRatedMovies()
    {
        $topRatedMovies = movies::select('movies.id', 'movies.title', 'movies.main_photo', DB::raw('AVG(ratings.rating) as average_rating'))
            ->leftJoin('ratings', 'movies.id', '=', 'ratings.movie_id')
            ->groupBy('movies.id', 'movies.title', 'movies.main_photo')
            ->orderByDesc('average_rating')
            ->take(5)
            ->get();

        return response()->json([
            'top_rated_movies' => $topRatedMovies,
        ], 200);
    }


}
