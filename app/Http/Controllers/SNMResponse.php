<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SNMResponse extends Controller
{
    public function successResponse($data = [], $message = 'Success', $statusCode = 200, $extra = [])
    {
        $response = [
            'statusCode' => $statusCode,
            'message' => $message,
        ];

        // If extra keys like token are passed, merge them at the top level
        if (!empty($extra)) {
            $response = array_merge($response, $extra);
        }

        // Add data block (if any)
        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }


    public function errorResponse($errors = [], $statusCode = 400)
    {
        // If it's a ValidationError bag, extract first error message
        if (is_object($errors) && method_exists($errors, 'first')) {
            $message = $errors->first(); // Get the first validation error
        } elseif (is_array($errors)) {
            $flat = collect($errors)->flatten();
            $message = $flat->first() ?? 'Error';
        } else {
            $message = is_string($errors) ? $errors : 'Error';
        }

        return response()->json([
            'statusCode' => $statusCode,
            'message'    => $message,
        ], $statusCode);
    }
}
