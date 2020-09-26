<?php

namespace UnNyanCat\Core\CustomItems;

use pocketmine\block\Block;
use pocketmine\block\BlockToolType;
use pocketmine\entity\Entity;
use pocketmine\item\Pickaxe;

class HammerItem extends Pickaxe
{
    public function __construct(int $meta = 0)
    {
        parent ::__construct(745, $meta, "Golden Pickaxe", 2);
    }

    public function getBlockToolType(): int
    {
        return BlockToolType::TYPE_PICKAXE;
    }

    public function getBlockToolHarvestLevel(): int
    {
        return 5;
    }

    public function getMaxDurability(): int
    {
        return 3000;
    }

    public function onDestroyBlock(Block $block): bool
    {
        if ($block->getHardness() > 0) {
            return $this->applyDamage(2);
        }
        return false;
    }

    public function getAttackPoints(): int
    {
        return self::getBaseDamageFromTier($this->tier) - 2;
    }

    public function onAttackEntity(Entity $victim): bool
    {
        return $this->applyDamage(2);
    }
}