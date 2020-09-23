<?php

namespace UnNyanCat\Core\Commands;

use onebone\economyapi\EconomyAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;

class RankUpCommand extends Command
{
    # UI
    const TITLE = "§l§bRank§6UP §4By §cUnNyanCat";

    # Buttons
    const UP_RANK = "§bUp Rank !";
    const CLOSE = "§cClose";

    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if($player instanceof Player){
            $this->rank($player);
        }else{
            $player->sendMessage("Tu n'es pas un joueur");
        }
    }

    public function rank($player){
        $formapi = Server::getInstance()->getPluginManager()->getPlugin("FormAPI");
        $rankapi = Server::getInstance()->getPluginManager()->getPlugin("PurePerms");
        $crank = $rankapi->getUserDataMgr()->getGroup($player)->getName();
        $money = EconomyAPI::getInstance()->myMoney($player);
        $form = $formapi->createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
            if($result == null){
                return true;
            }

            switch($result){
                case 0:
                    $rankapi = Server::getInstance()->getPluginManager()->getPlugin("PurePerms");
                    $a = $rankapi->getGroup("A");
                    $b = $rankapi->getGroup("B");
                    $c = $rankapi->getGroup("C");
                    $d = $rankapi->getGroup("D");
                    $guest = $rankapi->getGroup("Guest");
                    $crank = $rankapi->getUserDataMgr()->getGroup($player)->getName();
                    $money = EconomyAPI::getInstance()->myMoney($player);
                    if($crank == "Guest"){
                        if($money > 3000){
                            EconomyAPI::getInstance()->reduceMoney($player, "3000");
                            $rankapi->setGroup($player, $a);
                            $player->sendMessage("§bYour rank has been upgraded to §6A");
                            return true;
                        }

                        if($money == 3000){
                            EconomyAPI::getInstance()->reduceMoney($player, "3000");
                            $rankapi->setGroup($player, $a);
                            $player->sendMessage("§bYour rank has been upgraded to §6A");
                            return true;
                        }

                        if($money < 3000){
                            $player->sendMessage("§cYou don't have enough money");
                            return true;
                        }
                    }

                    if($crank == "A"){
                        if($money > 6000){
                            EconomyAPI::getInstance()->reduceMoney($player, "6000");
                            $rankapi->setGroup($player, $b);
                            $player->sendMessage("§bYour rank has been upgraded to §6B");
                            return true;
                        }

                        if($money == 6000){
                            EconomyAPI::getInstance()->reduceMoney($player, "6000");
                            $rankapi->setGroup($player, $b);
                            $player->sendMessage("§bYour rank has been upgraded to §6B");
                            return true;
                        }

                        if($money < 6000){
                            $player->sendMessage("§cYou don't have enough money");
                            return true;
                        }
                    }

                    if($crank == "B"){
                        if($money > 9000){
                            EconomyAPI::getInstance()->reduceMoney($player, "9000");
                            $rankapi->setGroup($player, $c);
                            $player->sendMessage("§bYour rank has been upgraded to §6C");
                            return true;
                        }

                        if($money == 9000){
                            EconomyAPI::getInstance()->reduceMoney($player, "9000");
                            $rankapi->setGroup($player, $c);
                            $player->sendMessage("§bYour rank has been upgraded to §6C");
                            return true;
                        }

                        if($money < 9000){
                            $player->sendMessage("§cYou don't have enough money");
                            return true;
                        }
                    }

                    if($crank == "C"){
                        if($money > 12000){
                            EconomyAPI::getInstance()->reduceMoney($player, "12000");
                            $rankapi->setGroup($player, $d);
                            $player->sendMessage("§bYour rank has been upgraded to §6D");
                            return true;
                        }

                        if($money == 12000){
                            EconomyAPI::getInstance()->reduceMoney($player, "12000");
                            $rankapi->setGroup($player, $d);
                            $player->sendMessage("§bYour rank has been upgraded to §6D");
                            return true;
                        }

                        if($money < 12000){
                            $player->sendMessage("§cYou don't have enough money");
                            return true;
                        }
                    }

                    if($crank == "D"){
                        $player->sendMessage("§cYour rank is already the higher");
                    }
                break;

                case 1:
                    $player->sendMessage("§cGood bye..");
                break;
            }
        });
        $form->setTitle(self::TITLE);

        $form->setContent("§aWelcome to §bRankUP\n§6Your rank §7[§e" . $crank . "§7]\n§bYour money : §e" . $money . "§6$");

        $form->addButton(self::UP_RANK);
        $form->addButton(self::CLOSE);

        $form->sendToPlayer($player);
    }
}