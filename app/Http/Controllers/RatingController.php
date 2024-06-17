<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserController\RateMovieRequest;
use App\Http\Requests\UserController\RateSeriesRequest;
use App\Http\Responses\Response;
use App\Models\movies;
use App\Models\Rating;
use App\Models\series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rateMovie(RateMovieRequest $request)
    {
        $userId = Auth::id();
        $movie = movies::find($request->movie_id);

        if (!$movie) {
            return Response::Message('Movie not found',404);
        }

        $existingRating = Rating::where('user_id', $userId)
            ->where('movie_id', $request->movie_id)
            ->first();
        if ($existingRating) {
            return Response::Message("You have already rated this movie ", 400);
        }

        $rating = Rating::updateOrCreate([
            'user_id' => Auth::id(),
            'movie_id' => $request->movie_id,
            'rating' => $request->rating,
        ]);

        return Response::Message('Rating submitted successfully',201);
    }

    ///////////////////////////////////////////////////////////
    public function rateSeries(RateSeriesRequest $request)
    {
        $userId = Auth::id();
        $serie = series::find($request->series_id);

        if (!$serie) {
            return Response::Message('Movie not found',404);
        }

        $existingRating = Rating::where('user_id', $userId)
            ->where('series_id', $request->series_id)
            ->first();
        if ($existingRating) {
            return Response::Message('You have already rated this series', 400);
        }

        $rating = Rating::updateOrCreate([
            'user_id' => Auth::id(),
            'series_id' => $request->series_id,
            'rating' => $request->rating,
        ]);

        return Response::Message('Rating submitted successfully',201);

    }

    ///////////////////////////////////////////////////////////

    public function getMovieAverageRating($movieId)
    {
        $movie = movies::find($movieId);

        if (!$movie) {
            return response()->json([
                'message' => 'Movie not found'
            ], 404);
        }

        $ratings = Rating::where('movie_id', $movieId)->pluck('rating');

        $count = $ratings->count();
        $totalRating = $ratings->sum();

        if ($count > 0) {
            $averageRating = $totalRating / $count;
        } else {
            $averageRating = 0;
        }

        return response()->json([
            'average_rating' => $averageRating,
            'total_ratings' => $count
        ], 200);
    }

    ///////////////////////////////////////////////////////////

    public function getSeriesAverageRating($seriesId)
    {
        $series = series::find($seriesId);

        if (!$series) {
            return response()->json([
                'message' => 'Series not found'
            ], 404);
        }

        $ratings = Rating::where('series_id', $seriesId)->pluck('rating');

        $count = $ratings->count();
        $totalRating = $ratings->sum();

        if ($count > 0) {
            $averageRating = $totalRating / $count;
        } else {
            $averageRating = 0;
        }

        return response()->json([
            'average_rating' => round($averageRating,2),
            'total_ratings' => $count
        ], 200);
    }
}
