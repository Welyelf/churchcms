<?php defined('BASEPATH') OR exit('No direct script access allowed');

function ordinal($num)
{
    if(!is_int($num) || $num<1){
        return '';
    }else {
        $last = substr($num, -1);
        if ($last > 3 or
            $last == 0 or
            ($num >= 11 and $num <= 19)) {
            $ext = 'th';
        } else if ($last == 3) {
            $ext = 'rd';
        } else if ($last == 2) {
            $ext = 'nd';
        } else {
            $ext = 'st';
        }
        return $num . $ext;
    }
}

function whole_number($number, $defaultNum)
{
    $newNumber = 1;
    if (is_numeric($number) && $number != null && $number > 0) {
        $newNumber = round($number,0,PHP_ROUND_HALF_EVEN);
    } else {
        if (is_numeric($defaultNum) && $defaultNum != null && $defaultNum>0) {
            $newNumber = round($defaultNum,0,PHP_ROUND_HALF_EVEN);
        }else{
            $newNumber=0;
        }
    }
    return $newNumber;
}

function get_other_order($index)
{
    $order_others = array('first', 'second', 'third', 'fourth', 'fifth', 'last');
    if($index<0 || $index>=count($order_others)){
        $index=0;
    }else if(!is_int($index)){
        $index=0;
    }
    return $order_others[$index];
}

function get_event_recurrence($index)
{
    $event_recurrence = array('none', 'daily', 'weekly', 'monthly', 'yearly', 'others');
    if($index<0 || $index>=count($event_recurrence) || !is_int($index)){
        $index=0;
    }
    return $event_recurrence[$index];
}

function get_month($index=0)
{
    $months = array('','January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    if($index<0 || $index>12 || !is_int($index) ){
        $index=0;
    }
    return $months[$index];
}

function get_week_day($index=0)
{
    $weekdays = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    if($index<0 || $index>=count($weekdays) || !is_int($index)){
        $index=0;
    }
    return $weekdays[$index];
}

// haven't used in the codebase
function sortByTime($a, $b)
{
    $a = strtotime($a->time);
    $b = strtotime($b->time);
    return $a - $b;
}

function get_12_hour($time)
{

    if(is_int($time)){
        if($time<25 && $time>0){
            if ($time > 12) {
                $time = $time - 12;
                $meridian = ' pm';
            }else{
                $meridian = ' am';
            }
            return sprintf("%02d", $time) . ':' . '00' . $meridian;
        }else{
            return "";
        }

    }else{
        $temp = explode(':', $time);
        $hour = $temp[0];
        $meridian = ' am';

        if ($hour > 12) {
            $hour = $hour - 12;
            $meridian = ' pm';
        }
        return $hour . ':' . $temp[1] . $meridian;
    }


}