<?php
namespace bundle\windows\result;

use php\io\MiscStream;

class comItem extends abstractItem
{
    /**
     * --RU--
     * Порт
     * @readonly
     * @var string
     */
    public $port;

    /**
     * --RU--
     * Параметры порта
     * @var array
     * @readonly
     */
    public $params;

    public function __construct($port, $params){
        $this->port = $port;
        $this->params = $params;   
    }

     /**
     * Port
     * --RU--
     * Порт
     * @return string
     */
    public function getPort(){
        return $this->port;
    }

    /**
     * Port params
     * --RU--
     * Параметры
     * @return array
     */
    public function getParams(){
        return $this->params;
    }

    /**
     * --RU--
     * Подключиться к порту
     * @return php\io\MiscStream
     * @throws IOException
     */
    public function connect(){
        return MiscStream::of($this->port);
    }

    public function __toString(){
        return (string) $this->port;
    }

}