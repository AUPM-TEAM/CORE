<?php

namespace UnNyanCat\Core\Mobs;

use pocketmine\entity\EntityIds;
use pocketmine\entity\Monster;

class Cochon extends Monster
{
    public const NETWORK_ID = EntityIDS::PIG;

    public $width = 0.9;
    public $height = 0.9;
    public $gravity = 0;

    public function getName(): string
    {
        return "Pig";
    }

    public  function initEntity(): void
    {
        parent::initEntity();
        $this->setImmobile(true);
        $this->setNameTagAlwaysVisible(true);
        $this->setHealth($this->getHealth());
    }

    public function onUpdate(int $currentTick): bool
    {
        $name = "§b- §eBienvenue sur §cTeranium §b-\n§aServeur PvP Faction McBe Francophone!\n§b-\n§9- §gVersion 1.0 !§9 -";
        $this->setNameTag($name);
        return parent::onUpdate($currentTick);
    }
}