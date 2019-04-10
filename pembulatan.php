<?php

$sec = 6345;
$after = fuckTheTime($sec);

echo "Before : " . objectFromSecond($sec)->format("H:i:s") . "\n";
echo "After : " . objectFromSecond($after)->format("H:i:s");

function fuckTheTime($sec)
{
    $finalSec = $sec;

    $dateTimeObject = datetime::createfromformat("H:i:s", gmdate("H:i:s", $sec));

    $spec = [
        'hour' => 12,
        'min' => 30,
        'sec' => 30
    ];

    # reset detik, terus ditambah 1 menit
    if ((int) $dateTimeObject->format('s') >= $spec['sec']) {
        $finalSec -= $dateTimeObject->format('s');
        $finalSec += 60;
    }
    
    # Reset menit, terus ditambah 1 jam
    if ((int) $dateTimeObject->format('i') >= $spec['min']) {
        $finalSec -= $dateTimeObject->format('i') * 60;
        $finalSec += 3600;
    }

    return $finalSec;
}

function objectFromSecond($sec)
{
    return datetime::createfromformat("H:i:s", gmdate("H:i:s", $sec));
}