<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HomeController
{
    /**
     * Display the home page.
     *
     * @param  Request $request
     * @param  Response $response
     * @param  array  $args
     * @return Response
     */
    public function __invoke(Request $request)
    {
        // db('users')->get();

        return view('home');
    }
}
