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
            $this->get('/saison', function ($request, $response, $args) {
                $res = DB::instance()->fetchRowMany('SELECT s.* FROM saison AS s 
                  LEFT JOIN galerie AS g ON s.id=g.fk_saison 
                  GROUP BY s.id HAVING count(g.id) > 0 ORDER BY s.jahr DESC;');
                for($i = 0; $i < count($res); $i++) {
                    $res[$i]['galerie'] = $this->router->pathFor('galerie.saison', ['saison' => $res[$i]['id']]);
                }
                return $response->withJson($res);
            });
            $this->get('/saison/{saison:[0-9]+}', function ($request, $response, $args) {
                $res = DB::instance()->fetchRowMany('SELECT g.id, g.name, g.ort, b.name AS bild_name 
                  FROM galerie AS g LEFT JOIN bild AS b ON g.id=b.fk_galerie WHERE b.id > 0 AND g.fk_saison=:saison 
                  GROUP BY g.id ORDER BY g.datum DESC', $args);
                for($i = 0; $i < count($res); $i++) {
                    $res[$i]['thumbUrl'] = $this->router->pathFor('galerie.thumb', ['galerie' => $res[$i]['id'], 'name' => $res[$i]['bild_name']]);
                }
                return $response->withJson($res);
            })->setName('galerie.saison');
            $this->get('/{id:[0-9]+}', function ($request, $response, $args) {
                $response = $response->withHeader('Content-Type', 'application/json');
                $res = DB::instance()->fetchRow('SELECT id, name FROM galerie WHERE id=:id', ['id' => $args['id']]);
                $res_bilder = DB::instance()->fetchRowMany('SELECT id, name FROM bild WHERE fk_galerie=:id ORDER BY datum ASC', ['id' => $res['id']]);
                for($i = 0; $i < count($res_bilder); $i++) {
                    $res_bilder[$i]['url'] = $this->router->pathFor('galerie.bild', ['galerie' => $res['id'],'name' => $res_bilder[$i]['name']]);
                    $res_bilder[$i]['thumbUrl'] = $this->router->pathFor('galerie.thumb', ['galerie' => $res['id'], 'name' => $res_bilder[$i]['name']]);
                }
                $res['bilder'] = $res_bilder;
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            })->setName('galerie');
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