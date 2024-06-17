<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AddCategoryRequest;
use App\Http\Requests\Admin\AddMovieRequest;
use App\Http\Requests\Admin\AddSeriesEpisodesRequest;
use App\Http\Requests\Admin\AddSeriesRequest;
use App\Http\Requests\Admin\UpdateActorRequest;
use App\Http\Requests\Admin\UpdateMovieRequest;
use App\Http\Requests\Admin\UpdateSeriesEpisodesRequest;
use App\Http\Requests\Admin\UpdateSeriesRequest;
use App\Http\Responses\Response;
use App\Models\movies;
use App\Models\series;
use App\Models\Actor;
use App\Models\Series_episodes;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //////////////////////////////////////////////////////////////
    // Add Category
    public function AddCategory(AddCategoryRequest $request){
        $category=category::create([
            'description'=> $request->description
        ]);
        if($category){
            return Response::Message("Add successfully",200);
        }else{
            return Response::Message("Add failed",401);
        }
    }

    //////////////////////////////////////////////////////////////
    /// Get All Category
    public function GetAllCategory(){
        $categoeys=category::all();
        if($categoeys){
            if(count($categoeys) >= 1){
                return response()->json([
                    'message'=>"This all categorys to show",
                    'Category'=>$categoeys
                ],200);
            }else{
                return Response::Message("No Categorys To show",400);
            }

        }else{
            return Response::Message("Error",400);
        }
    }

    //////////////////////////////////////////////////////////////
    // Update Category
    public function UpdateCategory(AddCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->description =  $request->description;
            $category->save();
            return Response::Message("Category updated successfully",200);
        } else {
            return Response::Message("Category not found",404);
        }
    }

    //////////////////////////////////////////////////////////////
    // Delete Category
    public function DeleteCategory($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return Response::Message("Category deleted successfully",200);
        } else {
            return Response::Message("Category not found",404);
        }
    }

    //////////////////////////////////////////////////////////////
    // Add Movie
    public function AddMovie(AddMovieRequest $request)
    {
        $checkFormCategoryId=category::find($request->category_id);
        if(!$checkFormCategoryId){
            return Response::Message("Not Found Category",404);
        }
        $movie= movies::create([
            "title" => $request->title,
            "summary" => $request->summary,
            "release_date" => $request->release_date,
            "director" => $request->director,
            "category_id" => $request->category_id
        ]);

        if ($request->video && $request->main_image) {
            $video = $request->file('video');
            $photo=$request->file('main_image');
            if ($video->isValid() ) {
                $destination = 'Viedos/Movies/' . time() . '_' . $video->getClientOriginalName();
                $video->storeAs('public', $destination);
                $movie->video = Storage::url($destination);

                $destinationP = 'Photos/Movies/' . time() . '_' . $photo->getClientOriginalName();
                $photo->storeAs('public',$destinationP);
                $movie->main_photo=Storage::url($destinationP);
            }
        }

        $result = $movie->save();

        if ($result) {
            return Response::Message("Add successfully",200);
        } else {
            return Response::Message("Add failed",401);
        }
    }

    //////////////////////////////////////////////////////////////
    // Update Series
    public function UpdateMovie(UpdateMovieRequest $request, $id)
    {
        $movie = movies::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        $movie->title = $request->input('title', $movie->title);
        $movie->summary = $request->input('summary', $movie->summary);
        $movie->release_date = $request->input('release_date', $movie->release_date);
        $movie->director = $request->input('director', $movie->director);
        $movie->category_id = $request->input('category_id', $movie->category_id);

        if ($request->hasFile('main_image')) {
            $photo = $request->file('main_image');
            $destinationP = 'Photos/Movies/' . time() . '_' . $photo->getClientOriginalName();
            $photo->storeAs('public', $destinationP);
            $movie->main_photo = Storage::url($destinationP);
        }

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $destination = 'Viedos/Movies/' . time() . '_' . $video->getClientOriginalName();
            $video->storeAs('public', $destination);
            $movie->video = Storage::url($destination);
        }

        $result = $movie->save();

        if ($result) {
            return response()->json([
                'message' => 'Movie updated successfully',
                "Movie"=>$movie], 200);
        } else {
            return Response::Message("Update failed", 401);
        }
    }

    //////////////////////////////////////////////////////////////
    // Delete Movie
    public function DeleteMovie($id)
    {
        $movie = movies::find($id);
        if ($movie) {
            $movie->delete();
            return response()->json(['message' => 'Movie deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Movie not found'], 404);
        }
    }

    //////////////////////////////////////////////////////////////
    // Add Series
    public function AddSeries(AddSeriesRequest $request)
    {
        $checkFormCategoryId=category::find($request->category_id);
        if(!$checkFormCategoryId){
            return Response::Message("Not Found Category",404);
        }
        $series= series::create([
            "title" => $request->title,
            "summary" => $request->summary,
            "release_date" => $request->release_date,
            "director" => $request->director,
            "category_id" => $request->category_id
        ]);

        if ($request->main_image) {
            $photo=$request->file('main_image');
                $destinationP = 'Photos/series/' . time() . '_' . $photo->getClientOriginalName();
                $photo->storeAs('public',$destinationP);
            $series->main_photo=Storage::url($destinationP);
        }

        $result = $series->save();

        if ($result) {
            return Response::Message("Add successfully",200);
        } else {
            return Response::Message("Add failed",401);
        }
    }

    //////////////////////////////////////////////////////////////
    // Delete Series
    public function DeleteSeries($id)
    {
        $series = Series::find($id);
        if ($series) {
            $series->delete();
            return response()->json(['message' => 'Series deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Series not found'], 404);
        }
    }

    //////////////////////////////////////////////////////////////
    // Update Series
    public function UpdateSeries(UpdateSeriesRequest $request, $id)
    {
        $series = Series::find($id);
        if (!$series) {
            return response()->json(['message' => 'Series not found'], 404);
        }
        $series->title = $request->input('title', $series->title);
        $series->summary = $request->input('summary', $series->summary);
        $series->release_date = $request->input('release_date', $series->release_date);
        $series->director = $request->input('director', $series->director);
        $series->category_id = $request->input('category_id', $series->category_id);

        if ($request->hasFile('main_image')) {
            // Handle the main image upload
            $photo = $request->file('main_image');
            $destinationP = 'Photos/series/' . time() . '_' . $photo->getClientOriginalName();
            $photo->storeAs('public', $destinationP);
            $series->main_photo = Storage::url($destinationP);
        }

        $result = $series->save();

        if ($result) {
            return response()->json([
                'message' => 'Series updated successfully',
                "Series"=>$series], 200);
        } else {
            return Response::Message("Update failed", 401);
        }
    }

    //////////////////////////////////////////////////////////////
    // Add Series Episodes
    public function AddSeriesEpisodes(AddSeriesEpisodesRequest $request ,$idSeries){
        $check=series::find($idSeries);
        $number=$request->number_episodes;
        if($check){
            $nameSeries=$check->title;
            $checkForAddBefor=Series_episodes::where('id_series',$idSeries)
                                                ->where('number_episodes',$number)->exists();
            if($checkForAddBefor){
                return Response::Message("Add This Expisode $number to $nameSeries",200);
            }else{
                $series= Series_episodes::create([
                "number_episodes" => $request->number_episodes,
                "id_series" => $idSeries,
                 ]);

                if ($request->video && $request->photo) {
                    $video = $request->file('video');
                    $photo=$request->file('photo');
                    if ($video->isValid() ) {
                        $destination = 'Viedos/series/' . time() . '_' . $video->getClientOriginalName();
                        $video->storeAs('public', $destination);
                        $series->video = Storage::url($destination);

                        $destinationP = 'Photos/Series episodes/' . time() . '_' . $photo->getClientOriginalName();
                        $photo->storeAs('public',$destinationP);
                        $series->photo=Storage::url($destinationP);
                    }
                }
                $result = $series->save();

                if ($result) {
                    return Response::Message("Add successfully",200);

                } else {
                    return Response::Message("Add failed",401);
                }
            }

        }else{
            return Response::Message("Series Not Found",401);
        }
    }

    //////////////////////////////////////////////////////////////
    // Update Series Episodes
    public function UpdateSeriesEpisodes(UpdateSeriesEpisodesRequest $request, $idSeries, $episodeId)
    {
        $check = Series::find($idSeries);
        $episode = Series_episodes::find($episodeId);

        if ($check && $episode) {

            if($request->number_episodes){
                $episode->number_episodes = $request->number_episodes;
            }

            if ($request->hasFile('video')) {
                if ($episode->video) {
                    Storage::delete(public_path($episode->video));
                }
                $video = $request->file('video');
                if ($video->isValid()) {
                    $destination = 'Videos/series/' . time() . '_' . $video->getClientOriginalName();
                    $video->storeAs('public', $destination);
                    $episode->video = Storage::url($destination);
                }
            }

            if ($request->hasFile('photo')) {
                if ($episode->photo) {
                    Storage::delete(public_path($episode->photo));
                }
                $photo = $request->file('photo');
                if ($photo->isValid()) {
                    $destinationP = 'Photos/Series episodes/' . time() . '_' . $photo->getClientOriginalName();
                    $photo->storeAs('public', $destinationP);
                    $episode->photo = Storage::url($destinationP);
                }
            }

            $result = $episode->save();

            if ($result) {
                return response()->json([
                    'message' => 'Updated successfully',
                    "Series"=>$episode], 200);
            } else {
                return Response::Message("Update failed", 401);
            }
        } else {
            return Response::Message("Series or Episode Not Found", 401);
        }
    }

    //////////////////////////////////////////////////////////////
    // Delete Series Episode
    public function DeleteSeriesEpisode($id)
    {
        $episode = Series_episodes::find($id);
        if ($episode) {
            $episode->delete();
            return response()->json(['message' => 'Series Episode deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Series Episode not found'], 404);
        }
    }

    //////////////////////////////////////////////////////////////
    // Add Actor
    public function AddActor(Request $request)
    {
        $actor= Actor::create([
            "name" => $request->name,
            "country" => $request->country,
        ]);

        if ($request->photo) {
            $photo = $request->file('photo');
            if ($photo->isValid()) {
                $destination = 'Photos/Actors/' . time() . '_' . $photo->getClientOriginalName();
                $photo->storeAs('public', $destination);
                $actor->photo = Storage::url($destination);
            }
        }

        $result = $actor->save();

        if ($result) {
            return Response::Message("Add successfully",200);
        } else {
            return Response::Message("Add failed",401);
        }
    }

    //////////////////////////////////////////////////////////////
    // Delete Actor
    public function DeleteActor($id)
    {
        $actor = Actor::find($id);
        if ($actor) {
            $actor->delete();
            return response()->json(['message' => 'Actor deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Actor not found'], 404);
        }
    }

    //////////////////////////////////////////////////////////////
    // Update Actor
    public function UpdateActor(UpdateActorRequest $request, $id)
    {
        $actor = Actor::find($id);
        if (!$actor) {
            return Response::Message("Actor Not Found", 404);
        }

        if($request->name){
            $actor->name = $request->name;
        }
        if($request->country){
            $actor->country = $request->country;
        }
        if ($request->photo) {
            $photo = $request->file('photo');
            if ($photo->isValid()) {
                if ($actor->photo) {
                    Storage::delete(str_replace('/storage', 'public', $actor->photo));
                }

                $destination = 'Photos/Actors/' . time() . '_' . $photo->getClientOriginalName();
                $photo->storeAs('public', $destination);
                $actor->photo = Storage::url($destination);
            }
        }

        $result = $actor->save();

        if ($result) {
            return response()->json([
                'message' => 'Updated successfully',
                "Actor"=>$actor], 200);
        } else {
            return Response::Message("Update failed", 401);
        }
    }

}


