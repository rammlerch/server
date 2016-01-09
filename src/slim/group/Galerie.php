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
            $this->get('/{id}', function ($request, $response, $args) {
                $response = $response->withHeader('Content-Type', 'application/json');
                $res = DB::instance()->fetchRow('SELECT id, name FROM galerie WHERE id=:id', ['id' => $args['id']]);
                $res_bilder = DB::instance()->fetchRowMany('SELECT id, name FROM bild WHERE fk_galerie=:id', ['id' => $res['id']]);
                for($i = 0; $i < count($res_bilder); $i++) {
                    $res_bilder[$i]['url'] = $this->router->pathFor('galerie.bild', ['galerie' => $res['id'],'name' => $res_bilder[$i]['name']]);
                    $res_bilder[$i]['thumbUrl'] = $this->router->pathFor('galerie.thumb', ['galerie' => $res['id'], 'name' => $res_bilder[$i]['name']]);
                }
                $res['bilder'] = $res_bilder;
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
            $this->get('/{galerie}/bild/{name}', function ($request, $response, $args) {
                $image = '../galerie/' . $args['galerie'] . '/' . $args['name'] . '.jpg';
                $response = $response->withHeader('Content-Type', 'image/jpg');
                return $response->write(file_get_contents($image));
            })->setName('galerie.bild');
            $this->get('/{galerie}/thumb/{name}', function ($request, $response, $args) {
                $image = '../galerie/' . $args['galerie'] . '/thumbs/' . $args['name'] . '.jpg';
                $response = $response->withHeader('Content-Type', 'image/jpg');
                return $response->write(file_get_contents($image));
            })->setName('galerie.thumb');

        });
    }
}