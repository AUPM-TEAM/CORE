<?php

namespace UnNyanCat\Core\Events;

use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;

class PlaceTeraBlockEvent implements Listener
{
    public function onPlaceBlock(BlockPlaceEvent $event){
        $block = $event->getBlock();

        if($block->getId() === 251){
            $event->setCancelled(false);
        }
    }
}