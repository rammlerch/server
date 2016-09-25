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
        $this->app->group('/ch/rammler/register', function () {
            $this->get('/', function ($request, $response, $args) {
                $res = DB::instance()->fetchRowMany('SELECT id, name FROM instrument order by id');
                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
            $this->get('/{id:[0-9]+}/mitglied', function ($request, $response, $args) {
                $res = DB::instance()->fetchRowMany('SELECT id, vorname, nachname, spitzname, eintritt FROM mitglied WHERE fk_instrument=:id ORDER BY vorname, nachname', ['id' => $args['id']]);
                for($i = 0; $i < count($res); $i++) {
                    $res[$i]['name'] = $res[$i]['vorname'] . " " . $res[$i]['nachname'];
                    $res[$i]['url'] = $this->router->pathFor('register.bild', ['id' => $res[$i]['id']]);
                    $res[$i]['thumbUrl'] = $this->router->pathFor('register.thumb', ['id' => $res[$i]['id']]);
                    $type = $i%2 == 0 ? "r" : "l";
                    $res[$i]['thumb'] = $this->router->pathFor('mitglied.bild.small', ['id' => $res[$i]['id'], 'type' => $type]);
                    $res[$i]['type'] = $type;
                }
                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
            $this->get('/{name:[a-z]+}/mitglied', function ($request, $response, $args) {
                $res = DB::instance()->fetchRowMany('SELECT m.id, m.vorname, m.nachname, m.spitzname, m.eintritt FROM mitglied as m inner join instrument as i on m.fk_instrument=i.id WHERE lower(i.name)=lower(:name)  ORDER BY m.vorname, m.nachname', ['name' => $args['name']]);
                for($i = 0; $i < count($res); $i++) {
                    $res[$i]['name'] = $res[$i]['vorname'] . " " . $res[$i]['nachname'];
                    $res[$i]['url'] = $this->router->pathFor('register.bild', ['id' => $res[$i]['id']]);
                    $res[$i]['thumbUrl'] = $this->router->pathFor('register.thumb', ['id' => $res[$i]['id']]);
                    $type = $i%2 == 0 ? "r" : "l";
                    $res[$i]['thumb'] = $this->router->pathFor('mitglied.bild.small', ['id' => $res[$i]['id'], 'type' => $type]);
                    $res[$i]['type'] = $type;
                }
                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
            $this->get('/bild/{id}', function ($request, $response, $args) {
                $response = $response->withHeader('Content-Type', 'image/png');
                if(file_exists('./images/mitglied/'.$args['id'].'.png')) {
                    return $response->write(file_get_contents('./images/mitglied/'.$args['id'].'.png'));
                }
                return $response->write(file_get_contents('./images/mitglied/default.png'));
            })->setName('register.bild');
            $this->get('/thumb/{id}', function ($request, $response, $args) {
                $response = $response->withHeader('Content-Type', 'image/png');
                if(file_exists('./images/mitglied/small/'.$args['id'].'.png')) {
                    return $response->write(file_get_contents('./images/mitglied/small/'.$args['id'].'.png'));
                }
                return $response->write(file_get_contents('./images/mitglied/small/default.png'));
            })->setName('register.thumb');
        });
        $this->app->group('/ch/rammler/mitglied', function () {
            $this->get('/', function ($request, $response, $args) {
                // TODO: $res = DB::instance()->fetchRowMany('SELECT m.id, m.vorname, m.nachname FROM mitglied as m ORDER BY m.nachname, m.vorname');
                $res = DB::instance()->fetchRowMany('SELECT m.id, m.vorname, m.nachname FROM mitglied as m ORDER BY m.vorname, m.nachname');
                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
            $this->get('/bild/{id}/{type}', function ($request, $response, $args) {
                $img = $args['id'] . $args['type'] . '.jpg';
                if(file_exists('./images/mitglied/1617/'.$img)) {
                    $response = $response->withHeader('Content-Type', 'image/jpeg');
                    return $response->write(file_get_contents('./images/mitglied/1617/'.$img));
                }
                $response = $response->withHeader('Content-Type', 'image/png');
                return $response->write(file_get_contents('./images/mitglied/1617/default.png'));
            })->setName('mitglied.bild');
            $this->get('/bild/{id}/{type}/small', function ($request, $response, $args) {
                $img = $args['id'] . $args['type'] . '.jpg';
                if(file_exists('./images/mitglied/1617/small/'.$img)) {
                    $response = $response->withHeader('Content-Type', 'image/jpeg');
                    return $response->write(file_get_contents('./images/mitglied/1617/small/'.$img));
                }
                $response = $response->withHeader('Content-Type', 'image/png');
                return $response->write(file_get_contents('./images/mitglied/1617/small/default.png'));
            })->setName('mitglied.bild.small');
        });
    }
}