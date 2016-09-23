<?php
namespace ch\rammler\slim\group;

use ch\rammler\DB;
use Slim\App;

class Mitgliederportrait {

    static $mitgliederportrait_sql = '
        SELECT m.id, m.vorname, m.nachname,
          (SELECT DISTINCT true FROM mitgliederportrait_antwort WHERE mitgliederportrait_antwort.fk_mitglied=m.id) AS hat_geantwortet,
          (
            SELECT ft.termin  FROM fototermin_mitglied AS fm
            LEFT JOIN fototermin AS ft ON fm.fk_termin=ft.id
            WHERE fm.fk_mitglied=m.id
          ) AS fototermin
          FROM mitglied AS m
    ';

    private $app;

    public function __construct(App $app) {
        $this->app = $app;
        $this->initRoute();
    }

    private function initRoute() {
        $this->app->group('/ch/rammler/mitgliederportrait', function () {
            $this->get('/', function ($request, $response, $args) {
                $res = DB::instance()->fetchRowMany(Mitgliederportrait::$mitgliederportrait_sql . ' WHERE m.id NOT IN (6, 19, 20, 26, 32)');
                for($i = 0; $i < count($res); $i++) {
                    $id_lr = $res[$i]['id'] + ($i%2 == 0 ? "r" : "l");
                    $res[$i]['thumb'] = $this->router->pathFor('mitglied.thumb', ['id' => $id_lr]);
                    $res[$i]['detail'] = $this->router->pathFor('mitgliederportrait', ['id' => $res[$i]['id']]);
                }
                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
            $this->get('/{id:[0-9]+}', function ($request, $response, $args) {
                $res = DB::instance()->fetchRow(Mitgliederportrait::$mitgliederportrait_sql . ' WHERE m.id=:id', ['id' => $args['id']]);

                $res['fragebogen'] = DB::instance()->fetchRowMany(
                    'SELECT f.frage, a.antwort FROM mitgliederportrait_frage AS f 
                    INNER JOIN mitgliederportrait_antwort AS a ON f.id=a.fk_frage
                    WHERE fk_saison=1 AND fk_mitglied=:id
                    ORDER BY f.id;'
                    , ['id' => $args['id']]);

                $res['image'] = $this->router->pathFor('mitglied.bild', ['id' => $res['id']]);

                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            })->setName('mitgliederportrait');
            $this->get('/fragen', function ($request, $response, $args) {
                $res = DB::instance()->fetchRowMany('SELECT * FROM mitgliederportrait_frage');
                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
            $this->get('/{id:[0-9]+}/antworten', function ($request, $response, $args) {
                $res = DB::instance()->fetchRowMany('SELECT * FROM mitgliederportrait_antwort WHERE fk_mitglied='.$args['id']);
                $response = $response->withHeader('Content-Type', 'a    pplication/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
            $this->put('/{id:[0-9]+}/antworten', function ($request, $response, $args) {
                $fehler = false;
                $antworten = $request->getParsedBody();
                foreach($antworten as $antwort) {
                    if(!DB::instance()->ExecuteSQL('INSERT INTO mitgliederportrait_antwort (antwort, fk_frage, fk_mitglied) VALUES ("'.$antwort['antwort'].'",'.$antwort['frage'].','.$args['id'].')')) {
                        $fehler = true;
                    }
                }
                if($fehler) {
                    $response = $response->withStatus(500);
                } else {
                    $response = $response->withStatus(201);
                }
                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode("", JSON_UNESCAPED_SLASHES));
            });
            $this->get('/fototermin', function ($request, $response, $args) {
                $res = DB::instance()->fetchRowMany('SELECT * FROM fototermin');
                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
            $this->put('/{id:[0-9]+}/fototermin/{terminid:[0-9]+}', function ($request, $response, $args) {
                if(DB::instance()->ExecuteSQL('INSERT INTO fototermin_mitglied (fk_mitglied, fk_termin) VALUES ('.$args['id'].','.$args['terminid'].')')) {
                    $response = $response->withStatus(201);
                } else {
                    $response = $response->withStatus(500);
                }
                return $response->write(json_encode("", JSON_UNESCAPED_SLASHES));
            });
        });
    }
}