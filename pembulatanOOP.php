<?php

Class pembulatanOOP
{
    private $spec = [
        'hour' => 12,
        'min' => 30,
        'sec' => 30
    ];
    public function fuckTheTime($sec)
    {
        $finalSec = $sec;

        while ($this->isNotSpec($sec) == TRUE) {

            $dateTimeObject = $this->objectFromSecond($sec);

            # reset detik, terus ditambah 1 menit
            if ((int) $dateTimeObject->format('s') > $this->spec['sec']) {
                $finalSec -= $dateTimeObject->format('s');
                $finalSec += 60;
            }
            
            # Reset menit, terus ditambah 1 jam
            if ((int) $dateTimeObject->format('i') > $this->spec['min']) {
                $finalSec -= $dateTimeObject->format('i') * 60;
                $finalSec += 3600;
            }
        }

        return $finalSec;
    }

    public function objectFromSecond($sec)
    {
        return datetime::createfromformat("H:i:s", gmdate("H:i:s", $sec));
    }

    public function isNotSpec($sec)
    {

        $return = FALSE;
        $time = $this->objectFromSecond($sec);

        if ((int) $time->format('H') > $this->spec['hour']) {
            $return = TRUE;
        }

        if ((int) $time->format('i') > $this->spec['min']) {
            $return = TRUE;
        }

        if ((int) $time->format('s') > $this->spec['sec']) {
            $return = TRUE;
        }

        return $return;
    }
}

$pembulatan = new pembulatanOOP();

$sec = 3;
$after = $pembulatan->fuckTheTime($sec);

echo "Before : " . $pembulatan->objectFromSecond($sec)->format("H:i:s") . "\n";
echo "After : " . $pembulatan->objectFromSecond($after)->format("H:i:s");