<?php
namespace bundle\windows\reg;

/*
 * --RU--
 * Результатом чтения из реестра будет этот класс
 * метод toString вернёт строковое значение
 */
class regResult
{
    public $key, $type, $value;

    public function __construct($key, $type, $value)
    {
        $this->key = $key;
        $this->type = $type;
        $this->value = $value;
    }

    public function __toString()
    {
        return (string) $this->value;
    }

    /**
     * Key name.
     * --RU--
     * Название ключа.
     * @return string
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Type.
     * --RU--
     * Тип
     * @return string
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * Value.
     * --RU--
     * Значение.
     * @return string
     */
    public function value()
    {
        return $this->value;
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