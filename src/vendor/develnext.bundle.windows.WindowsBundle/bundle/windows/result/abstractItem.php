<?php
namespace bundle\windows\result;

abstract class abstractItem
{
    /**
     * Ключ
     * @var string
     * @readonly
     */
    public $key;

    /**
     * Значение
     * @var string
     * @readonly
     */
    public $value;

    public function __construct($key, $value){
        $this->key = $key;
        $this->value = $value;
    }

    public function __toString(){
        return (string) $this->value;
    }

    /**
     * Key name.
     * --RU--
     * Название ключа.
     * @return string
     */
    public function getKey(){
        return $this->key;
    }

    /**
     * Value.
     * --RU--
     * Значение.
     * @return string
     */
    public function getValue(){
        return $this->value;
    }

    /**
     * [key => value]
     * @return array
     */
    public function toArray(){
        return [$this->key => $this->value];
    }
}