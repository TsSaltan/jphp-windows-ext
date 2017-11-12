<?php
namespace bundle\windows\result;

use php\io\MiscStream;
use php\lang\Thread;
use bundle\windows\WindowsScriptHost as WSH;

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

    protected $stream;

    /**
     * --RU--
     * Подключиться к порту
     * @param string $mode='w+'
     * @return php\io\MiscStream
     * @throws IOException
     */
    public function connect($mode = 'w+'){ // w+ read + write
        return $this->stream = MiscStream::of($this->port, $mode);
    }

    protected $readTimeout = 1000;
    protected function readData(){

    }

    public function inputReciever($callback){
        $this->stream->seek(0);
        (new Thread(function() use ($callback){
            
            

           /* $t = new TimerScript($this->readTimeout, true, function(){
                var_dump(time());    
            });
            $t->start();
*/
            while($this->stream->eof()){
                $i = $this->stream->read(1);
                if($i !== null and $i !== false){
                    call_user_func_array($callback, [$i]);
                }
            }
        }))->start();
    }

    /**
     * --RU--
     * Установить скорость порта (бод)
     * @param int $baud
     * @throws WindowsException
     */
    public function setBaud($baud){
        return WSH::cmd('mode ' . $this->port . ' baud=' . $baud);
    }

    public function __toString(){
        return (string) $this->port;
    }

}