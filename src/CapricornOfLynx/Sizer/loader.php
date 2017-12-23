<?php
namespace CapricornOfLynx\Sizer;

use CapricornOfLynx\Sizer\command\commandloader;
use pocketmine\plugin\PluginBase;

class loader extends PluginBase
{

const PREFIX = '§l§aSizer §8»§r ';
const CONSOLE_SENDER = '§4You have to be in-game';
    
    public function onEnable()
    {
           commandloader::registerAll($this);
        
        $this->getLogger()->info("§aEnabled!");
    }

    public function onDisable()
    {
        $this->getLogger()->info("§4Disabled!");
    }

    
}
