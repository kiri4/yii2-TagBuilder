<?php

namespace app\components\TagBuilder;

/*
 * Base magic methods for build tag
 */

abstract class BaseTag implements TagInterface {

    function __construct(String $tag = '', $data = '', Array $params = []) {
        if ($tag) {
            $this->setTag($tag);

            if ($params)
                $this->setParams($params);

            $this->openTag();

            if ($data)
                $this->setData($data);

            $this->closeTag();
        }
    }

    function __toString() {
        return $this->build();
    }

    static function __callStatic($name, $arguments) {
        $classname = static::class;
        $tag = new $classname;
        $tag->setTag($name);
        $tag->setData($arguments[0]);
        if ($arguments[1])
            $tag->setParams($arguments[1]);
        return $tag;
    }

}
