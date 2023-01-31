<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function error($message, $errors = [])
    {
        return response()->json(
            ['message' => $message, 'errors' => $errors],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
