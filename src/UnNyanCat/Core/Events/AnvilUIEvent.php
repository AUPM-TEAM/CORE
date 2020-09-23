<?php

namespace UnNyanCat\Core\Events;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Armor;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class AnvilUIEvent implements Listener
{
    public function onTouch(PlayerInteractEvent $event){
        $player = $event->getPlayer();
        $block = $event->getBlock();
        if ($block->getId() === 145) {
            $event->setCancelled(true);
            $this->openForm($player);
        }
    }

    public function openForm(Player $player)
    {
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = new SimpleForm(function (Player $player, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case "0":

                    $index = $player->getInventory()->getHeldItemIndex();
                    $item = $player->getInventory()->getItem($index);
                    if ($player->getXpLevel($player->getXpLevel() > 30)) {
                        if ($item instanceof Armor) {
                            $player->getInventory()->setItem($index, $item->setDamage(0));
                            $player->setXpLevel($player->getXpLevel() - 30);
                            $player->sendMessage(TextFormat::RED . "Vous avez bien repair votre armure");
                        }
                    } else {
                        $player->sendMessage(TextFormat::RED . "Vous n'avez pas assez d'xp pour repair");
                    }
                    break;
                case "1":

                    $index = $player->getInventory()->getHeldItemIndex();
                    $item = $player->getInventory()->getItem($index);
                    if ($player->getXpLevel($player->getXpLevel() > 30)) {
                        if ($item instanceof Armor) {
                            $player->getInventory()->setItem($index, $item->setDamage(0));
                            $player->setXpLevel($player->getXpLevel() - 30);
                            $player->sendMessage(TextFormat::GREEN . "Vous avez bien repair votre armure");
                        }
                    } else {
                        $player->sendMessage(TextFormat::RED . "Vous n'avez pas assez d'xp pour repair");
                    }
                    break;

                case "2":
                    $index = $player->getInventory()->getHeldItemIndex();
                    $item = $player->getInventory()->getItemInHand($index);
                    if ($player->getXpLevel($player->getXpLevel() > 30)) {
                        $player->getInventory()->setItem($index, $item->setDamage(0));
                        $player->setXpLevel($player->getXpLevel() - 30);
                        $player->sendMessage(TextFormat::RED . "Vous avez bien repair l'item");
                    } else {
                        $player->sendMessage(TextFormat::RED . "Vous n'avez pas assez d'xp pour repair");
                    }
                    break;
            }
        });
        $form->setTitle(TextFormat::BLUE . "Arthazia");
        $form->setContent(TextFormat::GRAY . "Choisissez ce que vous voulez repair");
        $form->addButton(TextFormat::GOLD . "Outils");
        $form->addButton(TextFormat::GOLD . "Armure");
        $form->addButton(TextFormat::GOLD . "Repair item en main");
        $form->addButton(TextFormat::RED . "Quitter");

        $form->sendToPlayer($player);
        return $form;
    }
}