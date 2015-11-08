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
            $this->get('/{id}/bild', function ($request, $response, $args) {
                $res = DB::instance()->fetchRowMany('SELECT id, name, sequence, active, fk_gallery FROM pictures where fk_gallery = :id', ['id' => $args['id']]);
                for($i = 0; $i < count($res); $i++) {
                    $res[$i]['_img'] = 'images/gallery/'.$args['id'].'/'.$res[$i]['name'];
                     $res[$i]['_thumb'] = $this->router->pathFor('galerie.bild', array('galerie' => $args['id'], 'name' => $res[$i]['name']));
                }
                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
            $this->get('/{galerie}/bild/{name}', function ($request, $response, $args) {
                 $response = $response->withHeader('Content-Type', 'image/jpeg');
                return $response->write(file_get_contents('./images/gallery/'.$args['galerie'].'/' . $args['name']));
            })->setName('galerie.bild');
            $this->get('/saison/${saison}', function($request, $response, $args) {
								$res = DB::instance()->fetchRowMany('SELECT * FROM gallery WHERE fk_season=:saison AND active is true ORDER BY sequence DESC, name DESC ', ['saison' => $args['saison']]);
                for($i = 0; $i < count($res); $i++) {
                    $res[$i]['_bilder'] = '/ch/rammler/galerie/'.$res[$i]['id'].'/bild';
                }
                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
        });
    }
}