<?php
namespace app\forms;

use php\gui\framework\AbstractForm;
use php\gui\event\UXKeyEvent; 

use bundle\windows\api\CSharp;
use bundle\windows\api\Dll;
use bundle\windows\WindowsScriptHost as WSH;
use bundle\windows\Windows;

class LayoutForm extends AbstractForm
{

    /**
     * @event edit.keyPress 
     */
    function doEditKeyPress(UXKeyEvent $e = null)
    {    
        $this->label->text = '...';
        //$this->label->text = Windows::getKeyboardLayoutName();
      
        $user32 = new Dll('user32.dll');  
        $user32->MessageBeep([0x00000030], 'bool');
    }

}
