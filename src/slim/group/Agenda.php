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
            $this->get('', function ($request, $response) {
                $res = DB::instance()->fetchRowMany('SELECT id, name, ort, start, ende, auftritt, highlight FROM agenda where start > SUBDATE(NOW(), 1) AND (ende > SUBDATE(NOW(), 1) OR ende IS NULL) order by start, ende, ordnung');
                for($i = 0; $i < count($res); $i++) {
                    $res[$i]['datum'] = DateHelper::getAgendaDate($res[$i]['start'], $res[$i]['ende']);
                }
                return $response->withJson($res);
            });
        });
    }
}
