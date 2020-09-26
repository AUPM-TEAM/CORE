<?php

namespace UnNyanCat\Core\CustomItems;

use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\item\ItemIds;
use pocketmine\item\Tool;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\AnimatePacket;
use pocketmine\Player;

class FishingRod extends Tool implements Listener
{
    public function __construct($id = self::FISHING_ROD, $meta = 0, string $name = "Fishing Rod")
    {
        parent::__construct($id, $meta, $name);
    }

    public function getMaxStackSize(): int
    {
        return 1;
    }

    public function getMaxDurability(): int
    {
        return 120;
    }

    public function getFuelTime(): int
    {
        return 300;
    }

    public function onAttackEntity(Entity $victim): bool
    {
        return $this->applyDamage(1);
    }

    public function onClickAir(Player $player, Vector3 $directionVector): bool
    {
        if(GrapplingHook::getFishingHook($player) === null){
            $nbt = Entity::createBaseNBT($player);
            $hook = Entity::createEntity('FishingHook', $player->level, $nbt, $player);
            $hook->spawnToAll();
        }else{
            $hook = GrapplingHook::getFishingHook($player);
            $hook->handleHookRetraction();
        }
        $player->broadcastEntityEvent(AnimatePacket::ACTION_SWING_ARM);
        return true;
    }

    public function onDamage(EntityDamageEvent $event)
    {
        $player = $event->getEntity();
        if(!$player instanceof Player || $event->getCause() !== EntityDamageEvent::CAUSE_FALL) return true;
        if($player->getInventory()->getItemInHand()->getId() === ItemIds::FISHING_ROD){
            $event->setCancelled();
        }
        return true;
    }
}