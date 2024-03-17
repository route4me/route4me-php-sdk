<?php

namespace Route4Me;

class Common
{
    public static function getValue($array, $item, $default = null)
    {
        return (isset($array[$item])) ? $array[$item] : $default;
    }

    public function toArray()
    {
        $params = array_filter(get_object_vars($this), function ($item) {
            return (null !== $item) && !(is_array($item) && !count($item));
        });

        return $params;
    }

    protected function fillFromArray(array $params)
    {
        foreach ($this as $key => $value) {
            if (isset($params[$key])) {
                $this->{$key} = $params[$key];
            }
        }
    }

    public static function fromArray(array $params)
    {
        $_this = new static;
        foreach ($params as $key => $value) {
            if (property_exists($_this, $key)) {
                $_this->{$key} = $value;
            }
        }
        return $_this;
    }
}
