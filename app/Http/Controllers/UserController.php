<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserController\FavoriteRequest;
use App\Http\Responses\Response;
use Illuminate\Http\Request;
use App\Models\series;
use App\Models\movies;
use App\Models\Favorite_Movie;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Validation\Validator;

class UserController extends Controller
{
    public function AddToFavoriteSeries($series_id){
        $user = Auth::id();
        $checkForSeriesId=series::find($series_id);
        $checkForUserId=User::find($user);

        if($checkForSeriesId && $checkForUserId ){
            $SeriseName=$checkForSeriesId->title;
            $checkForAddBefor=Favorite::where('series_id',$series_id)
                                        ->where('user_id',$user)->exists();
            if( $checkForAddBefor){
                    return Response::Message("you have added $SeriseName to your favorites before",200);
            } else{
                    $favorite=Favorite::create([
                        'series_id'=>$series_id,
                        'user_id' =>$user
                    ]);
                    if($favorite){
                        return Response::Message(" $SeriseName was added to favorites successfully",200);
                    }else{
                        return Response::Message('Error',401);
                    }
            }
        }else{
            return Response::Message('Series Or User Not Found',401);
        }
    }

    //////////////////////////////////////////////////

    public function AddToFavoriteMovie($movie_id){
        $user = Auth::id();
        $checkForMovieId=movies::find($movie_id);
        $checkForUserId=User::find($user);

        if($checkForMovieId && $checkForUserId ){
            $MovieName=$checkForMovieId->title;
            $checkForAddBefor=Favorite_Movie::where('movie_id',$movie_id)
                                     ->where('user_id',$user)->exists();
            if($checkForAddBefor){
                return Response::Message("you have added $MovieName to your favorites before",200);
            }else{
                $favorite=Favorite_Movie::create([
                    'movie_id'=>$movie_id,
                    'user_id' =>$user
                ]);
                if($favorite){
                    return Response::Message(" $MovieName was added to favorites successfully",200);
                }else{
                    return Response::Message('Error',401);
                }
            }
        }else{
            return Response::Message('Movie Or User Not Found',401);
        }
    }

    //////////////////////////////////////////////////////////////////////

    public function GetFavoriteMovie(){
        $idUser=Auth::id();
        $checkForIdUser=User::with('get_favorite_movie')->find($idUser);
        if($checkForIdUser){
            $data = $checkForIdUser->get_favorite_movie;
//            return $data;
            if (count($data) >= 1) {
                $movie=$data->pluck('movie_id');
                $moviedata = movies::select('id', 'title', 'main_photo')->whereIn('id',$movie)->get();

                return response()->json([
                    'message'=>"These are all my favorite Movies",
                    'Movies' => $moviedata,
                ], 200);
            } else {
                return Response::Message("There's no favorite Movies to show.",200);
            }
        }else{
            return Response::Message("User Not Found.",401);
        }
    }

    //////////////////////////////////////////////////////////////////////

    public function GetFavoriteSeries(){
        $idUser=Auth::id();
        $checkForIdUser=User::with('get_favorite_series')->find($idUser);
        if($checkForIdUser){
            $data = $checkForIdUser->get_favorite_series;
            if (count($data) >= 1) {
                $serie=$data->pluck('series_id');
                $serieData = series::select('id', 'title', 'main_photo')->whereIn('id',$serie)->get();

                return response()->json([
                    'message'=>"These are all my favorite Series",
                    'Series' => $serieData,
                ], 200);
            } else {
                return Response::Message("There's no favorite Series to show.",200);
            }
        }else{
            return Response::Message("User Not Found.",401);
        }
    }

    //////////////////////////////////////////////////////////////////////

    public function GetFavoriteMedia() {
        $idUser=Auth::id();
        $checkForIdUser = User::with(['get_favorite_movie', 'get_favorite_series'])->find($idUser);

        if ($checkForIdUser) {
            $favoriteMovies = $checkForIdUser->get_favorite_movie;
            $favoriteSeries = $checkForIdUser->get_favorite_series;

            $movieData = collect();
            $seriesData = collect();

            if ($favoriteMovies->isNotEmpty()) {
                $movieIds = $favoriteMovies->pluck('movie_id');
                $movieData = movies::select('id', 'title', 'main_photo')->whereIn('id', $movieIds)->get();
            }

            if ($favoriteSeries->isNotEmpty()) {
                $seriesIds = $favoriteSeries->pluck('series_id');
                $seriesData = series::select('id', 'title', 'main_photo')->whereIn('id', $seriesIds)->get();
            }

            $mergedData = $movieData->merge($seriesData);

            if ($mergedData->isNotEmpty()) {
                return response()->json([
                    'message' => "These are all my favorite Movies and Series",
                    'Movies' => $movieData,
                    'Series'=>$seriesData,
                ], 200);
            } else {
                return Response::Message("There's no favorite Movies or Series to show.",200);
            }
        } else {
            return Response::Message("User Not Found.",401);
        }
    }

    //////////////////////////////////////////////////////////////////////
    public function RemoveFromFavoriteSeries($series_id)
    {
        $series = Series::find($series_id);
        $user = Auth::id();

        if (!$series || !$user) {
            return Response::Message('Series or User not found',404);
        }

        $favorite = Favorite::where('series_id', $series_id)
            ->where('user_id', $user)
            ->first();

        if (!$favorite) {
            return Response::Message('Series is not in your favorites',404);
        }

        $favorite->delete();

        return Response::Message('Series removed from favorites successfully',200);
    }

    //////////////////////////////////////////////////////////////////////

    public function RemoveFromFavoriteMovie($movie_id)
    {
        $movie = Series::find($movie_id);
        $user = Auth::id();

        if (!$movie || !$user) {
            return Response::Message('Movies or User not found',404);
        }

        $favorite = Favorite_Movie::where('movie_id', $movie_id)
            ->where('user_id', $user)
            ->first();

        if (!$favorite) {
            return Response::Message('Movies is not in your favorites',404);
        }

        $favorite->delete();

        return Response::Message('Movie removed from favorites successfully',200);
    }

}
