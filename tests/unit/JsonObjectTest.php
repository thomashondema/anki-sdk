<?php

use AnkiSDK\Models\JSONObjects\Conf;
use AnkiSDK\Models\JSONObjects\DConf;
use AnkiSDK\Models\JSONObjects\Decks;
use AnkiSDK\Models\JSONObjects\Models;
use PHPUnit\Framework\TestCase;


class JsonObjectTest extends TestCase
{
    const INVALIDJSON = '{}';
    const INVALIDARRAYJSON = '{"1":{}}';

    public function testCanBeCreatedFromValidJson(){
        $conf = (new Conf)->fromJsonString(Conf::VALIDJSON);
        $this->assertInstanceOf(Conf::class, $conf);

        $dConf = (new DConf)->fromJsonString(DConf::VALIDJSON);
        $this->assertInstanceOf(DConf::class, reset($dConf));

        $decks = (new Decks)->fromJsonString(Decks::VALIDJSON);
        $this->assertInstanceOf(Decks::class, reset($decks));

        $models = (new Models)->fromJsonString(Models::VALIDJSON);
        $this->assertInstanceOf(Models::class, reset($models));
    }


    public function testCanNotBeCreatedFromInvalidJson(){
          $this->markTestIncomplete();
//        $conf = (new Conf)->fromJsonString(self::INVALIDJSON);
//        $this->assertNotInstanceOf(Conf::class, $conf);
//
//        $dConf = (new DConf)->fromJsonString(self::INVALIDARRAYJSON);
//        $this->assertNotInstanceOf(DConf::class, reset($dConf));
//
//        $models = (new Models)->fromJsonString(self::INVALIDARRAYJSON);
//        $this->assertNotInstanceOf(Models::class, reset($models));
//
//        $decks = (new Decks)->fromJsonString(self::INVALIDARRAYJSON);
//        $this->assertNotInstanceOf(Decks::class, reset($decks));
    }
}
