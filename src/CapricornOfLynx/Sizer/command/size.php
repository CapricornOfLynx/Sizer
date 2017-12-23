<?php
namespace CapricornOfLynx\Sizer\command;

use CapricornOfLynx\Sizer\loader;

use pocketmine\command\PluginCommand;
use pocketmine\plugin\Plugin;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class size extends PluginCommand
{

    public function __construct(Plugin $plugin)
    {
        parent::__construct("size", $plugin);
        $this->setDescription('change your size.');
        $this->setUsage('/size <mini|baby|normal|big|monster|giant|about>');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
         if ($sender instanceof Player) 
        {
            if ($sender->hasPermission("dokiacraft.size"))
             {
                if (count($args) == 1) 
                {
                    if (strtolower($args[0]) == 'mini')
                    {
                        $sender->setScale('0.1');
                        $sender->sendMessage(loader::PREFIX.'§7You've set your size to §a'.$args[0]);
                    }
                    elseif (strtolower($args[0]) == 'baby')
                    {
                        $sender->setScale('0.5');
                        $sender->sendMessage(loader::PREFIX.'§7You've set your size to §a'.$args[0]);
                    }
                    elseif (strtolower($args[0]) == 'normal')
                    {
                        $sender->setScale('1');
                        $sender->sendMessage(loader::PREFIX.'§7You've set your size to §a'.$args[0]);
                    }
                    elseif (strtolower($args[0]) == 'big')
                    {
                        $sender->setScale('2.5');
                        $sender->sendMessage(loader::PREFIX.'§7You've set your size to §a'.$args[0]);
                    }
                    elseif (strtolower($args[0]) == 'monster')
                    {
                        $sender->setScale('5');
                        $sender->sendMessage(loader::PREFIX.'§7You've set your size to §a'.$args[0]);
                    }
                    elseif (strtolower($args[0]) == 'giant')
                    {
                        $sender->setScale('10');
                        $sender->sendMessage(loader::PREFIX.'§7You've set your size to §a'.$args[0]);
                    } 
                    elseif (strtolower($args[0]) == 'about')
                    { 
                        $sender->sendMessage(loader::PREFIX.'§7This plugin was programmed by the German developer §aCapricornOfLynx');
                    } else {
                        $sender->sendMessage(loader::PREFIX.'§7Nutze: §a/size <mini|baby|normal|big|monster|giant|about>');
                    }
                } else {
                    $sender->sendMessage(loader::PREFIX.'§7Nutze: §a/size <mini|baby|normal|big|monster|giant|about>');
                }
            }
        } else {
            $sender->sendMessage(loader::PREFIX.loader::CONSOLE_SENDER);
        }
    }
}
