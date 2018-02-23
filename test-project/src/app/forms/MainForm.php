<?php
namespace app\forms;

use std, gui, framework, app;


use bundle\windows\Windows;

class MainForm extends AbstractForm
{

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null)
    {    
//        var_dump(Windows::setWallpaper('E:\OneDrive\Изображения\Обоиъ\Splashing-sea-waves-of-dolphins-jumping-in-the-sunset_2560x1600.jpg'));
        var_dump(Windows::setWallpaper('E:\OneDrive\Изображения\Обоиъ\gorod_zakat_solnce_manhetten_doroga_mashiny_vesna_svet_vyderzhka_58103_1920x1200.jpg'));
        var_dump(Windows::getWallpaperPath());
    }

}
