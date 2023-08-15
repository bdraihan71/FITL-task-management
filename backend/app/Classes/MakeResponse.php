<?php 

namespace App\Classes;

class MakeResponse
{
    public static function successResponse($message = "", $responseCode = 200, $data = [], $status = "success")
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $responseCode);
    }

    // public static function errorResponse($message = "There was some internal error", $responseCode = 500, $errors = [], $status = "failure")
    // {
    //     return response()->json([
    //         'status' => $status,
    //         'message' => $message,
    //         'errors' => $errors,
    //     ], $responseCode);
    // }

    public static function errorResponse($message = "There was some internal error", $responseCode = 500, $errors = [], $status = "failure")
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'errors' => [
                'internal_error' => [
                    $message
                ],
                $errors
            ]
        ], $responseCode);
    }
}