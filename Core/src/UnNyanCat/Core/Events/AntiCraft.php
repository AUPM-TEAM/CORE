<?php

namespace UnNyanCat\Core\Events;

use pocketmine\event\inventory\CraftItemEvent;
use pocketmine\event\Listener;

class AntiCraft implements Listener
{
    public function onCraft(CraftItemEvent $event){
        foreach($event->getOutputs() as $item){
            if(($item->getId() === 310) or (311) or (312) or (313)){
                $event->setCancelled(true);
                $player = $event->getPlayer();
                $player->sendMessage("§cTu ne peux pas craft d'armure en diamant !");
            }
            if($item->getId() === 285){
                $event->setCancelled(true);
                $player = $event->getPlayer();
                $player->sendMessage("§cTu ne peux pas craft de hammer !");
            }
        }
    }
}