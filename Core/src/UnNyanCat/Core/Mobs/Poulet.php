<?php

namespace UnNyanCat\Core\Mobs;

use pocketmine\entity\Monster;
use pocketmine\entity\EntityIds;

class Poulet extends Monster
{
    public const NETWORK_ID = EntityIds::CHICKEN;

    public $width = 0.4;
    public $height = 0.8;
    public $gravity = 0;

    public function getName(): string
    {
        return "Chicken";
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
        $name = "§b- §eBienvenue sur §bQlic §eNetwork §b-\n§aServeur PvP Faction McBe Francophone!\n§b-\n§9- §gMAJ 1.0.3 !§9 -";
        $this->setNameTag($name);
        return parent::onUpdate($currentTick);
    }
}