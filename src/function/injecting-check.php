<?php

$checks = ['INSERT', 'insert', 'UPDATE', 'update', 'DELETE', 'delete', 'SELECT', 'select'];

function multi_strpos($string, $check, $getResults = false)
{
    $result = array();
    $check = (array)$check;

    foreach ($check as $s) {
        $pos = strpos($string, $s);

        if ($pos !== false) {
            if ($getResults) {
                $result[$s] = $pos;
            } else {
                return $pos;
            }
        }
    }

    return empty($result) ? false : $result;
}