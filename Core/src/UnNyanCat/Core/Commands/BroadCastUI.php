<?php

namespace UnNyanCat\Core\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use UnNyanCat\Core\Main;

class BroadCastUI extends Command
{
    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if($player instanceof Player){
            if($player->hasPermission("bc.use")){
                $this->bc($player);
            }else{ $player->sendMessage(Main::getConfigName("messages")->get("not-permission")); }
        }else{ $player->sendMessage(Main::getConfigName("messages")->get("not-player")); }
    }

    public function bc($player){
        $api = Server::getInstance()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Player $player, array $data = null){
            if($data === null){
                return true;
            }

            if($data[0] == null){
                $player->sendMessage(Main::getConfigName("messages")->get("type-message"));
            }
            if($data[1] == true){
                Server::getInstance()->broadcastMessage("§7[§aBroadCast§7] §g> §c$data[0]");
                return true;
            }
            if($data[2] == true){
                Server::getInstance()->broadcastMessage("§7[§aBroadCast§7] §g> §a$data[0]");
                return true;
            }
            if($data[3] == true){
                Server::getInstance()->broadcastMessage("§7[§aBroadCast§7] §g> §b$data[0]");
                return true;
            }
            Server::getInstance()->broadcastMessage("§7[§aBroadCast§7] §g> $data[0]");
        });
        $form->setTitle("§6BroadCast§aUI §4By UnNyanCat");
        $form->addInput("§a>> §bType the message");
        $form->addToggle("§cRed", false);
        $form->addToggle("§aGreen", false);
        $form->addToggle("§bBlue", false);
        $form->sendToPlayer($player);
    }
}