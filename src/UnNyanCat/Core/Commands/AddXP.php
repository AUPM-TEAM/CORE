<?php

namespace UnNyanCat\Core\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class AddXP extends Command
{
    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if($player instanceof Player){
            if(count($args) === 1){
                $player->addXpLevels($args[0]);
            }else{
                $player->sendMessage("§cUsage : /addxp [nombre]");
            }
        }else{
            $player->sendMessage("Il faut faire la commande en jeu !");
        }
    }
}