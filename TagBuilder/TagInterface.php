<?php

/*
 * Tag Interface
 */

namespace app\components\TagBuilder;

interface TagInterface {

    function setTag(String $tag);

    function setParams(Array $params = []);

    function openTag();

    function closeTag();

    function setData($data);

    function build();
}
