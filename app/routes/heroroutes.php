<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//DISPLAY HEROES
$app->get('/heroes', function (Request $request, Response $response) {
    $mapper = new HeroMapper($this -> db);
    $heroes = $mapper -> getHeroes();

    $response = $this -> view -> render($response, "heroes.phtml", ["heroes" => $heroes, "router" => $this->router]);
    return $response;
});

$app->get('/heroes/new', function (Request $request, Response $response) {
    $response = $this -> view -> render($response, "heroadd.phtml");
    return $response;
});

//ADD NEW HERO
$app->post('/heroes/new', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $hero_data = [];
    $hero_data['hero_name'] = filter_var($data['hero_name'], FILTER_SANITIZE_STRING);
    $hero_data['hero_role'] = filter_var($data['hero_role'], FILTER_SANITIZE_STRING);
    $hero_data['hero_difficulty'] = filter_var($data['hero_difficulty'], FILTER_SANITIZE_STRING);
    $hero_data['hero_description'] = filter_var($data['hero_description'], FILTER_SANITIZE_STRING);
    $hero_data['hero_description_short'] = filter_var($data['hero_description_short'], FILTER_SANITIZE_STRING);
    $hero_data['hero_abilities'] = filter_var($data['hero_abilities'], FILTER_SANITIZE_STRING);
    $hero_data['hero_nationality'] = filter_var($data['hero_nationality'], FILTER_SANITIZE_STRING);
    $hero_data['hero_health'] = filter_var($data['hero_health'], FILTER_SANITIZE_STRING);
    $hero_data['hero_voice'] = filter_var($data['hero_voice'], FILTER_SANITIZE_STRING);
    $hero_data['hero_realname'] = filter_var($data['hero_realname'], FILTER_SANITIZE_STRING);
    $hero_data['hero_age'] = filter_var($data['hero_age'], FILTER_SANITIZE_STRING);
    $hero_data['hero_occupation'] = filter_var($data['hero_occupation'], FILTER_SANITIZE_STRING);
    $hero_data['hero_baseofoperations'] = filter_var($data['hero_baseofoperations'], FILTER_SANITIZE_STRING);
    $hero_data['hero_affiliation'] = filter_var($data['hero_affiliation'], FILTER_SANITIZE_STRING);
    $hero_data['hero_slogan'] = filter_var($data['hero_slogan'], FILTER_SANITIZE_STRING);
    $hero_data['hero_story'] = filter_var($data['hero_story'], FILTER_SANITIZE_STRING);
    $hero_data['hero_picturename'] = filter_var($data['hero_picturename'], FILTER_SANITIZE_STRING);

    $hero = new HeroEntity($hero_data);
    $hero_mapper = new HeroMapper($this->db);
    $hero_mapper->save($hero);
    $response = $response->withRedirect("/heroes");
    return $response;
});

$app->get('/heroes/edit/{hero_id}', function (Request $request, Response $response, $args) {
    $hero_id = (int)$args['hero_id'];
    $mapper = new HeroMapper($this -> db);
    $hero = $mapper -> getHeroById($hero_id);

    $response = $this -> view -> render($response, "heroedit.phtml", ["hero" => $hero]);
    return $response;
})->setName('hero-edit');

