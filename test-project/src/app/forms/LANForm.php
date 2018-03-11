<?php
namespace app\forms;

use php\gui\layout\UXHBox;
use php\gui\UXButton;
use php\gui\UXLabel;
use php\gui\UXHyperlink;
use php\gui\UXTableColumn;
use php\gui\UXTableView;
use php\gui\layout\UXAnchorPane;
use php\gui\UXImage;
use php\gui\UXImageView;
use php\gui\UXTab;
use php\util\Scanner;
use php\gui\framework\AbstractForm;
use php\gui\event\UXWindowEvent; 

use bundle\windows\Lan;

class LANForm extends AbstractForm
{

    /**
     * @event show 
     */
    function loadAdapters(){  
        $this->showPreloader(); 
        $this->tabPane->tabs->clear();    
        $adapters = Lan::getAdapters();
        foreach ($adapters as $adapter){
            $pane = $this->renderAdapter($adapter);
        }
        $this->hidePreloader(); 
    }
    
    function renderAdapter($adapter){
        $tab = new UXTab;
        $tab->text = $adapter->getName();
        //$tab->graphic = new UXImageView(new UXImage('res://.data/img/network_' . ($adapter->isActive() ? 'ok' : 'warn') . '.png'));
        $tab->content = new UXAnchorPane;
                
        $table = new UXTableView;
        $tСol1 = new UXTableColumn;
        $tСol1->id = 'key';
        $tСol1->text = 'Параметр';
        $tСol1->minWidth = 
        $tСol1->width = 200;
        $tСol1->maxWidth = 250;        
        $tСol1->resizable = true;      
        
        $tСol2 = new UXTableColumn;
        $tСol2->id = 'value';
        $tСol2->text = 'Значение';
        $tСol2->width = 200;
        $tСol2->maxWidth = 5000;     
        $tСol2->resizable = true; 
        
        $table->columns->addAll([$tСol1, $tСol2]);
                
        $button = new UXHyperlink('Подключено');
        $button->data('connect', true);
        //$button->graphic = new UXImageView(new UXImage('res://.data/img/connect.png'));
        $button->on('click', function() use ($button, $adapter){
            if($button->data('connect')){
                if($adapter->disable()){
                    $button->text = 'Отключено';
                    $button->data('connect', false);
                } else {
                    alert('Не удаётся отключить адаптер. Возможно у вас недостаточно прав.');
                }
                //$button->graphic = new UXImageView(new UXImage('res://.data/img/disconnect.png'));
            } else {
                if($adapter->enable()){
                    $button->data('connect', true);
                    $button->text = 'Подключено';
                } else {
                    alert('Не удаётся включить адаптер. Возможно у вас недостаточно прав.');
                }
                //$button->graphic = new UXImageView(new UXImage('res://.data/img/connect.png'));
            }
        }); 
        
        $params = array_merge([
            'Управление' => $button,
            'Состояние' => $adapter->isEnabled() ? 'Включен' : 'Выключен',
            'Сетевой кабель' => $adapter->isConnected() ? 'Подключен' : 'Не подключен',
            'Сеть' => $adapter->isNetworkEnabled() ? 'Доступна' : 'Недоступна',
            'IPv4' => $adapter->getIPv4(),
            'IPv6' => $adapter->getIPv6(),
        ], $adapter->getParams());
        
        
        foreach ($params as $k => $v){
            if(strlen($v) <= 1) continue;
            
            $key = new UXLabel($k);
            $key->font = $key->font->withBold();
            $table->items->add(['key' => $key, 'value' => $v]);
        }
        
        //$this->addContextMenu($table);
        //$this->setSortableTable($table, ['key', 'value']);
        
        $table->constrainedResizePolicy = true;
        $table->update();
        
        UXAnchorPane::setLeftAnchor($table, 0);
        UXAnchorPane::setTopAnchor($table, 0);
        UXAnchorPane::setRightAnchor($table, 0);
        $tab->content->add($table);
        
        $this->tabPane->tabs->add($tab);
        return;
        
    }

}
