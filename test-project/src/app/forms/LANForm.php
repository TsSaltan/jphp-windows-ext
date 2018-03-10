<?php
namespace app\forms;

use php\util\Scanner;
use php\gui\framework\AbstractForm;
use php\gui\event\UXWindowEvent; 

use bundle\windows\Lan;

class LANForm extends AbstractForm
{

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $a = Lan::getAdapters();
        var_dump($a);
    }

}
