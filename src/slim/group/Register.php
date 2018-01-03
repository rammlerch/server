<?php
namespace ch\rammler\slim\group;

use ch\rammler\DB;
use Slim\App;

class Register {

    private $app;

    public function __construct(App $app) {
        $this->app = $app;
        $this->initRoute();
    }

    private function initRoute() {
        $this->app->get('/ch/rammler/register/{name:[a-z]+}/mitglied', function ($request, $response, $args) {
            $res = DB::instance()->fetchRowMany('SELECT m.id, m.vorname, m.nachname FROM mitglied as m inner join instrument as i on m.fk_instrument=i.id WHERE lower(i.name)=lower(:name) AND m.fk_status IN (1,2) ORDER BY m.vorname, m.nachname', ['name' => $args['name']]);
            for($i = 0; $i < count($res); $i++) {
                $res[$i]['thumb'] = $this->router->pathFor('mitglied.bild.small', ['id' => $res[$i]['id']]);
            }
            return $response->withJson($res);
        });
    }
}