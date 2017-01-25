<?php
namespace bundle\windows\result;

class taskItem
{
    /**
     * Имя процесса
     * @var string
     * @readonly
     */
    public $name;

    public function __construct($name, $type, $value)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * [key, type, value].
     * @return array
     */
    public function toArray()
    {
        return ['key' => $this->key, 'type' => $this->type, 'value' => $this->value];
    }
}