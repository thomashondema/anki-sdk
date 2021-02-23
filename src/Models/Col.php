<?php


namespace AnkiSDK\Models;

use AnkiSDK\Models\JSONObjects\Conf;
use AnkiSDK\Models\JSONObjects\DConf;
use AnkiSDK\Models\JSONObjects\Decks;
use AnkiSDK\Models\JSONObjects\Models;
use Illuminate\Database\Eloquent\Model;

class Col extends Model
{
    protected $table = 'col';
    public $timestamps = false;
    protected $casts = [
        'models' => Models::class,
        'decks' => Decks::class,
        'dconf' => DConf::class,
        'conf' => Conf::class,
//        'tags' => Models::class,
    ];
}
