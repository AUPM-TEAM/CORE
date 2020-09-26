<?php

namespace UnNyanCat\Core\Tasks;

use pocketmine\Player;
use pocketmine\scheduler\Task;

class CoordsTask extends Task
{
    public $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function onRun(int $tick)
    {
        $x = $this->player->getX();
        $y = $this->player->getY();
        $z = $this->player->getZ();

        $this->player->sendPopup("Vos coords :\n" . $x . " " . $y . " " . $z);
    }
}