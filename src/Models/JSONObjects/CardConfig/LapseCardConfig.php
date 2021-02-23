<?php


namespace AnkiSDK\Models\JSONObjects\CardConfig;



class LapseCardConfig extends CardConfig
{
    /** @var float[] */
    public $delays = [10.0];
    public int $leechAction = 1;
    public int $leechFails = 1;
    public int $minInt = 1;
    public float $mult = 0.0;
}
