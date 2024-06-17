<?php

use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowMovieController;
use App\Http\Controllers\ShowSeriesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Apis Auth :
Route::post('/register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/EmailVerified/UserID/{id}', [AuthController::class, 'EmailVerified']);
Route::post('/forgotPassword', [AuthController::class, 'forgotPassword']);
Route::post('/CheckCodePassword/UserID/{id}', [AuthController::class, 'CheckCodePassword']);
Route::post('/updatePassword/UserID/{id}', [AuthController::class, 'updatePassword']);


Route::group(['middleware'=>'auth'],function (){

    //Show Movie Only :
    Route::get('/movies/MovieId/{id}', [ShowMovieController::class, 'ShowMovie']);

    //Show Movies New (Last 10 Add) :
    Route::get('/moviesnew', [ShowMovieController::class, 'Last10Movie']);

    //Show Series :
    Route::get('/Serie/SerieId/{id}', [ShowSeriesController::class, 'ShowSerie']);

    //Show Series new (Last 10 Add) :
    Route::get('/Seriesnew', [ShowSeriesController::class, 'Last10Series']);

    //Show Series Episodes :
    Route::get('/ShowSeriesEpisodes/Series/{idSeries}', [ShowSeriesController::class, 'ShowSeriesEpisodes']);

    //Get top 5 rated movies :
    Route::get('/movies/topRate', [ShowMovieController::class, 'topRatedMovies']);

    //Get top 5 rated series :
    Route::get('/series/topRate', [ShowSeriesController::class, 'topRatedSeries']);

    //Search By Movie :
    Route::get('/SearchByMovie/Movie/{MovieName}', [SearchController::class, 'SearchByMovie']);

    //Search By Series :
    Route::get('/SearchBySeries/Series/{SeriesName}', [SearchController::class, 'SearchBySeries']);

    //Search By Series and Movie :
    Route::get('/Search/{SearchName}', [SearchController::class, 'SearchAll']);

    //Add Series To Favorite :
    Route::post('/AddToFavoriteSeries/Series/{SeriesId}', [UserController::class, 'AddToFavoriteSeries']);

    //Add Movie To Favorite :
    Route::post('/AddToFavoriteMovie/Movie/{MovieId}', [UserController::class, 'AddToFavoriteMovie']);

    //Get Favorite Movie :
    Route::get('/GetFavoriteMovie', [UserController::class, 'GetFavoriteMovie']);

    //Get Favorite Series:
    Route::get('/GetFavoriteSeries', [UserController::class, 'GetFavoriteSeries']);

    //Delete series from favorite :
    Route::delete('/RemoveFromFavoriteSeries/{series_id}', [UserController::class, 'RemoveFromFavoriteSeries']);

    //Delete movie from favorite :
    Route::delete('/RemoveFromFavoriteMovie/{movie_id}', [UserController::class, 'RemoveFromFavoriteMovie']);

    //Get Favorite Series and Movie :
    Route::get('/GetFavoriteMedia', [UserController::class, 'GetFavoriteMedia']);

    //Show Movie By Category :
    Route::get('/ShowMovieByCategory/Category/{id}', [ShowMovieController::class, 'ShowMovieByCategory']);

    //Show Series By Category :
    Route::get('/ShowSeriesByCategory/Category/{id}', [ShowSeriesController::class, 'ShowSeriesByCategory']);

    //Add Comment To Movie :
    Route::post('/movies/addCommentMovie', [CommentController::class, 'addCommentMovie']);

    //Show All Comment for Movie :
    Route::get('/movies/{movieId}/comments', [CommentController::class, 'getMovieComments']);

    //Add Comment To Series :
    Route::post('/series/addCommentSerie', [CommentController::class, 'addCommentSerie']);

    //Show All Comment for Series :
    Route::get('/series/{serieId}/comments', [CommentController::class, 'getMovieSerie']);

    //Add rate To Movie :
    Route::post('/movies/rate', [RatingController::class, 'rateMovie']);

    //Add rate To Series :
    Route::post('/series/rate', [RatingController::class, 'rateSeries']);

    //Get rate for Movie:
    Route::get('/movie/rate/{id}', [RatingController::class, 'getMovieAverageRating']);

    //Get rate for series:
    Route::get('/series/rate/{id}', [RatingController::class, 'getSeriesAverageRating']);

});

///Apis For Admin:
///
Route::group(['middleware' => 'admin'], function () {
    //Add Category :
    Route::post('/Add Category', [AdminController::class, 'AddCategory']);

    //Get All Category :
    Route::get('/GetAllCategory', [AdminController::class, 'GetAllCategory']);

    //Add Movie :
    Route::post('/Add Movie', [AdminController::class, 'AddMovie']);

    //Add Series :
    Route::post('/Add Series', [AdminController::class, 'AddSeries']);

    //Add Actor :
    Route::post('/Add Actor', [AdminController::class, 'AddActor']);

    //Add Series Episodes:
    Route::post('/AddSeriesEpisodes/Series/{idSeries}', [AdminController::class, 'AddSeriesEpisodes']);

    // Delete Movie:
    Route::delete('/DeleteMovie/{id}', [AdminController::class, 'DeleteMovie']);

    // Delete Series:
    Route::delete('/DeleteSeries/{id}', [AdminController::class, 'DeleteSeries']);

    // Delete Actor:
    Route::delete('/DeleteActor/{id}', [AdminController::class, 'DeleteActor']);

    // Delete Series Episode:
    Route::delete('/DeleteSeriesEpisode/{id}', [AdminController::class, 'DeleteSeriesEpisode']);

    // Delete Series Episode:
    Route::delete('/DeleteCategory/{id}', [AdminController::class, 'DeleteCategory']);

    // Update Category:
    Route::put('/UpdateCategory/{id}', [AdminController::class, 'UpdateCategory']);

    // Update Series:
    Route::post('/UpdateSeries/{id}', [AdminController::class, 'UpdateSeries']);

    // Update Movie:
    Route::post('/UpdateMovie/{id}', [AdminController::class, 'UpdateMovie']);

    // Update Series Episodes:
    Route::post('/UpdateSeriesEpisodes/Series/{idSeries}/Episode/{episodeId}', [AdminController::class, 'UpdateSeriesEpisodes']);

    // Update Actor:
    Route::post('/UpdateActor/Actor/{id}', [AdminController::class, 'UpdateActor']);


});

////Apis For Owner :
///
Route::group(['middleware' => 'owner'], function () {

    //Add Admin :
    Route::put('/AddAdmin', [OwnerController::class, 'AddAdmin']);

    //Delete Admin :
    Route::put('/DeleteAdmin', [OwnerController::class, 'DeleteAdmin']);

    //Show All Admins :
    Route::get('/ShowAllAdmin', [OwnerController::class, 'ShowAllAdmin']);

});
//

