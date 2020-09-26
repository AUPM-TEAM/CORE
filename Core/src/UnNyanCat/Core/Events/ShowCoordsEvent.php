<?php

namespace UnNyanCat\Core\Events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\item\Item;
use UnNyanCat\Core\Main;
use UnNyanCat\Core\Tasks\CoordsTask;

class ShowCoordsEvent implements Listener
{
    public function onHeld(PlayerItemHeldEvent $event){
        $player = $event->getPlayer();
        $item = $event->getItem();

        if($item->getId() == Item::COMPASS){
            Main::getInstance()->getScheduler()->scheduleRepeatingTask(new CoordsTask($player, Main::getInstance(), $this), 20 * 20);
        }
    }
}