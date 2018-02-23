<?php
namespace app\forms;

use bundle\windows\WindowsException;
use bundle\windows\Windows;
use php\gui\framework\AbstractForm;
use php\gui\event\UXWindowEvent; 
use php\gui\event\UXMouseEvent; 
use php\gui\event\UXKeyEvent; 
use php\gui\event\UXScrollEvent; 


class AudioAndBrightForm extends AbstractForm
{

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $this->sliderAudio->value = Windows::getVolumeLevel();
        try{
            $this->sliderBright->value = Windows::getBrightnessLevel();
        } catch (WindowsException $e){
            $this->sliderBright->enabled = false;
        }
    }

    /**
     * @event sliderAudio.click 
     * @event sliderAudio.keyPress 
     * @event sliderAudio.scroll 
     */
    function changeAudio(){    
        Windows::setVolumeLevel($this->sliderAudio->value);
    }
    
    /**
     * @event sliderBright.click 
     * @event sliderBright.keyPress 
     * @event sliderBright.scroll 
     */
    function changeBright(){    
        Windows::setVolumeLevel($this->sliderBright->value);
    }

}
