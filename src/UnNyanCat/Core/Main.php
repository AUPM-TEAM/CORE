<?php

namespace UnNyanCat\Core;

/**
 * FOR REGISTER EVENTS
 */
use pocketmine\event\Listener;

/**
 * FOR PLUGIN
 */

use pocketmine\item\ItemFactory;
use pocketmine\plugin\PluginBase;

/**
 * CONFIG USE
 */
use pocketmine\utils\Config;
use UnNyanCat\Core\CustomItems\HammerItem;

/**
 * API
 * use UnNyanCat\Core\API\MessageAPI;
 */

class Main extends PluginBase implements Listener
{
    /** @var Main $instance */
    private static $instance;

    /** @var array $messages */
    public $messages = [];

    /** @var $points Config */

    public $points;

    /** @var $levels Config */

    public $levels;

    public function onEnable()
    {
        self::$instance = $this;

        /**
         * CONFIG
         */
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getResource("config.yml");

        $this->points = new Config($this->getDataFolder() . "Points.yml", Config::YAML);
        $this->levels = new Config($this->getDataFolder() . "Levels.yml", Config::YAML);

        /**
         * MESSAGE WHEN THE PLUGIN IS LOADED
         */

        $this->getLogger()->info("Core activé avec succès");

        /**
         * EVENTS
         */

        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getServer()->getPluginManager()->registerEvents(new Events\PlayerEvents(),$this);
        $this->getServer()->getPluginManager()->registerEvents(new Events\RandomOreEvent(),$this);
        $this->getServer()->getPluginManager()->registerEvents(new Events\ShowCoordsEvent(),$this);
        $this->getServer()->getPluginManager()->registerEvents(new Events\FarmArmorEvent(),$this);
        $this->getServer()->getPluginManager()->registerEvents(new Events\HammerEvent(),$this);
        $this->getServer()->getPluginManager()->registerEvents(new Events\AnvilUIEvent(),$this);

        /**
         * COMMANDS
         */

        $this->getServer()->getCommandMap()->registerAll('commands',
            [
                new Commands\ProutCommand("prout", "Prout", "prout"),

                new Commands\HealCommand("heal", "Heal a player or heal you", "fheal [player]"),
                new Commands\FeedCommand("feed", "Feed a player or feed you", "hfeed [player]"),

                new Commands\AddPointCommand("addpoint", "Add points", "addpoint [points]"),
                new Commands\AddLevelCommand("addlevel", "Add levels", "addlevel [levels]"),

                new Commands\RankUpCommand("rankup", "Rank UP", "rankup"),

                new Commands\RandomTeleportCommand("randomtp", "Teleport you in wild", '/randomtp', ['rtp','wild']),

                new Commands\FurnaceCommand("furnace", "Furnace item in your hand", "/furnace"),

                new Commands\AddXP("addxp", "Add xp !", "/addxp [number]"),
            ]
        );

        /**
         * ITEMS
         */
        ItemFactory::registerItem(new HammerItem(), true);

        if(file_exists($this->getDataFolder() . "Points.yml")){

        }else{
            $this->getLogger()->info("The Points.yml file has been created");
            $this->saveResource("Points.yml");
        }

        if(file_exists($this->getDataFolder() . "Levels.yml")){

        }else{
            $this->getLogger()->info("The Levels.yml file has been created");
            $this->saveResource("Levels.yml");
        }
    }

    public function onDisable()
    {
        $this->getLogger()->info("Core désactivé avec succès");
    }

    public static function getInstance(){
        return self::$instance;
    }

    public static function getConfigName(string $fileName){
        return $fileName = new Config(Main::getInstance()->getDataFolder() . $fileName . ".yml", Config::YAML);
    }
}