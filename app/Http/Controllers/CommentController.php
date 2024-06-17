<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserController\AddCommentSeriesRequest;
use App\Http\Responses\Response;
use App\Models\movies;
use App\Models\series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserController\AddCommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class CommentController extends Controller
{
    public function addCommentMovie(AddCommentRequest $request)
    {
        $movie = movies::find($request->movie_id);

        if (!$movie) {
            return Response::Message('Movie not found',404);
        }

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'movie_id' => $request->movie_id,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => 'Comment added successfully',
            'comment' => $comment
        ], 201);
    }

    //////////////////////////////////////////////////

    public function getMovieComments($movieId)
    {
        $movie = movies::find($movieId);

        if (!$movie) {
            return Response::Message('Movie not found',404);
        }

        $comments = Comment::where('movie_id', $movieId)
            ->with(['user:id,name'])
            ->get()
            ->map(function ($comment) {
                return [
                    'id_Comment' => $comment->id,
                    'user' => [
                        'id' => $comment->user->id,
                        'name' => $comment->user->name,
                    ],
                    'comment' => $comment->comment,
                    'created_at' => $comment->created_at,
                ];
            });
        if($comments->isNotEmpty()){
            return response()->json([
                'comments' => $comments
            ], 200);
        }else{
            return Response::Message("No Comment ..!",202);
        }
    }

    //////////////////////////////////////////////////

    public function addCommentSerie(AddCommentSeriesRequest $request)
    {
        $movie = movies::find($request->series_id);

        if (!$movie) {
            return Response::Message('Series not found',404);
        }

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'series_id' => $request->series_id,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => 'Comment added successfully',
            'comment' => $comment
        ], 201);
    }

    //////////////////////////////////////////////////

    public function getMovieSerie($serieId)
    {
        $series = series::find($serieId);

        if (!$series) {
            return Response::Message('Serie not found',404);
        }

        $comments = Comment::where('series_id', $serieId)
            ->with(['user:id,name'])
            ->get()
            ->map(function ($comment) {
                return [
                    'id_Comment' => $comment->id,
                    'user' => [
                        'id' => $comment->user->id,
                        'name' => $comment->user->name,
                    ],
                    'comment' => $comment->comment,
                    'created_at' => $comment->created_at,
                ];
            });
        if($comments->isNotEmpty()){
            return response()->json([
                'comments' => $comments
            ], 200);
        }else{
            return Response::Message("No Comment ..!",202);
        }
    }

}
