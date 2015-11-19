<?php
namespace ch\rammler\slim\group;

use ch\rammler\DB;
use Slim\App;

class Galerie {

    private $app;

    public function __construct(App $app) {
        $this->app = $app;
        $this->initRoute();
    }

    private function initRoute() {

        $this->app->group('/ch/rammler/galerie', function () {
            $this->get('/', function ($request, $response, $args) {
                $response = $response->withHeader('Content-Type', 'application/json');
                $array = array();
                $dir = 'images/galerie/2015_11_06/';
                foreach (scandir($dir) as $key => $value)
                {
                    if(is_file($dir . $value)) {
                        $img = new \stdClass();
                        $img->url = $this->router->pathFor('galerie.bild', array('id' => $value));
                        $img->thumbUrl = $this->router->pathFor('galerie.thumb', array('id' => $value));
                        //$array[$key] = $value;

                        array_push($array, $img);
                    }
                }
                $obj = new \stdClass();
                $obj->name = 'Jubi Kickoff';
                $obj->bilder = $array;
                return $response->write(json_encode($obj, JSON_UNESCAPED_SLASHES));
            });
            $this->get('/{id}/bild', function ($request, $response, $args) {
                $dir = 'images/galerie/2015_11_06/';
                $response = $response->withHeader('Content-Type', 'image/jpg');
                return $response->write(file_get_contents($dir . $args['id']));
            })->setName('galerie.bild');
            $this->get('/{id}/thumb', function ($request, $response, $args) {
                $dir = 'images/galerie/2015_11_06/thumbs/';
                $response = $response->withHeader('Content-Type', 'image/jpg');
                return $response->write(file_get_contents($dir . $args['id']));
            })->setName('galerie.thumb');
        });
    }
}