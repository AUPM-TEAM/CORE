<?php

namespace UnNyanCat\Core\Mobs;

use pocketmine\entity\EntityIds;
use pocketmine\entity\Monster;

class Vache extends Monster
{
    public const NETWORK_ID = EntityIds::COW;

    public $width = 0.9;
    public $height = 1.4;
    public $gravity = 0;

    public function getName(): string
    {
        return "Cow";
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