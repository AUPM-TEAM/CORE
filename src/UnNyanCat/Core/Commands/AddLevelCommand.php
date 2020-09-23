<?php

namespace UnNyanCat\Core\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\Player;
use UnNyanCat\Core\Main;

class AddLevelCommand extends Command
{
    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if($player instanceof Player){
            if(count($args) == 1){
                $levels = $args[0];

                $config = Main::getConfigName("Levels");
                $config->set($player->getName(), $levels);
                $config->save();

                $player->sendMessage("§aTu as bien mis ton nombre de levels à §r: §2" . $levels);
                $player->sendPopup("§aTu as bien mis ton nombre de levels à §r: §2" . $levels);
            }else{
                $player->sendMessage("You need to set a number after /addlevel");
            }
        }else{
            $player->sendMessage("§cYou can't do this command in CONSOLE");
        }
    }
}