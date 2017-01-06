<?php
namespace ch\rammler\slim\group;


use ch\rammler\VotingHelper;
use Slim\App;

class RammlerDerWoche {

    private $app;

    public function __construct(App $app) {
        $this->app = $app;
        $this->initRoute();
    }

    private function initRoute() {
        $this->app->group('/ch/rammler/rdw', function () {
            $this->get('/{id:[0-9]+}', function ($request, $response, $args) {

                $res = VotingHelper::getVote($args['id'], $this);

                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            })->setName('rdw');
            $this->get('/', function ($request, $response, $args) {

                $res = VotingHelper::getVoteList($this);

                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
            $this->get('/aktiv', function ($request, $response, $args) {

                $res = VotingHelper::getActiveVoteList($this);

                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
            $this->get('/nomination/aktuell', function ($request, $response, $args) {

                $res = VotingHelper::getActualNomination();

                $response = $response->withHeader('Content-Type', 'application/json');
                return $response->write(json_encode($res, JSON_UNESCAPED_SLASHES));
            });
            $this->put('/nomination/aktuell', function ($request, $response, $args) {
                $data = $request->getParsedBody();
                if("District-6231" != $data['passwort']) {
                    $response = $response->withStatus(403);
                } else {
                    VotingHelper::nominate($data);
                }
                return $response->write(json_encode("", JSON_UNESCAPED_SLASHES));
            });
        });

        $this->app->group('/ch/rammler/vote', function ($request, $response, $args) {
            $this->put('/{id}', function ($request, $response, $args) {
                VotingHelper::vote($args['id']);
                return $response->write(json_encode("", JSON_UNESCAPED_SLASHES));
            });
        });
    }
}