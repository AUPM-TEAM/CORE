<?php

namespace UnNyanCat\Core\Events;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\math\Vector3;

class HammerEvent implements Listener
{
    public function onBreak(BlockBreakEvent $event){
        $player = $event->getPlayer();
        $item = $event->getItem();
        $block = $event->getBlock();

        $hammer = Item::GOLD_PICKAXE;

        if($item->getId() == $hammer){
            $level = $player->getLevel();
            for($count = 0; $count >= -1; $count--){
                $bpos = $level->getBlockIdAt($block->x + 1, $block->y + $count, $block->z);
                if($bpos != 7 && $bpos != 49){
                    $level->setBlockIdAt($block->x + 1, $block->y + $count, $block->z, 0);
                    $item = Item::get($bpos, 0, 1);
                    $level->dropItem(new Vector3($block->x + 1, $block->y + $count, $block->z), $item);
                }
                $bpos = $level->getBlockIdAt($block->x - 1, $block->y + $count, $block->z);
                if($bpos != 7 && $bpos != 49){
                    $level->setBlockIdAt($block->x - 1, $block->y + $count, $block->z, 0);
                    $item = Item::get($bpos, 0, 1);
                    $level->dropItem(new Vector3($block->x - 1, $block->y + $count, $block->z), $item);
                }
                $bpos = $level->getBlockIdAt($block->x - 1, $block->y + $count, $block->z + 1);
                if($bpos != 7 && $bpos != 49){
                    $level->setBlockIdAt($block->x - 1, $block->y + $count, $block->z + 1, 0);
                    $item = Item::get($bpos, 0, 1);
                    $level->dropItem(new Vector3($block->x - 1, $block->y + $count, $block->z + 1), $item);
                }
                $bpos = $level->getBlockIdAt($block->x, $block->y + $count, $block->z + 1);
                if($bpos != 7 && $bpos != 49){
                    $level->setBlockIdAt($block->x, $block->y + $count, $block->z + 1, 0);
                    $item = Item::get($bpos, 0, 1);
                    $level->dropItem(new Vector3($block->x, $block->y + $count, $block->z + 1), $item);
                }
                $bpos = $level->getBlockIdAt($block->x + 1, $block->y + $count, $block->z + 1);
                if($bpos != 7 && $bpos != 49){
                    $level->setBlockIdAt($block->x + 1, $block->y + $count, $block->z + 1, 0);
                    $item = Item::get($bpos, 0, 1);
                    $level->dropItem(new Vector3($block->x + 1, $block->y + $count, $block->z + 1), $item);
                }
                $bpos = $level->getBlockIdAt($block->x - 1, $block->y + $count, $block->z - 1);
                if($bpos != 7 && $bpos != 49){
                    $level->setBlockIdAt($block->x - 1, $block->y + $count, $block->z - 1, 0);
                    $item = Item::get($bpos, 0, 1);
                    $level->dropItem(new Vector3($block->x - 1, $block->y + $count, $block->z - 1), $item);
                }
                $bpos = $level->getBlockIdAt($block->x, $block->y + $count, $block->z - 1);
                if($bpos != 7 && $bpos != 49){
                    $level->setBlockIdAt($block->x, $block->y + $count, $block->z - 1, 0);
                    $item = Item::get($bpos, 0, 1);
                    $level->dropItem(new Vector3($block->x, $block->y + $count, $block->z - 1), $item);
                }
                $bpos = $level->getBlockIdAt($block->x + 1, $block->y + $count, $block->z - 1);
                if($bpos != 7 && $bpos != 49){
                    $level->setBlockIdAt($block->x + 1, $block->y + $count, $block->z - 1, 0);
                    $item = Item::get($bpos, 0, 1);
                    $level->dropItem(new Vector3($block->x + 1, $block->y + $count, $block->z - 1), $item);
                }
            }
            $bpos = $level->getBlockIdAt($block->x, $block->y - 1, $block->z);
            if($bpos != 7 && $bpos != 49){
                $level->setBlockIdAt($block->x, $block->y - 1, $block->z, 0);
                $item = Item::get($bpos, 0, 1);
                $level->dropItem(new Vector3($block->x, $block->y - 1, $block->z), $item);
            }
            $bpos = $level->getBlockIdAt($block->x, $block->y - 2, $block->z);
            if($bpos != 7 && $bpos != 49){
                $level->setBlockIdAt($block->x, $block->y - 2, $block->z, 0);
                $item = Item::get($bpos, 0, 1);
                $level->dropItem(new Vector3($block->x, $block->y - 2, $block->z), $item);
            }
        }

        if ($block->getId() === 14){
            $drop = Item::get(Item::GOLD_INGOT, 0, 2);
            $event->setDrops([$drop]);
        }
        if ($block->getId() === 15){
            $drop = Item::get(Item::IRON_INGOT, 0, 2);
            $event->setDrops([$drop]);
        }
        if ($block->getId() === 56){
            $drop = Item::get(Item::DIAMOND, 0, 2);
            $event->setDrops([$drop]);
        }
    }
}