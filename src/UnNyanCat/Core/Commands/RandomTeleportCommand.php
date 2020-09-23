<?php

namespace UnNyanCat\Core\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\level\Position;
use pocketmine\Player;

class RandomTeleportCommand extends Command implements Listener
{
    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if($player instanceof Player){
            $x = mt_rand(500, 2000);
            $y = mt_rand(70, 90);
            $z = mt_rand(500, 2000);
            $level = $player->getLevel();

            $player->teleport(new Position($x, $y, $z, $level));
            $player->sendMessage("§aTu as bien été téléporté aléatoirement !");
        }else{
            $player->sendMessage("§cTu n'es pas un joueur");
        }
    }
}