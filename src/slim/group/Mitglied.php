<?php
namespace ch\rammler\slim\group;

use ch\rammler\DB;
use Slim\App;

class Mitglied {

    private $app;

    public function __construct(App $app) {
        $this->app = $app;
        $this->initRoute();
    }

    private function initRoute() {
        $this->app->group('/ch/rammler/mitglied', function () {
            $this->get('', function ($request, $response, $args) {
                $res = DB::instance()->fetchRowMany('SELECT m.id, m.vorname, m.nachname 
                  FROM mitglied as m WHERE m.fk_status IN (1,2) ORDER BY m.vorname, m.nachname ');
                return $response->withJson($res);
            });
            $this->get('/bild/{id}', function ($request, $response, $args) {
                $img = '../galerie/mitglieder/1718/'. $args['id'] . '.jpg';
                $response = $response->withHeader('Content-Type', 'image/jpeg');
                return $response->write(file_get_contents($img));
            })->setName('mitglied.bild');
            $this->get('/thumb/{id}', function ($request, $response, $args) {
                $img = '../galerie/mitglieder/1718/t/'. $args['id'] . '.jpg';
                $response = $response->withHeader('Content-Type', 'image/jpeg');
                return $response->write(file_get_contents($img));
            })->setName('mitglied.bild.small');
        });
    }
}