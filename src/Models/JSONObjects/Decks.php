<?php


namespace AnkiSDK\Models\JSONObjects;


class Decks extends JsonMapperCast
{
    const VALIDJSON = "{\"1613975407029\":{\"id\":1613975407029,\"mod\":1613975407,\"name\":\"test\",\"usn\":-1,\"lrnToday\":[0,0],\"revToday\":[0,0],\"newToday\":[0,0],\"timeToday\":[0,0],\"collapsed\":false,\"browserCollapsed\":false,\"desc\":\"\",\"dyn\":0,\"conf\":1,\"extendNew\":0,\"extendRev\":0}}";
    protected $isArray = true;

    public string $name;
    public int $id;
    public int $mod;
    public int $usn;
    /** @var int[] */
    public $lrnToday;
    /** @var int[] */
    public $revToday;
    /** @var int[] */
    public $newToday;
    /** @var int[] */
    public $timeToday;
    public bool $collapsed;
    public bool $browserCollapsed;
    public int $extendNew;
    public int $extendRev;
    public string $desc;
    public int $conf;
    public int $dyn;
}
