<?php

namespace UnNyanCat\Core\Events;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\item\Item;

class RandomOreEvent implements Listener
{
    public function onBreak(BlockBreakEvent $event){
        $charbon = Item::get(Item::COAL);
        $charbon_rand = mt_rand(1, 32);
        $charbon->setCount($charbon_rand);
        $charbon->setCustomName("CHARBON DE RANDOM ORE");

        $lapis = Item::get(Item::LAPIS_ORE);
        $lapis_rand = mt_rand(1, 32);
        $lapis->setCount($lapis_rand);
        $lapis->setCustomName("LAPIS DE RANDOM ORE");

        $or = Item::get(Item::GOLD_INGOT);
        $or_rand = mt_rand(1, 32);
        $or->setCount($or_rand);
        $or->setCustomName("OR DE RANDOM ORE");

        $fer = Item::get(Item::IRON_INGOT);
        $fer_rand = mt_rand(1, 32);
        $fer->setCount($fer_rand);
        $fer->setCustomName("FER DE RANDOM ORE");

        $diamant = Item::get(Item::DIAMOND);
        $diamant_rand = mt_rand(1, 32);
        $diamant->setCount($diamant_rand);
        $diamant->setCustomName("DIAMANT DE RANDOM ORE");

        $emeraude = Item::get(Item::EMERALD);
        $emeraude_rand = mt_rand(1, 32);
        $emeraude->setCount($emeraude_rand);
        $emeraude->setCustomName("EMERAUDE DE RANDOM ORE");

        $player = $event->getPlayer();
        $block = $event->getBlock();
        $drop = $event->getDrops();

        if ($block->getId() === 73) {
            $player->sendPopup("RandomOre");
            $rand = mt_rand(1, 6);

            if ($rand === 1) {
                $event->setDrops([$charbon]);
            }

            if ($rand === 2) {
                $event->setDrops([$lapis]);
            }

            if ($rand === 3) {
                $event->setDrops([$fer]);
            }

            if ($rand === 4) {
                $event->setDrops([$or]);
            }

            if ($rand === 5) {
                $event->setDrops([$diamant]);
            }

            if ($rand === 6) {
                $event->setDrops([$emeraude]);
            }
        }

        if ($block->getId() === 74) {
            $player->sendPopup("Random OREEEEEE");
            $rand = mt_rand(1,6);

            if ($rand === 1) {
                $event->setDrops([$charbon]);
            }

            if ($rand === 2) {
                $event->setDrops([$lapis]);
            }

            if ($rand === 3) {
                $event->setDrops([$fer]);
            }

            if ($rand === 4) {
                $event->setDrops([$or]);
            }

            if ($rand === 5) {
                $event->setDrops([$diamant]);
            }

            if ($rand === 6) {
                $event->setDrops([$emeraude]);
            }
        }
    }
}