<?php
namespace app\forms;

use std, gui, framework, app;


use bundle\windows\Windows;
use php\gui\event\UXEvent; 

class MainForm extends AbstractForm
{

    /**
     * @event button.action 
     * @event buttonAlt.action 
     * @event button3.action 
     */
    function doButtonAction(UXEvent $e = null)
    {    
        $this->form($e->target->text)->showAndWait();
    }

}
