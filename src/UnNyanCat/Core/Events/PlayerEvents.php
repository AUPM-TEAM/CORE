<?php

namespace UnNyanCat\Core\Events;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\network\mcpe\protocol\ActorEventPacket;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\Server;

class PlayerEvents implements Listener
{
    const WELCOME = "§bTera§cBienvenue";

    const GOODBYE = "§bTera§cBye";

    public function onJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        $event->setJoinMessage(" ");

        if(!$player->hasPlayedBefore()) { // ! = n'a pas
            $player->broadcastEntityEvent(ActorEventPacket::CONSUME_TOTEM);
            $player->getLevel()->broadcastLevelEvent($player->add(0, $player->eyeHeight()), LevelEventPacket::EVENT_SOUND_TOTEM);
            Server::getInstance()->broadcastMessage(self::WELCOME . " " . $player->getName() . " §aa rejoin le serveur pour la première fois !");
        }else{
            $player->broadcastEntityEvent(ActorEventPacket::CONSUME_TOTEM);
            Server::getInstance()->broadcastMessage(self::WELCOME . " " . $player->getName() . " §2a rejoin le serveur !");
        }
    }

    public function onQuit(PlayerQuitEvent $event)
    {
        $player = $event->getPlayer();
        $event->setQuitMessage(" ");

        return Server::getInstance()->broadcastMessage(self::GOODBYE . " " . "§4" . $player->getName() . " §ca quitté le serveur");
    }

    public function Hunger(PlayerExhaustEvent $event){$event->setCancelled(true);}

    public function onDamage(EntityDamageEvent $event){
        if(EntityDamageEvent::CAUSE_FALL){
            $event->setCancelled(true);
        }
    }
}