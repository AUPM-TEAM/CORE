<?php

namespace UnNyanCat\Core\Commands;

use onebone\economyapi\EconomyAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use UnNyanCat\Core\Main;

class BuyRankCommand extends Command
{
    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if($player instanceof Player){
            $rankapi = Server::getInstance()->getPluginManager()->getPlugin("PurePerms");
            $crank = $rankapi->getUserDataMgr()->getGroup($player)->getName();
            $money = EconomyAPI::getInstance()->myMoney($player);
            $vip = $rankapi->getGroup("VIP");
            $vipplus = $rankapi->getGroup("VIPPLUS");
            $mvp = $rankapi->getGroup("MVP");
            $mvpplus = $rankapi->getGroup("MVPPLUS");
            $legendary = $rankapi->getGroup("LEGENDARY");
            $name = $player->getName();
            if($crank === "Guest"){
                str_replace("{player}", $player->getName(), Main::getConfigName("Config")->get("vip.bc"));
                if($money > Main::getConfigName("Config")->get("vip.cost")){
                    EconomyAPI::getInstance()->reduceMoney($player, Main::getConfigName("Config")->get("vip.cost"));
                    $rankapi->setGroup($player, $vip);
                    $player->sendMessage(Main::getConfigName("Config")->get("vip.done"));
                    Server::getInstance()->broadcastMessage(Main::getConfigName("Config")->get("vip.bc"));
                }else{ $player->sendMessage(Main::getConfigName("Config")->get("vip.failed")); }
            }
            if($crank === "VIP"){
                if($money > Main::getConfigName("Config")->get("vipplus.cost")){
                    EconomyAPI::getInstance()->reduceMoney($player, Main::getConfigName("Config")->get("vipplus.cost"));
                    $rankapi->setGroup($player, $vipplus);
                    $player->sendMessage(Main::getConfigName("Config")->get("vipplus.done"));
                    Server::getInstance()->broadcastMessage(Main::getConfigName("Config")->get("vipplus.bc"));
                }else{ $player->sendMessage(Main::getConfigName("Config")->get("vipplus.failed")); }
            }
            if($crank === "VIPPLUS"){
                if($money > Main::getConfigName("Config")->get("mvp.cost")){
                    EconomyAPI::getInstance()->reduceMoney($player, Main::getConfigName("Config")->get("mvp.cost"));
                    $rankapi->setGroup($player, $mvp);
                    $player->sendMessage(Main::getConfigName("Config")->get("mvp.done"));
                    Server::getInstance()->broadcastMessage(Main::getConfigName("Config")->get("mvp.bc"));
                }else{ $player->sendMessage(Main::getConfigName("Config")->get("mvp.failed")); }
            }
            if($crank === "MVP"){
                if($money > Main::getConfigName("Config")->get("mvpplus.cost")){
                    EconomyAPI::getInstance()->reduceMoney($player, Main::getConfigName("Config")->get("mvpplus.cost"));
                    $rankapi->setGroup($player, $mvpplus);
                    $player->sendMessage(Main::getConfigName("Config")->get("mvpplus.done"));
                    Server::getInstance()->broadcastMessage(Main::getConfigName("Config")->get("mvpplus.bc"));
                }else{ $player->sendMessage(Main::getConfigName("Config")->get("mvpplus.failed")); }
            }
            if($crank === "MVPPLUS"){
                if($money > Main::getConfigName("Config")->get("legendaire.cost")){
                    EconomyAPI::getInstance()->reduceMoney($player, Main::getConfigName("Config")->get("legendaire.cost"));
                    $rankapi->setGroup($player, $legendary);
                    $player->sendMessage(Main::getConfigName("Config")->get("legendaire.done"));
                    Server::getInstance()->broadcastMessage(Main::getConfigName("Config")->get("legendaire.bc"));
                }else{ $player->sendMessage(Main::getConfigName("Config")->get("legendaire.failed")); }
            }
            if($crank === "LEGENDARY"){
                $player->sendMessage("§cTu ne peux pas acheter plus haut que LEGENDARY");
            }
        }
    }
}