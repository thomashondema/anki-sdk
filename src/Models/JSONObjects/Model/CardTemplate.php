<?php


namespace AnkiSDK\Models\JSONObjects\Model;


class CardTemplate
{
    public string $afmt;
    public string $bafmt;
    public string $bqfmt;
    /** @var mixed|null  */
    public $did = null;
    public string $name;
    public int $ord;
    public string $qfmt;
}
