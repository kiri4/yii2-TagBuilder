<?php

namespace app\components\TagBuilder;

/**
 * Универсальный сборщик тега.
 *
 * Для использования в yii2 закинуть в папку components
 * 
 * Примеры использования (examples/index.php):
 *  
 * use app\components\TagBuilder\Tag;
 *
 * echo new Tag('h1', 'Привет!', ['style' => 'color: red']);
 *
 * echo Tag::h1('Привет!', ['style' => 'color: green']);
 *
 * $tag = new Tag;
 * $tag->setTag('h1');
 * $tag->setData('Привет!');
 * $tag->setParams(['style' => 'color: blue']);
 * echo $tag->s;
 * 
 * echo Tag::h1()->setData('Привет!')->setParams(['style' => 'color: lightblue']);
 * 
 * echo Tag::ul([Tag::li('Первый пункт'), Tag::li('Второй пункт')], ['style' => 'color: orange']);
 * 
 * $tag = Tag::ul();
 * $tag->setData([Tag::li('Первый пункт'), Tag::li('Второй пункт')]);
 * $tag->setParams(['style' => 'color: lightgray']);
 * echo $tag;
 *
 * @author Kirill Serbin
 * @version 1.0
 */
class Tag extends BaseTag {

    /**
     * @var string Данные внутри тега
     */
    private $data = '';

    /**
     * @var string Наименование тег
     */
    private $tag = '';

    /**
     * @var array $params Свойства тега
     */
    private $params = [];

    /**
     * Устанавливает наименование тега.
     *
     * @param string $tag h1 a b ul ...
     * @return class $this
     */
    public function setTag(String $tag) {
        $this->tag = $tag;
        return $this;
    }

    /**
     * Начинает тег.
     *
     * @param string $template шаблон открытия
     * @return class $this
     */
    public function openTag($template = '<{tag}{params}>') {
        $params = $this->buildParams();

        $this->result[] = strtr($template, ['{tag}' => $this->tag, '{params}' => $params]);
    }

    /**
     * Завершает тег.
     *
     * @param string $template шаблон закрытия
     * @return class $this
     */
    public function closeTag($template = '</{tag}>') {
        $this->result[] = str_replace('{tag}', $this->tag, $template);
    }

    /**
     * Устанавливает данные, которые необходимо завернуть в тег.
     *
     * @param string $data данные могут быть текстом или массивом из других тегов
     * @return class $this
     */
    public function setData($data) {
        if (is_array($data))
            $this->data = implode("\r\n", $data);
        else
            $this->data = $data;
        
        return $this;
    }

    /**
     * Устанавливает свойства тега.
     *
     * @param array $params массив из свойств тега ['style'=>'..', 'id'=>'..',...]
     * @return class $this
     */
    public function setParams(array $params = array()) {
        $this->params = $params;
        return $this;
    }

    private function buildParams() {
        foreach ($this->params as $key => $val)
            $params .= ' ' . $key . '="' . $val . '"';

        return $params;
    }

    /**
     * Сборщик тега.
     * 
     *  @return string Html
     */
    public function build() {
        $this->openTag();
        $this->result[] = $this->data;
        $this->closeTag();
        return implode("\r\n", $this->result);
    }

}
