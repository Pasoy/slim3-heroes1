<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//DISPLAY HEROES
$app->get('/', function (Request $request, Response $response) {
    $response = $this -> view -> render($response, "home.phtml");
    return $response;
});