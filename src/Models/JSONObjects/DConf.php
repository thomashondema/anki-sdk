<?php


namespace AnkiSDK\Models\JSONObjects;

use AnkiSDK\Models\JSONObjects\CardConfig\LapseCardConfig;
use AnkiSDK\Models\JSONObjects\CardConfig\NewCardConfig;
use AnkiSDK\Models\JSONObjects\CardConfig\ReviewCardConfig;

class DConf extends JsonMapperCast
{
    const VALIDJSON = "{\"1\":{\"id\":1,\"mod\":0,\"name\":\"Default\",\"usn\":0,\"maxTaken\":60,\"autoplay\":true,\"timer\":0,\"replayq\":true,\"new\":{\"bury\":false,\"delays\":[1.0,10.0],\"initialFactor\":2500,\"ints\":[1,4,0],\"order\":1,\"perDay\":20},\"rev\":{\"bury\":false,\"ease4\":1.3,\"ivlFct\":1.0,\"maxIvl\":36500,\"perDay\":200,\"hardFactor\":1.2},\"lapse\":{\"delays\":[10.0],\"leechAction\":1,\"leechFails\":8,\"minInt\":1,\"mult\":0.0},\"dyn\":false}}";
    protected $isArray = true;

    public string $name;
    public int $id;
    public int $mod;
    public int $usn = 0;
    public int $maxTaken = 60;
    public bool $autoplay = true;
    public bool $replayq = true;
    public int $timer = 0;
    public bool $dyn = false;

    public LapseCardConfig $lapse;
    public ReviewCardConfig $rev;
    public NewCardConfig $new;
}
