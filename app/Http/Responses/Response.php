<?php

namespace App\Http\Responses;

use App\Models\series;
use Illuminate\Http\JsonResponse;

class Response
{
    public static function registerSuccess($message, $data, $token,$stateCode): JsonResponse
    {
        return response()->json([
            "message" => $message,
            'data' => $data,
            'token' => $token
        ], $stateCode);
    }

    public static function loginSuccess($message, $user,$token,$stateCode): JsonResponse
    {
        return response()->json([
            "message" => $message,
            "data" => $user,
            "token" => $token
        ], $stateCode);

    }

    public static function logoutSuccess($stateCode): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Logout successfully'
        ], $stateCode);
    }

    public static function logoutFailed($stateCode): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Failed to logout..!'
        ], $stateCode);
    }

    public static function updateSuccess($message,$expert,$stateCode): JsonResponse
    {
        return response()->json([
            "massage" => "Data is updated",
            "data" => $expert
        ], $stateCode);

    }
    public static function PasswordSuccess($user,$stateCode): JsonResponse
    {
        return response()->json([
            'message' => 'The confirmation code has been sent to your email',
            'user_id' => $user,
        ], $stateCode);
    }

    public static function Message($message,$stateCode): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $stateCode);
    }

    public static function MovieMessage($movie,$stateCode): JsonResponse
    {
        return response()->json([
            'message'=>'Movie Found',
            'movie'=>$movie,
        ], $stateCode);
    }

    public static function Movie($movie,$stateCode): JsonResponse
    {
        return response()->json([
            'movie'=>$movie,
        ], $stateCode);
    }

    public static function MovieCategory($nameCategory,$movieData,$stateCode): JsonResponse
    {
        return response()->json([
            'message' => "These are all my Movies In $nameCategory",
            'Movies' => $movieData,
        ], $stateCode);
    }

    public static function SerieMessage($serie,$stateCode): JsonResponse
    {
        return response()->json([
            'message'=>'Serie Found',
            'serie'=>$serie,
        ], $stateCode);
    }

    public static function Serie($serie,$stateCode): JsonResponse
    {
        return response()->json([
            'Serie'=>$serie,
        ], $stateCode);
    }

    public static function SerieCategory($nameCategory,$seriesData,$stateCode): JsonResponse
    {
        return response()->json([
            'message' => "These are all my Series In $nameCategory",
            'Series' => $seriesData,
        ], $stateCode);
    }

    public static function Search($nameCategory,$data,$stateCode): JsonResponse
    {
        return response()->json([
            'message' => "Search $nameCategory by name successully.",
            "data" => $data
        ], $stateCode);
    }




}
