<?php

namespace UnNyanCat\Core\Events;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityArmorChangeEvent;
use pocketmine\event\Listener;

class FarmArmorEvent implements Listener
{
    public function onEquip(EntityArmorChangeEvent $event){
        $player = $event->getEntity();
        $newItem = $event->getNewItem();

        $boots = 305;
        $leggings = 304;
        $chestplate = 303;
        $helmet = 302;

        // CHAIN BOOTS -- FARM BOOTS

        if($newItem->getId() == $boots){
            $effect = new EffectInstance(Effect::getEffect(Effect::SPEED), 999 * 999, 0);
            $effect->setVisible(false);
            $player->addEffect($effect);
        }

        // CHAIN LEGGINGS -- FARM LEGGINGS

        if($newItem->getId() == $leggings){
            $effect = new EffectInstance(Effect::getEffect(Effect::HASTE), 999 * 999, 0);
            $effect->setVisible(false);
            $player->addEffect($effect);
        }

        // CHAIN CHESTPLATE -- FARM CHESTPLATE

        if($newItem->getId() == $chestplate){
            $effect = new EffectInstance(Effect::getEffect(Effect::JUMP_BOOST), 999 * 999, 1);
            $effect->setVisible(false);
            $player->addEffect($effect);
        }

        // CHAIN HELMET -- FARM HELMET

        if($newItem->getId() == $helmet){
            $effect = new EffectInstance(Effect::getEffect(Effect::NIGHT_VISION), 999 * 999, 1);
            $effect->setVisible(false);
            $player->addEffect($effect);
        }
    }
}