//EDIT HERO
$app->post('/heroes/edit/{hero_id}', function (Request $request, Response $response, $args) {
    $hero_id = (int)$args['hero_id'];
    $hero_mapper = new HeroMapper($this -> db);
    $hero = $hero_mapper -> getHeroById($hero_id);

    $data = $request->getParsedBody();
    $hero_data = [];
    $hero_data['hero_name'] = filter_var($data['hero_name'], FILTER_SANITIZE_STRING);
    $hero_data['hero_role'] = filter_var($data['hero_role'], FILTER_SANITIZE_STRING);
    $hero_data['hero_difficulty'] = filter_var($data['hero_difficulty'], FILTER_SANITIZE_STRING);
    $hero_data['hero_description'] = filter_var($data['hero_description'], FILTER_SANITIZE_STRING);
    $hero_data['hero_description_short'] = filter_var($data['hero_description_short'], FILTER_SANITIZE_STRING);
    $hero_data['hero_abilities'] = filter_var($data['hero_abilities'], FILTER_SANITIZE_STRING);
    $hero_data['hero_nationality'] = filter_var($data['hero_nationality'], FILTER_SANITIZE_STRING);
    $hero_data['hero_health'] = filter_var($data['hero_health'], FILTER_SANITIZE_STRING);
    $hero_data['hero_voice'] = filter_var($data['hero_voice'], FILTER_SANITIZE_STRING);
    $hero_data['hero_realname'] = filter_var($data['hero_realname'], FILTER_SANITIZE_STRING);
    $hero_data['hero_age'] = filter_var($data['hero_age'], FILTER_SANITIZE_STRING);
    $hero_data['hero_occupation'] = filter_var($data['hero_occupation'], FILTER_SANITIZE_STRING);
    $hero_data['hero_baseofoperations'] = filter_var($data['hero_baseofoperations'], FILTER_SANITIZE_STRING);
    $hero_data['hero_affiliation'] = filter_var($data['hero_affiliation'], FILTER_SANITIZE_STRING);
    $hero_data['hero_slogan'] = filter_var($data['hero_slogan'], FILTER_SANITIZE_STRING);
    $hero_data['hero_story'] = filter_var($data['hero_story'], FILTER_SANITIZE_STRING);
    $hero_data['hero_picturename'] = filter_var($data['hero_picturename'], FILTER_SANITIZE_STRING);

    $new_hero = new HeroEntity($hero_data);

    $hero_mapper -> edit($hero, $new_hero);
    $response = $response -> withRedirect("/heroes");
    return $response;
});

//DELETE
$app->get('/heroes/delete/{hero_id}', function (Request $request, Response $response, $args) {
    $hero_id = (int)$args['hero_id'];
    $hero_mapper = new HeroMapper($this -> db);
    $hero_mapper -> remove($hero_id);

    $response = $response -> withRedirect("/heroes");
    return $response;
})->setName('hero-delete');

//DISPLAY HERO
$app->get('/heroes/view/{hero_id}', function (Request $request, Response $response, $args) {
    $hero_id = (int)$args['hero_id'];
    $mapper = new HeroMapper($this -> db);
    $hero = $mapper -> getHeroById($hero_id);
    $response = $this -> view -> render($response, "herodetail.phtml", ["hero" => $hero]);
    return $response;
})->setName('hero-detail');

$app->post('/heroes/view/{hero_id}/next', function (Request $request, Response $response, $args) {
    $hero_id = (int)$args['hero_id'];
    $mapper = new HeroMapper($this -> db);
    if($hero_id === count($mapper->getHeroes())) {
        $hero_id = 1;
    } else {
        $hero_id = $hero_id + 1;
    }

    $response = $response -> withRedirect("/heroes/view/$hero_id");
    return $response;
});

$app->post('/heroes/view/{hero_id}/previous', function (Request $request, Response $response, $args) {
    $hero_id = (int)$args['hero_id'];
    $mapper = new HeroMapper($this -> db);
    if($hero_id === 1) {
        $hero_id = count($mapper->getHeroes());
    } else {
        $hero_id = $hero_id - 1;
    }

    $response = $response -> withRedirect("/heroes/view/$hero_id");
    return $response;
});

$app->get('/heroes/search', function (Request $request, Response $response) {
    $mapper = new HeroMapper($this -> db);
    $heroes = $mapper -> search("nosearch");

    $response = $this -> view -> render($response, "herosearch.phtml", ["heroes" => $heroes, "router" => $this->router]);
    return $response;
});

$app->post('/heroes/search', function (Request $request, Response $response, $args) {
    $data = $request -> getParsedBody();
    $search_data = filter_var($data['search'], FILTER_SANITIZE_STRING);
    if(!isset($search_data) || trim($search_data) == '') {
        $search_data = 'nosearch';
    }

    $response = $response -> withRedirect("/heroes/search/$search_data");
    return $response;
});

$app->get('/heroes/search/{search}', function (Request $request, Response $response, $args) {
    $name = $args['search'];

    $mapper = new HeroMapper($this -> db);
    $heroes = $mapper -> search($name);

    $response = $this -> view -> render($response, "herosearch.phtml", ["heroes" => $heroes, "router" => $this->router]);
    return $response;
});