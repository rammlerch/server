<?php

namespace ch\rammler;

class VotingHelper {

    public static function vote($entryId) {
        if(VotingHelper::canVote()) {
            $data = array('ip' => $_SERVER['REMOTE_ADDR'], 'fk_eintrag' => $entryId);
            DB::instance()->insert('umfrage_stimme', $data);
        }
    }

    public static function nominate($payload) {
            $data = array('text' => $payload['text'], 'ip' => $_SERVER['REMOTE_ADDR'], 'fk_umfrage' => $payload['umfrage'], 'fk_mitglied' => $payload['mitglied']);
            DB::instance()->insert('umfrage_nomination', $data);
    }

    public static function canVote() {
        $id = DB::instance()->fetchColumn('SELECT id FROM umfrage_stimme WHERE (ip=:ip AND zeit>DATE_SUB(NOW(),INTERVAL 60 MINUTE))', array('ip' => $_SERVER['REMOTE_ADDR']));
        return $id == null;
    }

    public static function getVoteList($app) {
        $res = DB::instance()->fetchRowMany('SELECT id, titel, start, ende FROM umfrage ORDER BY start, ende');
        for($i = 0; $i < count($res); $i++) {
            $res[$i]['rel'] = $app->router->pathFor('rdw', ['id' => $res[$i]['id']]);
        }
        return $res;
    }

    public static function getActiveVoteList($app) {
        $res = DB::instance()->fetchRowMany('SELECT id, titel, (start < now()) AS isStartet, (ende < now()) AS isEnded FROM umfrage WHERE start < NOW() ORDER BY start DESC, ende DESC');
        for($i = 0; $i < count($res); $i++) {
            $res[$i]['rel'] = $app->router->pathFor('rdw', ['id' => $res[$i]['id']]);
            if($res[$i]['isEnded']) {
                $res[$i]['sieger'] = VotingHelper::getWinner($res[$i]['id'], $app);
            }
        }
        return $res;
    }

    private static function getWinner($id, $app) {
        $res = DB::instance()->fetchRow('SELECT e.*, count(s.id) AS stimmen FROM umfrage_eintrag AS e LEFT JOIN umfrage_stimme AS s ON e.id=s.fk_eintrag WHERE e.fk_umfrage=:id GROUP BY e.id ORDER BY stimmen DESC LIMIT 1',  ['id' => $id]);
        $res['thumbUrl'] = $app->router->pathFor('mitglied.bild.small', ['id' => $res['foreign_id'], 'type' => 'l']);
        return $res;
    }

    public static function getVote($voteId, $app) {
        $res = DB::instance()->fetchRow('SELECT id, titel, (start < now()) AS isStartet, (ende < now()) AS isEnded FROM umfrage where id=:id', ['id' => $voteId]);
        $res['canVote'] = $res['isStartet'] && !$res['isEnded'] && VotingHelper::canVote();
        $res['entries'] = array();
        $stimmen_count = 0;
        $sql = '
          SELECT e.id, e.text, COUNT(s.id) AS stimmen, m.id AS mid, m.vorname, m.nachname
          FROM umfrage_eintrag AS e
          INNER JOIN mitglied AS m ON e.foreign_id = m.id
          LEFT JOIN umfrage_stimme AS s ON e.id=s.fk_eintrag
          WHERE e.fk_umfrage=:umfrage
          GROUP BY e.id
         ';
        $max = 0;
        $max_id = -1;
        $res_stimme = DB::instance()->fetchRowMany($sql, ['umfrage' => $voteId]);
        for($i = 0; $i < count($res_stimme); $i++) {
            $stimmen_count += $res_stimme[$i]['stimmen'];
            $type = $i%2 == 0 ? "r" : "l";
            $res_stimme[$i]['thumbUrl'] = $app->router->pathFor('mitglied.bild.small', ['id' => $res_stimme[$i]['mid'], 'type' => $type]);
            $res_stimme[$i]['name'] = $res_stimme[$i]['vorname'] . " " . $res_stimme[$i]['nachname'];
            if($max < $res_stimme[$i]['stimmen']) {
                $max = $res_stimme[$i]['stimmen'];
                $max_id = $i;
            }
            array_push($res['entries'], $res_stimme[$i]);
        }
        if($res['isEnded']) {
            $res['winner'] = $max_id;
        }
        $res['totalStimmen'] = $stimmen_count;
        return $res;
    }

    public static function getActualNomination() {
        $array['id'] = DB::instance()->fetchColumn('SELECT id FROM umfrage_nomination_zeit WHERE (NOW() > start AND  NOW() < ende)');
        return $array;
    }

    public static function getNomination($id) {
        $array = DB::instance()->fetchRowMany('SELECT m.id, m.nachname, m.vorname FROM mitglied AS m RIGHT JOIN umfrage_nomination AS n ON m.id=n.fk_mitglied WHERE n.fk_umfrage=:id GROUP BY m.id', ["id" => $id]);
        foreach($array AS &$nom) {
            $nom['text'] = DB::instance()->fetchColumnMany('SELECT text FROM umfrage_nomination WHERE fk_mitglied=:id AND fk_umfrage=:umfrage', ["id" => $nom["id"], "umfrage" => $id]);
        }
        return $array;
    }
}
