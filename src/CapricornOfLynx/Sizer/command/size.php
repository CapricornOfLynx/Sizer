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
        $this->setDescription('change your size.');
        $this->setUsage('/size <player> <0.1-10|about>');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if ($sender->hasPermission('player.size')) {
			$player = null;
            if (count($args) == 2) {
				if (($args[0] == "me" || $args[0] == "@p") && ($sender instanceof Player)){
					$player = $sender;
				} else {
					$player = $this->getPlugin()->getServer()->getPlayer($args[0]);
					if (!$player){
						$sender->sendMessage(loader::PREFIX.'§7Player not found!');
					}
				}
                if (is_numeric($args[1])) {
                    if ($args[1] >= 0.1 && $args[1] <= 10) {
                        $player->setScale($args[1]);
                        $sender->sendMessage(loader::PREFIX.'§7You have set §a'.$args[0].'§7\'s size to §a'.$args[1]);
                    } else {
						$sender->sendMessage(loader::PREFIX."§7Size invalid! (min = 0.1; max = 10; you = ".$args[0].")");
					}
                } elseif (strtolower($args[1]) == 'about') {
                    $sender->sendMessage(loader::PREFIX.'§7Sizer by §aCapricornOfLynx §7modded by §athelucyclub');
                } elseif (strtolower($args[1]) == 'reset') {
                    $player->setScale(1);
                    $sender->sendMessage(loader::PREFIX.'§7Your size has been reset');
                } else {
                    $sender->sendMessage(loader::PREFIX.'§7You must specify the size numerically!');
                }
            } else {
                $sender->sendMessage(loader::PREFIX.'§7Use: §a/size <player (@p for yourself)> <0.1-10|about>');
            }
        } else {
            $sender->sendMessage(loader::PREFIX.'§7You are not allowed to execute this command!');
        }
    }
}
