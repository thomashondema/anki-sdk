<?php


namespace AnkiSDK\Models\JSONObjects;


use ArrayObject;

class Conf extends JsonMapperCast
{
    const VALIDJSON = '{"activeDecks":[1],"curDeck":1,"nextPos":1,"schedVer":1,"sortBackwards":false,"newSpread":0,"sortType":"noteFld","curModel":1613975451147,"addToCur":true,"timeLim":0,"estTimes":true,"dayLearnFirst":false,"dueCounts":true,"collapseTime":1200}';

    public int $curDeck;
    /** @var int[] */
    public $activeDecks;
    public int $newSpread = 0;
    public int $nextPos;
    public int $schedVer;
    public bool $sortBackwards = false;
    public string $sortType = "noteFld";
    public int $curModel;
    public int $timeLim = 0;
    public int $collapseTime = 1200;
    public bool $addToCur = true;
    public bool $dueCounts = true;
    public bool $dayLearnFirst = false;
}
