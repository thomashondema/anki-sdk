<?php

use AnkiSDK\Models\Col;
use AnkiSDK\Models\JSONObjects\Conf;
use AnkiSDK\Models\JSONObjects\DConf;
use AnkiSDK\Models\JSONObjects\Decks;
use AnkiSDK\Models\JSONObjects\Models;
use PHPUnit\Framework\TestCase;
use AnkiSDK\Builder\Package as PackageBuilder;

class DatabaseTest extends TestCase
{
    public function testCanStoreInDatabase()
    {
        $packageBuilder = new PackageBuilder();
        $packageBuilder->createDatabase();
        $packageBuilder->seed();

        $savedCol = Col::all()->first();

        $conf = $savedCol->conf;
        $decks = $savedCol->decks;
        $dconf = $savedCol->dconf;
        $models = $savedCol->models;

        $this->assertInstanceOf(Conf::class, $conf);
        $this->assertInstanceOf(Decks::class, reset($decks));
        $this->assertInstanceOf(DConf::class, reset($dconf));
        $this->assertInstanceOf(Models::class, reset($models));
    }
}
