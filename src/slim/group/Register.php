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
                $res = DB::instance()->fetchRowMany('SELECT id, vorname, nachname, spitzname, eintritt FROM mitglied WHERE fk_instrument=:id', ['id' => $args['id']]);
                for($i = 0; $i < count($res); $i++) {
                    $res[$i]['name'] = $res[$i]['vorname'] . " " . $res[$i]['nachname'];
                    $res[$i]['url'] = $this->router->pathFor('register.bild', ['id' => $res[$i]['id']]);
                    $res[$i]['thumbUrl'] = $this->router->pathFor('register.thumb', ['id' => $res[$i]['id']]);
                }
                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
            $this->get('/{name:[a-z]+}/mitglied', function ($request, $response, $args) {
                $res = DB::instance()->fetchRowMany('SELECT m.id, m.vorname, m.nachname, m.spitzname, m.eintritt FROM mitglied as m inner join instrument as i on m.fk_instrument=i.id WHERE lower(i.name)=lower(:name)', ['name' => $args['name']]);
                for($i = 0; $i < count($res); $i++) {
                    $res[$i]['name'] = $res[$i]['vorname'] . " " . $res[$i]['nachname'];
                    $res[$i]['url'] = $this->router->pathFor('register.bild', ['id' => $res[$i]['id']]);
                    $res[$i]['thumbUrl'] = $this->router->pathFor('register.thumb', ['id' => $res[$i]['id']]);
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
    }
}