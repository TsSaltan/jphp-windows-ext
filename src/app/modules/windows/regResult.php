<?
namespace app\modules\windows;

/*
 * Результатом чтения из реестра будет этот класс
 * метод toString вернёт строковое значение
 */
class regResult{
    public $key, $type, $value;
    public function __construct($key, $type, $value){
        $this->key = $key;
        $this->type = $type;
        $this->value = $value;
    }
    
    public function __toString(){
        return $this->value;
    }

    public function __toArray(){
        return ['key' => $key, 'type' => $type, 'value' => $value];
    }
}