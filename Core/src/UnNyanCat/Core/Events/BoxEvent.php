<?php

namespace UnNyanCat\Core\Events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\level\sound\AnvilBreakSound;
use pocketmine\Server;

class BoxEvent implements Listener
{
    public function onInteract(PlayerInteractEvent $event){
        $player = $event->getPlayer();
        $itemHold = $event->getItem();
        $name = $player->getName();
        $level = $player->getLevel();
        $target = $event->getBlock();
        $click = new AnvilBreakSound($player);
        $block = $event->getBlock();
        $level = $target->getLevel();

        if( ($block->getId() === 41) && ($itemHold->getId() === 131 ) ){
            $player->getInventory()->removeItem(Item::get(131, 0, 1));
            $num = rand(1, 80);
            if($num >= 1 && $num <= 39){
                $item = Item::get(Item::RABBIT_FOOT);
                $item->setDamage(0);
                $item->setCount(2);
                $item->setCustomName("§6Teranium §5Ingot");
                $player->getInventory()->addItem($item);
                Server::getInstance()->broadcastMessage("§9(§e!§9) §9$name §eviens de gagner §92Teranium Ingots §edans une box !");
                $level = $player->getLevel();
                $level->addSound($click);
            }

            if($num >= 40 && $num <= 80){
                $player->getInventory()->addItem(Item::get(251, 0, 5));
                Server::getInstance()->broadcastMessage("§9(§e!§9) §9$name §eviens de gagner §95Blocs de Teranium §edans une box !");
                $level = $player->getLevel();
                $level->addSound($click);
            }
        }
    }
}