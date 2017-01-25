<?php
namespace bundle\windows\result;

use bundle\windows\result\abstractItem;

class registryItem extends abstractItem
{
    /**
     * Тип значения
     * @var string
     * @readonly
     */
    public $type;

    public function __construct($key, $type, $value){
        $this->type = $type;
        parent::__construct($key, $value);
    }

     /**
     * Type.
     * --RU--
     * Тип
     * @return string
     */
    public function getType(){
        return $this->type;
    }

    /**
     * [key, type, value].
     * @return array
     */
    public function toArray(){
        return ['key' => $this->key, 'type' => $this->type, 'value' => $this->value];
    }
}