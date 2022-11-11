<?php

namespace App\Exceptions;

use Exception;

class CategoryNotFoundException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json([
            'error' =>[
                'code' => 404,
                'title' => 'Category Not Fund',
                'details' => 'Unable to Locate the category with the given Information',
            ]
        ],404);
    }
}
