<?php

use app\components\TagBuilder\Tag;

echo new Tag('h1', 'Привет!', ['style' => 'color: red']);

echo Tag::h1('Привет!', ['style' => 'color: green']);

$tag = new Tag;
$tag->setTag('h1');
$tag->setData('Привет!');
$tag->setParams(['style' => 'color: blue']);
echo $tag;

echo Tag::h1()->setData('Привет!')->setParams(['style' => 'color: lightblue']);

echo Tag::ul([Tag::li('Первый пункт'), Tag::li('Второй пункт')], ['style' => 'color: orange']);

$tag = Tag::ul();
$tag->setData([Tag::li('Первый пункт'), Tag::li('Второй пункт')]);
$tag->setParams(['style' => 'color: lightgray']);
echo $tag;

