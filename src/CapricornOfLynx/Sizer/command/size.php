<?php
namespace CapricornOfLynx\Sizer\command;

use CapricornOfLynx\Sizer\loader;

use pocketmine\command\PluginCommand;
use pocketmine\plugin\Plugin;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class size extends PluginCommand {

    public function __construct(Plugin $plugin) {
        parent::__construct("size", $plugin);
        $this->setDescription('change your or other players size.');
        $this->setUsage('/size <player(@p or me for yourself> <0.1-10|about|reset>');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if ($sender->hasPermission('player.size')) {
			$player = null;
            if (count($args) == 2) {
				if ($args[0] == "me" || $args[0] == "@p"){
					if (!$sender instanceof Player){
						$scale = "error"; 
						$name = "CONSOLE"; 
					} else { 
					$player = $sender;
						$name = $player->getName();
					$scale = $player->getScale();
					}
				} else {
					$player = $this->getPlugin()->getServer()->getPlayer($args[0]);
					if (!$player){
						$sender->sendMessage(loader::PREFIX.'§7Player not found!');
					} else {
						$scale = $player->getScale();
						$name = $player->getName();
					}
				}
                if (is_numeric($args[1])) {
                    if ($args[1] >= 0.1 && $args[1] <= 10) {
			    if ($args[0] == "me" || $args[0] == "@p") {
				    $player->setScale($args[1]);
				    $player->sendMessage(loader::PREFIX."§7You set your size to §a".$args[1]);
			} else {
				    if($sender->hasPermission('player.size.other')) {
					    $player->setScale($args[1]);
					    $player->sendMessage(loader::PREFIX.'§a'.$sender->getName().' §7set your size to §a'.$args[1]);
					    $sender->sendMessage(loader::PREFIX. '§7You set §a'.$player->getName().'/s §7size to §a'.$args[1]);
				} else {
					    $sender->sendMessage(loader::PREFIX. "§7You can't change size from other players");
			}
			}
			
                    } else {
		$sender->sendMessage(loader::PREFIX."§7Size invalid! (min = 0.1; max = 10; you = ".$sender->getScale().")");
					}
                } elseif (strtolower($args[1]) == 'about') {
                    $sender->sendMessage(loader::PREFIX.'§a'.$name.'/s §7size is §a'.$scale);
                } elseif (strtolower($args[1]) == 'reset') {
                    $player->setScale(1);
                    $sender->sendMessage(loader::PREFIX.'§7Size has been reset');
                } else {
                    $sender->sendMessage(loader::PREFIX.'§7You must specify the size numerically!');
                }
            } else {
                $sender->sendMessage(loader::PREFIX.'§7Use: §a/size <player (@p or me for yourself)> <0.1-10|about|reset>');
            }
        } else {
            $sender->sendMessage(loader::PREFIX.'§7You are not allowed to execute this command!');
        }
    }
}
