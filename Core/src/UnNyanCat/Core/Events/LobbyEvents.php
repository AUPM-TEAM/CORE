<?php

namespace UnNyanCat\Core\Events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;

class LobbyEvents implements Listener
{
    public function onInteract(PlayerInteractEvent $event){
        $player = $event->getPlayer();
        $item = $event->getItem();
        $itemname = $player->getInventory()->getItemInHand()->getName();

        if($item->getId() === 360 || $itemname === "§cGames"){
            $event->setCancelled();
            $player->sendMessage("§cThere's no games online");
        }

        if($item->getId() === 152 || $itemname === "§aProfile"){
            $event->setCancelled();
            $player->sendMessage("§g...§cSoon§g...");
        }
    }
}