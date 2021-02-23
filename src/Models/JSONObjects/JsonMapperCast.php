<?php

namespace AnkiSDK\Models\JSONObjects;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use JsonMapper;

class JsonMapperCast implements CastsAttributes
{
    protected $isArray = false;

    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function get($model, $key, $value, $attributes)
    {
        return $this->fromJsonString($value);
    }

    public function fromJsonString($value){
        $value = json_decode($value);
        if($this->isArray){
            return (new JsonMapper())->mapArray($value, [], static::class);
        }

        return (new JsonMapper())->map($value, $this);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        return json_encode($value);
    }
}
