<?php
namespace app\forms;

use Exception;
use std, gui, framework, app;


use bundle\windows\Windows;
use php\gui\event\UXEvent; 
use php\gui\event\UXWindowEvent; 
use php\gui\event\UXMouseEvent; 

class MainForm extends AbstractForm
{

    /**
     * @event button.action 
     * @event buttonAlt.action 
     * @event button3.action 
     * @event button4.action 
     * @event button5.action 
     */
    function doButtonAction($e){    
        $this->form($e->target->text)->showAndWait();
    }

    /**
     * @event show 
     */
    function construct(){    
        global $argv;
        $this->checkbox->mouseTransparent = true;
        $this->checkbox->selected = Windows::isAdmin();
        $this->textArea->text = var_export($argv, true);
    }

    /**
     * @event link.action 
     */
    function doLinkAction(){    
        try{
            Windows::requireAdmin();
        } catch(Exception $e){
            pre($e->getMessage());
        }
    }


}
