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
        $this->setUsage('/size <0.1-10|about>');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
         if ($sender instanceof Player) 
        {
            if ($sender->hasPermission('player.size'))
             {
                if (count($args) == 1) 
                {
                    if (is_numeric($args[0]))
                    {
                        if ($args[0] >= 0.1 && $args[0] <= 10)
                        {
                            $sender->setScale($args[0]);
                            $sender->sendMessage(loader::PREFIX.'§7You have set your size to §a'.$args[0]);
                        }
                    }
                    elseif (strtolower($args[0]) == 'about')
                    {
                        $sender->sendMessage(loader::PREFIX.'§7Sizer by §aCapricornOfLynx §7and §aDokiaCraft.net');
                    }
                    elseif (strtolower($args[0]) == 'reset')
                    {
                        $sender->setScale(1);
                        $sender->sendMessage(loader::PREFIX.'§7Your size has been reset');
                    }
                    else
                    {
                        $sender->sendMessage(loader::PREFIX.'§7You must specify the size numerically!');
                    }
                }
                else
                {
                    $sender->sendMessage(loader::PREFIX.'§7Use: §a/size <0.1-10|about>');
                }
            }
            else
            {
                $sender->sendMessage(loader::PREFIX.'§7You are not allowed to execute this command!');
            }
        }
        else
        {
            $sender->sendMessage(loader::PREFIX.loader::CONSOLE_SENDER);
        }
    }
}
