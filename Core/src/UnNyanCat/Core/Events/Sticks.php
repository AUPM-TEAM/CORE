<?php

namespace UnNyanCat\Core\Events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;

class Sticks implements Listener
{
    public function onInteract(PlayerInteractEvent $event){
        $player = $event->getPlayer();
        $item = $event->getItem();
        $block = $event->getBlock();

        /**
         * HEAL STICK
         */
        if( ($block->getId() === 251) && ($item->getId() === 369) ){
            if($player->getHealth() === 20){
                $player->sendPopup("§cErreur, votre vie est pleine");
            }else{
                $player->getInventory()->removeItem(Item::get(369, 0, 1));
                $health = 2 * 2;
                $player->setHealth($player->getHealth() + $health);
                $player->sendPopup("§7[§a+4§7]");
            }
        }

        /**
         * FEED STICK
         */
        if( ($block->getId() === 251) && ($item->getId() === 396) ){
            if($player->getFood() === 20){
                $player->sendPopup("§cErreur, votre food est pleine");
            }else{
                $food = 20;
                $player->setFood($food);
                $player->sendPopup("§7[§aFood à nouveau pleine !§7]");
            }
        }
    }
}