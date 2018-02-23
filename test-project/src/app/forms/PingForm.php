<?php
namespace app\forms;

use bundle\windows\Windows;
use php\gui\framework\AbstractForm;
use php\gui\event\UXWindowEvent; 
use php\gui\event\UXEvent; 


class PingForm extends AbstractForm
{

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $this->checkbox->mouseTransparent = true;
        $this->checkbox->selected = Windows::isInternetAvaliable();
    }

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {    
        pre(Windows::ping($this->edit->text));
    }

}
