<?php

namespace ch\rammler\slim\group;

use Slim\App;

class Sponsor {

    private $app;

    public function __construct(App $app) {
        $this->app = $app;
        $this->initRoute();
    }

    private function initRoute() {
        $this->app->group('/ch/rammler/sponsor', function () {
            $this->get('/', function ($request, $response, $args) {
            	
            	$hauptsponsor = new \stdClass();
            	$hauptsponsor->image = $this->router->pathFor('sponsor.bild', ['name' => 'gd.png']);
            	$hauptsponsor->url = 'http://www.gdnet.ch/';
            	
            	$sponsoren = array();
            	$sponsoren_hecht = new \stdClass();
            	$sponsoren_hecht->image = $this->router->pathFor('sponsor.bild', ['name' => 'hecht.svg']);
            	$sponsoren_hecht->url = 'http://hecht-holzbau.ch/';
            	$sponsoren_hecht->active = true;
            	array_push($sponsoren, $sponsoren_hecht);
            	$sponsoren_computerline = new \stdClass();
            	$sponsoren_computerline->image = $this->router->pathFor('sponsor.bild', ['name' => 'computerline.png']);
            	$sponsoren_computerline->url = 'http://www.computerline.com/';
            	$sponsoren_computerline->active = false;
            	array_push($sponsoren, $sponsoren_computerline);
            	$sponsoren_intercheese = new \stdClass();
            	$sponsoren_intercheese->image = $this->router->pathFor('sponsor.bild', ['name' => 'intercheese.png']);
            	$sponsoren_intercheese->url = 'http://www.intercheese.ch/';
            	$sponsoren_intercheese->active = false;
            	array_push($sponsoren, $sponsoren_intercheese);
            	
            	$object = new \stdClass();
            	$object->hauptsponsor = $hauptsponsor;
            	$object->sponsoren = $sponsoren;

            	$response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($object, JSON_UNESCAPED_SLASHES));
            });
            $this->get('/bild/{name}', function ($request, $response, $args) {
            	if($args['name'] == 'hecht.svg') {
                 	$response = $response->withHeader('Content-Type', 'image/svg+xml');
            	} else {
                 	$response = $response->withHeader('Content-Type', 'image/png');
            	}
                return $response->write(file_get_contents('./images/sponsor/'.$args['name']));
            })->setName('sponsor.bild');
        });
    }
}