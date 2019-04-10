<?php

$sec = 3;
$after = fuckTheTime($sec);



echo "Before : " . objectFromSecond($sec)->format("H:i:s") . "\n";
echo "After : " . objectFromSecond($after)->format("H:i:s");

function fuckTheTime($sec)
{
    $spec = [
        'hour' => 12,
        'min' => 30,
        'sec' => 30
    ];

    $finalSec = $sec;

    while (isNotSpec($sec) == TRUE) {

        $dateTimeObject = objectFromSecond($sec);

        # reset detik, terus ditambah 1 menit
        if ((int) $dateTimeObject->format('s') > $spec['sec']) {
            $finalSec -= $dateTimeObject->format('s');
            $finalSec += 60;
        }
        
        # Reset menit, terus ditambah 1 jam
        if ((int) $dateTimeObject->format('i') > $spec['min']) {
            $finalSec -= $dateTimeObject->format('i') * 60;
            $finalSec += 3600;
        }
    }

    return $finalSec;
}

function objectFromSecond($sec)
{
    return datetime::createfromformat("H:i:s", gmdate("H:i:s", $sec));
}

function isNotSpec($sec) {
    $spec = [
        'hour' => 12,
        'min' => 30,
        'sec' => 30
    ];

    $return = FALSE;
    $time = objectFromSecond($sec);

    if ((int) $time->format('H') > $spec['hour']) {
        $return = TRUE;
    }

    if ((int) $time->format('i') > $spec['min']) {
        $return = TRUE;
    }

    if ((int) $time->format('s') > $spec['sec']) {
        $return = TRUE;
    }

    return $return;
}