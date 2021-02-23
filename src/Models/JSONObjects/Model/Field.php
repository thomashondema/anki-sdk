<?php

namespace AnkiSDK\Models\JSONObjects\Model;

class Field
{
    public string $font;
    /** @var mixed|null  */
    public $media;
    public string $name;
    public int $ord;
    public bool $rtl = false;
    public $size;
    public $sticky;
}
