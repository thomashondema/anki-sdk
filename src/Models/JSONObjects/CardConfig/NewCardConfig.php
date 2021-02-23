<?php


namespace AnkiSDK\Models\JSONObjects\CardConfig;


class NewCardConfig extends CardConfig
{
    /** @var float[] */
    public $delays = [1.0, 10.0];
    public int $initialFactor = 2500;
    public $ints = [1, 4, 0];
    public int $order = 1;
    public int $perDay = 20;
}
