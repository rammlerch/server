<?php

namespace ch\rammler;

class VotingHelper {

    public static function vote($entryId) {
        if(VotingHelper::canVote()) {
            $data = array('ip' => $_SERVER['REMOTE_ADDR'], 'fk_eintrag' => $entryId);
            DB::instance()->insert('umfrage_stimme', $data);
        }
    }

    public static function canVote() {
        $id = DB::instance()->fetchColumn('SELECT id FROM umfrage_stimme WHERE (ip=:ip AND zeit>DATE_SUB(NOW(),INTERVAL 60 MINUTE))', array('ip' => $_SERVER['REMOTE_ADDR']));
        return $id == null;
    }

    public static function getVote($voteId, $app) {
        $res = DB::instance()->fetchRow('SELECT * FROM umfrage where id=:id', ['id' => $voteId]);
        $res['canVote'] = VotingHelper::canVote();
        $res['entries'] = array();
        $stimmen_count = 0;
        $sql = '
          SELECT e.id, e.text, COUNT(s.id) AS stimmen, m.id AS mid, m.vorname, m.nachname
          FROM umfrage_eintrag AS e
          INNER JOIN mitglied AS m ON e.foreign_id = m.id
          LEFT JOIN umfrage_stimme AS s ON e.id=s.fk_eintrag
          GROUP BY e.id
         ';
        $res_stimme = DB::instance()->fetchRowMany($sql);
        for($i = 0; $i < count($res_stimme); $i++) {
            $stimmen_count += $res_stimme[$i]['stimmen'];
            $res_stimme[$i]['thumbUrl'] = $app->router->pathFor('register.thumb', ['id' => $res_stimme[$i]['mid']]);
            $res_stimme[$i]['name'] = $res_stimme[$i]['vorname'] . " " . $res_stimme[$i]['nachname'];
            array_push($res['entries'], $res_stimme[$i]);
        }
        $res['totalStimmen'] = $stimmen_count;
        $res['canVote'] = true;
        return $res;
    }
}