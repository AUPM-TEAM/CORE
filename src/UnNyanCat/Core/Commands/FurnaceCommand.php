<?php

namespace UnNyanCat\Core\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\Player;

class FurnaceCommand extends Command
{
    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if($player instanceof Player){
            if($player->getInventory()->getItemInHand() == Item::DIAMOND_ORE){
                $count = $player->getInventory()->getItemInHand()->getCount();

                $player->getInventory()->removeItem($player->getInventory()->getItemInHand());
                $player->getInventory()->setItemInHand(Item::get(Item::DIAMOND, 0, $count));
                $player->sendMessage("§7[§cFurnace§7] §gL'item dans votre main a bien été cuit !");

            }elseif($player->getInventory()->getItemInHand() == Item::IRON_ORE){
                $count = $player->getInventory()->getItemInHand()->getCount();

                $player->getInventory()->removeItem($player->getInventory()->getItemInHand());
                $player->getInventory()->setItemInHand(Item::get(Item::IRON_INGOT, 0, $count));
                $player->sendMessage("§7[§cFurnace§7] §gL'item dans votre main a bien été cuit !");

            }elseif($player->getInventory()->getItemInHand() == Item::GOLD_ORE){
                $count = $player->getInventory()->getItemInHand()->getCount();

                $player->getInventory()->removeItem($player->getInventory()->getItemInHand());
                $player->getInventory()->setItemInHand(Item::get(Item::GOLD_INGOT, 0, $count));
                $player->sendMessage("§7[§cFurnace§7] §gL'item dans votre main a bien été cuit !");

            }elseif($player->getInventory()->getItemInHand() == Item::LAPIS_ORE){
                $count = $player->getInventory()->getItemInHand()->getCount();

                $player->getInventory()->removeItem($player->getInventory()->getItemInHand());
                $player->getInventory()->setItemInHand(Item::get(Item::GOLD_INGOT, 0, $count));
                $player->sendMessage("§7[§cFurnace§7] §gL'item dans votre main a bien été cuit !");
            }elseif($player->getInventory()->getItemInHand() == Item::REDSTONE_ORE){
                $count = $player->getInventory()->getItemInHand()->getCount();

                $player->getInventory()->removeItem($player->getInventory()->getItemInHand());
                $player->getInventory()->setItemInHand(Item::get(Item::REDSTONE, 0, $count));
                $player->sendMessage("§7[§cFurnace§7] §gL'item dans votre main a bien été cuit !");

            }elseif($player->getInventory()->getItemInHand() == Item::EMERALD_ORE){
                $count = $player->getInventory()->getItemInHand()->getCount();

                $player->getInventory()->removeItem($player->getInventory()->getItemInHand());
                $player->getInventory()->setItemInHand(Item::get(Item::EMERALD, 0, $count));
                $player->sendMessage("§7[§cFurnace§7] §gL'item dans votre main a bien été cuit !");
            }elseif($player->getInventory()->getItemInHand() == Item::COBBLESTONE){
                $count = $player->getInventory()->getItemInHand()->getCount();

                $player->getInventory()->removeItem($player->getInventory()->getItemInHand());
                $player->getInventory()->setItemInHand(Item::get(Item::STONE, 0, $count));
                $player->sendMessage("§7[§cFurnace§7] §gL'item dans votre main a bien été cuit !");
            }else{
                $player->sendMessage("§7[§cFurnace§7] §cL'item dans votre main ne peut pas être cuit");
            }
        }
    }
}