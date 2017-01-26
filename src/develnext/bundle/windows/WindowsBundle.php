<?php
namespace develnext\bundle\windows;

use ide\bundle\AbstractBundle;
use ide\bundle\AbstractJarBundle;
use ide\project\behaviours\GuiFrameworkProjectBehaviour;
use ide\project\Project;

/**
 * Class WindowsBundle
 */
class WindowsBundle extends AbstractJarBundle
{
    public function isAvailable(Project $project)
    {
        return $project->hasBehaviour(GuiFrameworkProjectBehaviour::class);
    }
}
