<?php

namespace UnNyanCat\Core\API;

use pocketmine\Player;

class MessageAPI
{
    public static function ProutPlayerMessage(Player $player){
        $player->sendMessage("Ceci est un gros caca");
    }

    public static function ProutConsoleMessage(Player $player){
        $player->sendMessage("Ceci est une grosse console");
    }
}