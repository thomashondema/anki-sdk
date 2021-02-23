<?php


namespace AnkiSDK\Models\JSONObjects;


use ArrayObject;

class Models extends JsonMapperCast
{
    const VALIDJSON = '{"1613975451147":{"id":1613975451147,"name":"Basic","type":0,"mod":0,"usn":0,"sortf":0,"did":1,"tmpls":[{"name":"Card 1","ord":0,"qfmt":"{{Front}}","afmt":"{{FrontSide}}\n\n<hr id=answer>\n\n{{Back}}","bqfmt":"","bafmt":"","did":null,"bfont":"","bsize":0}],"flds":[{"name":"Front","ord":0,"sticky":false,"rtl":false,"font":"Arial","size":20},{"name":"Back","ord":1,"sticky":false,"rtl":false,"font":"Arial","size":20}],"css":".card {\n  font-family: arial;\n  font-size: 20px;\n  text-align: center;\n  color: black;\n  background-color: white;\n}\n","latexsvg":false,"req":[[0,"any",[0]]]}}';
    protected $isArray = true;

    public string $css;
    public int $did;
    /** @var \ArrayObject[Model\Field] */
    public ArrayObject $flds;
    public int $id;
    public string $latexPost;
    public string $latexPre;
    public int $mod;
    public string $name;
    public $req;
    public int $sortf;
    public string $tags;
    /** @var \ArrayObject[Model\CardTemplate] */
    public ArrayObject $tmpls;
    public int $usn;
    public $vers = [];
}




