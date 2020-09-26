<?php

namespace UnNyanCat\Core\Events;

use pocketmine\block\Block;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use UnNyanCat\Core\Main;

class HammerEvent implements Listener
{
    private $olditem;

    public function onBreakBlocks(BlockBreakEvent $event){
        $item = $event->getItem();
        $block = $event->getBlock();
        if($item->getId() === Main::getConfigName("Hammer")->get("id")){
            if(!$event->isCancelled()){
                $event->setCancelled();
                $this->addBlock($block);
            }
        }
    }

    private function addBlock(Block $blocks)
    {
        $minX = $blocks->x - 1;
        $maxX = $blocks->x + 1;

        $minY = $blocks->y - 1;
        $maxY = $blocks->y + 1;

        $minZ = $blocks->z - 1;
        $maxZ = $blocks->z + 1;

        for ($x = $minX; $x <= $maxX; $x++) {
            for ($y = $minY; $y <= $maxY; $y++) {
                for ($z = $minZ; $z <= $maxZ; $z++) {
                    $block = $blocks->getLevel()->getBlockAt($x,$y,$z);
                    $item = Item::get(Item::IRON_PICKAXE);
                    $block->getLevel()->useBreakOn($block,$item);
                }
            }
        }
    }
}