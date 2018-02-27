<?php
namespace app\forms;

use php\util\Regex;
use php\lib\str;
use php\util\Scanner;
use script\storage\IniStorage;
use php\io\File;
use php\gui\UXFileChooser;
use php\gui\event\UXDragEvent;
use php\gui\framework\AbstractForm;
use php\gui\event\UXWindowEvent; 
use php\gui\event\UXEvent; 
use bundle\windows\Metadata; 


class MetadataForm extends AbstractForm
{

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $this->on('dragOver', function(UXDragEvent $e){
            if(count($e->dragboard->files) || $e->dragboard->image){
                $e->acceptTransferModes(['MOVE', 'COPY']);
                $this->panelDrop->visible = true;
                $this->panelDrop->opacity = 1;
            }
            $e->consume();
        });
        
        $this->on('dragDrop', function(UXDragEvent $e){ 
            $this->panelDrop->visible = false;
            if(count($e->dragboard->files)){
                foreach($e->dragboard->files as $file){
                    $this->editFile->text = $file->getAbsolutePath(); 
                    return; 
                }
            }
        });
    }

    /**
     * @event buttonSelect.action 
     */
    function doButtonSelectAction(UXEvent $e = null)
    {    
        $dialog = new UXFileChooser;
        if($file = $dialog->execute()){
            $this->editFile->text = $file->getAbsolutePath(); 
        }
    }

    /**
     * @event buttonRead.action 
     */
    function doButtonReadAction(UXEvent $e = null)
    {    
        $m = new Metadata($this->editFile->text);
        $data = $m->readData();
        var_dump($data);
        $this->textArea->text = var_export($data, true);
    }
    

}
