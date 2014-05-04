<?php

namespace General;

class DateClass {

    public function dateFormatBeforeInsert($date) {
        if (trim($date) == '') {
            return '';
        }
        list($day, $month, $year) = explode('/', $date);
        return $year . $month . $day;
    }

    public function dateFormatBeforeDisplay($date) {
        if ($date == 0) {
            return ' ';
        }
        $year = substr($date, 0, 4);
        $month = substr($date, 4, 2);
        $day = substr($date, 6, 2);
        return $day . '/' . $month . '/' . $year;
    }

    function dateCheck($date, $action) {
        if ($action == 'positionStartDate' or $action == 'positionEndDate') {
            if (trim($date) == '') {
                return "true";
            }
        }

        $date = explode('/', $date);
        if (count($date) != 3) {
            return "format";
        } elseif (is_numeric($date[0]) and is_numeric($date[1]) and is_numeric($date[2])) {
            $date[2] = $date[2] - 543;
            if (checkdate($date[1], $date[0], $date[2])) {
                if ($action == "birth_date") {
                    if ($date[2] > 1800 and $date[2] < date("Y")) {
                        return "true";
                    } else {
                        return "length";
                    }
                } else {
                    if ($date[2] > 1800) {
                        return "true";
                    } else {
                        return "length";
                    }
                }
            } else {
                return "notFound";
            }
        } else {
            return "format";
        }
    }

}
