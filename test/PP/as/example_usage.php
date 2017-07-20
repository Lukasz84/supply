<?php

// we want to make sure there are no errors of any kind, do not need this in production
error_reporting(E_ALL | E_STRICT);

require_once 'PolishPostTracking/Autoloder.php';

try {

    $PolishPostApi   = new \PolishPostTracking\Api;
    $packageTracking = $PolishPostApi->checkPackage('00459007731185405357');

$array = json_decode(json_encode($packageTracking), True);

print_r($array);
   //echo $packageTracking['danePrzesylki']['dataNadania'];
} catch (\PolishPostTracking\Exception $E) {

    // in production inform admin by email, save to log file
    echo $E->getMessage();
}

