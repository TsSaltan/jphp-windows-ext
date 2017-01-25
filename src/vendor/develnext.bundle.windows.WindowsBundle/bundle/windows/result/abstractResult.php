<?php
namespace bundle\windows\result;

use Iterator;

abstract class abstractResult implements Iterator{

    protected $data = [];

    public function add($key, $value){
        $this->data[$key] = $value;
    }

    public function rewind(){
        reset($this->data);
    }
  
    public function current(){
        return current($this->data);
    }
  
    public function key(){
        return key($this->data);
    }
  
    public function next(){
        return next($this->data);
    }
  
    public function valid(){
        $key = key($this->data);
        return ($key !== NULL && $key !== FALSE);
    }

    public function toArray(){
        return $this->data;
    }
}