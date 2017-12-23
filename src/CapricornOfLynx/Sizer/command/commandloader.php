<?php
namespace CapricornOfLynx\Sizer\command;

use CapricornOfLynx\Sizer\loader;

class commandloader
{

    public static function registerAll(loader $plugin)
    {
        $plugin->getServer()->getCommandMap()->register("size", new size($plugin));
    }
}
