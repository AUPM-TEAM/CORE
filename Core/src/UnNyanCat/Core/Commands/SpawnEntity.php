<?php

namespace UnNyanCat\Core\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\Entity;
use pocketmine\level\Position;
use pocketmine\Player;

class SpawnEntity extends Command
{
    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if(!$player instanceof Player)return $player->sendMessage("Vous devez être en jeu pour executé cette commande !");
        if(!$player->hasPermission("staff.perm"))return $player->sendMessage("Vous n'avez pas la permission d'executé cette  !");
        if(!isset($args[0]))return $player->sendMessage("Vous devez préciser (poule/vache/cochon)");
        if(strtolower($args[0]) == "poule"){
            $position = new Position($player->x, $player->y, $player->z, $player->level);
            $nbt = Entity::createBaseNBT($position, null, 1.0, 1.0);
            $entity = Entity::createEntity("Chicken", $player->level, $nbt);
        }
        if(strtolower($args[0]) == "vache"){
            $position = new Position($player->x, $player->y, $player->z, $player->level);
            $nbt = Entity::createBaseNBT($position, null, 1.0, 1.0);
            $entity = Entity::createEntity("Cow", $player->level, $nbt);
        }
        if(strtolower($args[0]) == "cochon"){
            $position = new Position($player->x, $player->y, $player->z, $player->level);
            $nbt = Entity::createBaseNBT($position, null, 1.0, 1.0);
            $entity = Entity::createEntity("Pig", $player->level, $nbt);
        }
        return true;
    }
}