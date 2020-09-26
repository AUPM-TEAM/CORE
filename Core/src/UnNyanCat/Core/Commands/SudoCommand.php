<?php

namespace UnNyanCat\Core\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use UnNyanCat\Core\Main;

class SudoCommand extends Command
{
    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if($player instanceof Player){
            if($player->hasPermission("sudo.cmd")) {
                $this->sudo($player);
            }else{ $player->sendMessage("§cTu n'as pas la permission de faire la commande"); }
        }else{ $player->sendMessage("§cTu n'es pas en jeu !"); }
    }

    public function sudo($player){
        $form = Main::getInstance()->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
            if($data === null)
            {
                return true;
            }
            $p = Main::getInstance()->getServer()->getPlayer($data[0]);
            $cmd = $data[1];
            if($p instanceof Player){
                Main::getInstance()->getServer()->dispatchCommand($p, $cmd);
                $player->sendMessage("You sudo " . $p->getName() . " todo /" . $cmd);
            }
        });
        $form->setTitle("Sudo UI");
        $form->addInput("Type a player name");
        $form->addInput("Type a command without /");
        $form->sendToPlayer($player);
    }
}