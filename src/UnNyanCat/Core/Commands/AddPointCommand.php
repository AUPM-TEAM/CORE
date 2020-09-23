<?php

namespace UnNyanCat\Core\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use UnNyanCat\Core\Main;

class AddPointCommand extends Command
{
    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if($player instanceof Player){
            if(count($args) == 1){
                $points = $args[0];

                $config = Main::getConfigName("Points");
                $config->set($player->getName(), $points);
                $config->save();

                $player->sendMessage("§aTu as bien mis ton nombre de levels à §r: §2" . $points);
                $player->sendPopup("§aTu as bien mis ton nombre de levels à §r: §2" . $points);
            }else{
                $player->sendMessage("You need to set a number after /addlevel");
            }
        }else{
            $player->sendMessage("§cYou can't do this command in CONSOLE");
        }
    }
}