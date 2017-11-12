<?php
namespace bundle\windows\io;

use php\io\MiscStream;
use bundle\windows\WindowsScriptHost as WSH;

class ComStream extends MiscStream
{
	public function $timeout = 5000;

	public function dataReciever($callback){
		while($this->eof()){
			
		}
	}
}