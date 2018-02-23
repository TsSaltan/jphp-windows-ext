<?php
namespace app\forms;

use php\gui\UXFileChooser;
use php\gui\framework\AbstractForm;
use php\gui\event\UXWindowEvent; 
use php\gui\event\UXEvent; 

use bundle\windows\Windows;


class WallpaperForm extends AbstractForm
{

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $this->image->image = Windows::getWallpaper();
    }

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {    
        $chooser = new UXFileChooser;
        $chooser->extensionFilters = [['description' => 'Images', 'extensions' => ['*.png', '*.jpg', '*.jpeg', '*.gif', '*.bmp']]];
        if($file = $chooser->execute()){
             Windows::setWallpaper($file->getAbsolutePath());
        }
        
        $this->doShow();
    }

}
