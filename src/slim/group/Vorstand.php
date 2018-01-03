<?php
namespace ch\rammler\slim\group;

use ch\rammler\DB;
use Slim\App;

class Vorstand {

    private $app;

    public function __construct(App $app) {
        $this->app = $app;
        $this->initRoute();
    }

    private function initRoute() {
        $this->app->group('/ch/rammler/vorstand', function () {
            $this->get('', function ($request, $response, $args) {
                $res = DB::instance()->fetchRowMany("SELECT m.id, v.funktion, v.adresse, v.telefon, v.email, CONCAT(m.vorname, ' ', m.nachname) AS name FROM vorstand AS v INNER JOIN mitglied AS m ON v.fk_mitglied=m.id ORDER BY v.reihenfolge");
                for($i = 0; $i < count($res); $i++) {
                    $res[$i]['thumb'] = $this->router->pathFor('mitglied.bild.small', ['id' => $res[$i]['id']]);
                }
                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
        });
    }
}