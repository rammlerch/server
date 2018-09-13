<?php

namespace ch\rammler;

class DateHelper {
    public static function getDateTime($ts) {
        return DateHelper::getDate($ts) . " " . DateHelper::getTime($ts);
    }
    public static function getDate($ts) {
        if($ts == null) {
            return "";
        }
        $day = date("d", strtotime($ts));
        $month = DateHelper::getMonthFromIndex(date("m", strtotime($ts)));
        $year = date("Y", strtotime($ts));

        return $day . ". " . $month . " " . $year;
    }

    public static function getAgendaDate($from, $to) {
        if($from == null) {
            return "";
        }
        $arr = explode("-", $from);
        $day = $arr[2];
        $month = DateHelper::getMonthFromIndex($arr[1]);
        // TODO: Schöner machen !!!
        if($to != null ) {
            $fromDateTime = new \DateTime($from);
            $toDateTime = new \DateTime($to);
            $diff = $fromDateTime->diff($toDateTime);
            $split = " & ";
            if($diff->days > 1) {
                $split = " - ";
            }

            $to_arr = explode("-", $to);
            if($to_arr[0] != $arr[0]) {
                return $day . ". " . DateHelper::getMonthFromIndex($arr[1], true) . " " . substr($arr[0], 2) . $split . $to_arr[2] . ". " . DateHelper::getMonthFromIndex($to_arr[1], false) . " " .substr($to_arr[0], 2);
            }
            if($to_arr[1] != $arr[1]) {
                return $day . ". " . DateHelper::getMonthFromIndex($arr[1], true) . $split . $to_arr[2] . ". " . DateHelper::getMonthFromIndex($to_arr[1], false) . " " .$arr[0];
            }

            return $day . $split . $to_arr[2] . ". " . DateHelper::getMonthFromIndex($arr[1], true) . " " . $arr[0];
        }

        return $day . ". " . $month . " " . $arr[0];
    }


    public static function getDay($ts, $long=false) {
        return ($ts == null ? "" : DateHelper::getDayFromIndex(date("w", strtotime($ts)), $long));
    }

    public static function getMonthFromIndex($index, $long = true) {
        if($long) {
            switch($index) {
                case 1:
                    return "Januar";
                case 2:
                    return "Februar";
                case 3:
                    return "März";
                case 4:
                    return "April";
                case 5:
                    return "Mai";
                case 6:
                    return "Juni";
                case 7:
                    return "Juli";
                case 8:
                    return "August";
                case 9:
                    return "September";
                case 10:
                    return "Oktober";
                case 11:
                    return "November";
                case 12:
                    return "Dezember";
            }
        } else {
            switch($index) {
                case 1:
                    return "Jan";
                case 2:
                    return "Feb";
                case 3:
                    return "Mär";
                case 4:
                    return "Apr";
                case 5:
                    return "Mai";
                case 6:
                    return "Jun";
                case 7:
                    return "Jul";
                case 8:
                    return "Aug";
                case 9:
                    return "Sep";
                case 10:
                    return "Okt";
                case 11:
                    return "Nov";
                case 12:
                    return "Dez";
            }
        }
    }


    public static function getDayFromIndex($index, $long) {
        if($long) {
            switch($index) {
                case 0:
                    return "Sonntag";
                case 1:
                    return "Montag";
                case 2:
                    return "Dienstag";
                case 3:
                    return "Mittwoch";
                case 4:
                    return "Donnerstag";
                case 5:
                    return "Freitag";
                case 6:
                    return "Samstag";
            }
        } else {
            switch($index) {
                case 0:
                    return "So";
                case 1:
                    return "Mo";
                case 2:
                    return "Di";
                case 3:
                    return "Mi";
                case 4:
                    return "Do";
                case 5:
                    return "Fr";
                case 6:
                    return "Sa";
            }
        }
    }
    public static function getTime($ts) {
        return ($ts == null ? "" : date("H:i", strtotime($ts)));
    }
    public static function getTsFromString($str) {
        return strtotime($str);
    }

    public static function getSpielplanDate($ts) {
        return DateHelper::getDay($ts).date(", d.m.Y", strtotime($ts));
    }

    public static function getDayString($ts) {
        return DateHelper::getDay($ts, true);
    }
}
