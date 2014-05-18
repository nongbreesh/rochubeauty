<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('costshipping')) {

    function costshipping($weight) {
        if ($weight < 250) {
            return 42;
        } elseif ($weight < 500) {
            return 52;
        } elseif ($weight < 1000) {
            return 67;
        } elseif ($weight < 1500) {
            return 82;
        } elseif ($weight < 2000) {
            return 97;
        } elseif ($weight < 2500) {
            return 122;
        } elseif ($weight < 3000) {
            return 137;
        } elseif ($weight < 3500) {
            return 157;
        } elseif ($weight < 4000) {
            return 177;
        } elseif ($weight < 4500) {
            return 197;
        } elseif ($weight < 5000) {
            return 217;
        } else {
            return 250;
        }
    }

}
if (!function_exists('costbox')) {

    function costbox($weight) {
       if ($weight < 100) {
            return 11;
        } elseif ($weight < 500) {
            return 12;
        } elseif ($weight < 1000) {
            return 16;
        } elseif ($weight < 1500) {
            return 24;
        } elseif ($weight < 2000) {
            return 35;
        } elseif ($weight < 2500) {
            return 50;
        } elseif ($weight < 3000) {
            return 50;
        } elseif ($weight < 3500) {
            return 65;
        } elseif ($weight < 4000) {
            return 65;
        } elseif ($weight < 4500) {
            return 80;
        } elseif ($weight < 5000) {
            return 80;
        } else {
            return 100;
        }
    }

}
if (!function_exists('checkword')) {

    function checkword($title) {
        $title = preg_replace("/[\"\']/", "-", $title);
        $title = stripslashes($title);
        $title = str_replace("-", "", $title);
        $title = str_replace(" ", "-", $title);
        $title = str_replace(".", "-", $title);
        $title = str_replace("(", "", $title);
        $title = str_replace(")", "", $title);
        $title = str_replace(",", "", $title);
        $title = str_replace("+", "", $title);
        $title = str_replace("*", "", $title);
        $title = str_replace("--", "-", $title);
        $title = str_replace('"', "-", $title);
        $title = str_replace('/', "-", $title);
        $title = str_replace('&', "And", $title);
        $title = str_replace('[', "", $title);
        $title = str_replace(']', "", $title);
        $title = str_replace('?', "", $title);
        return $title;
    }

}
if (!function_exists('booltoint')) {

    function booltoint($bool) {
        if ($bool) {
            return 1;
        } else {
            return 0;
        }
    }

}