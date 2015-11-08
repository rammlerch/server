<?php
namespace ch\rammler\slim\group;


use ch\rammler\DateHelper;
use ch\rammler\DB;
use Slim\App;

class Agenda {

    private $app;

    public function __construct(App $app) {
        $this->app = $app;
        $this->initRoute();
    }

    private function initRoute() {
        $this->app->group('/ch/rammler/agenda', function () {
            $this->get('/', function ($request, $response, $args) {
                $res = DB::instance()->fetchRowMany('SELECT id, name, ort, start, ende, auftritt FROM agenda where start > SUBDATE(NOW(), 1) AND (ende > SUBDATE(NOW(), 1) OR ende IS NULL) order by start, ende');
                for($i = 0; $i < count($res); $i++) {
                    $res[$i]['datum'] = DateHelper::getAgendaDate($res[$i]['start'], $res[$i]['ende']);
                    $res[$i]['link'] = $this->router->pathFor('agenda.entry', ['id' => $res[$i]['id']]);
                }
                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            })->setName('ist');
            $this->get('/{id}', function ($request, $response, $args) {
                $res = DB::instance()->fetchRow('SELECT id, name, ort FROM agenda where id=:id', ['id' => $args['id']]);
                $res['_href'] = $this->router->pathFor('agenda.entry', ['id' => $res['id']]);
                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            })->setName('agenda.entry');
            $this->delete('/{id}', function ($request, $response, $args) {
                $res = DB::instance()->delete('agenda', ['id' => $args['id']]);
                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });

        });
    }
}