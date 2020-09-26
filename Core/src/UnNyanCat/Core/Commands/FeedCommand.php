<?php

namespace UnNyanCat\Core\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class FeedCommand extends Command
{
    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if($player instanceof Player) {
            if(count($args) == 1){
                $arg1 = $args[0];

                $player2 = $player->getServer()->getPlayer($arg1);

                if($player2 instanceof Player){
                    $player->sendMessage("§7[§gFeed§7] §a$arg1 §best un joueur et a été soigné(e).");
                    $player2->sendMessage("§7[§gFeed§7] §aTu as été nourri(e) par " . $player->getName() . ".");
                    $player2->setHealth(20);
                }else {
                    $player->sendMessage("§7[§cFeed§7] §c$arg1 n'est pas un joueur.");
                }
            } else {
                $player->sendMessage("§7[§cFeed§7] §cTu as oublié le nom d'un joueur.");
                $player->sendMessage("§7[§bFeed§7] §aTu as donc été nourri(e) avec succès !");
                $player->setHealth(20);
            }
            $player->sendMessage("Vous êtes un joueur");
        }else{
            $player->sendMessage("Vous êtes une console");
        }
    }
}