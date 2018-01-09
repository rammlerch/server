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
                return $response->withJson($res);
            })->setName('rdw');
            $this->get('', function ($request, $response, $args) {
                $res = VotingHelper::getVoteList($this);
                return $response->withJson($res);
            });
            $this->get('/aktiv', function ($request, $response, $args) {
                $res = VotingHelper::getActiveVoteList($this);
                return $response->withJson($res);
            });
            $this->get('/nomination/{id:[0-9]+}', function ($request, $response, $args) {
                $res = VotingHelper::getNomination($args['id']);
                return $response->withJson($res);
            });
            $this->get('/nomination/aktuell', function ($request, $response, $args) {
                $res = VotingHelper::getActualNomination();
                return $response->withJson($res);
            });
            $this->put('/nomination/aktuell', function ($request, $response, $args) {
                $data = $request->getParsedBody();
                if("CandyShop18" != $data['passwort']) {
                    $response = $response->withStatus(403);
                } else {
                    VotingHelper::nominate($data);
                }
                // TODO return $response->withJson(xxx);
                return $response->write(json_encode("", JSON_UNESCAPED_SLASHES));
            });
        });
        $this->app->group('/ch/rammler/vote', function () {
            $this->put('/{id}', function ($request, $response, $args) {
                VotingHelper::vote($args['id']);
                // TODO return $response->withJson(xxx);
                return $response->write(json_encode("", JSON_UNESCAPED_SLASHES));
            });
        });
    }
}
