<?php

namespace UnNyanCat\Core;

/**
 * FOR REGISTER EVENTS
 */

use pocketmine\entity\Entity;
use pocketmine\event\Listener;

/**
 * FOR PLUGIN
 */
use pocketmine\plugin\PluginBase;

/**
 * CUSTOM CRAFTS
 */
use pocketmine\inventory\ShapedRecipe;

/**
 * CUSTOM ITEMS AND CUSTOM CRAFTS
 */
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
/**
 * TARGET A PLAYER
 */
use pocketmine\Player;
/**
 * CONFIG USE
 */
use pocketmine\utils\Config;

/**
 * CUSTOM ITEMS
 */

use UnNyanCat\Core\Commands\SpawnEntity;
use UnNyanCat\Core\CustomItems\FishingHook;
use UnNyanCat\Core\CustomItems\FishingRod;
use UnNyanCat\Core\CustomItems\HammerItem;

/**
 * API
 * use UnNyanCat\Core\API\MessageAPI;
 */

class Main extends PluginBase implements Listener
{
    private static $fishing = [];

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
        Main::eventsRegister();
        Main::registerCraftCustoms();

        /**
         * ENTITIES
         */
        Entity::registerEntity(Mobs\Vache::class, true);
        Entity::registerEntity(Mobs\Poulet::class, true);
        Entity::registerEntity(Mobs\Cochon::class, true);

        /**
         * COMMANDS
         */

        $this->getServer()->getCommandMap()->registerAll('commands',
            [
                new SpawnEntity(
                    "spawnentity",
                    "Make an entity !",
                    "spawnentity [cochon|vache|poulet]",
                    [
                        "newentity",
                        "makeentity",
                        "entitymake",
                        "entitycreate"
                    ]
                ),

                new Commands\ProutCommand("prout", "Prout", "prout"),

                new Commands\HealCommand("heal", "Heal a player or heal you", "fheal [player]"),
                new Commands\FeedCommand("feed", "Feed a player or feed you", "hfeed [player]"),

                new Commands\AddPointCommand("addpoint", "Add points", "addpoint [points]"),
                new Commands\AddLevelCommand("addlevel", "Add levels", "addlevel [levels]"),

                new Commands\RankUpCommand("rankup", "Rank UP", "rankup"),
                new Commands\BuyRankCommand("buyrank", "Buy Rank", "buyrank", [
                    "buyranke",
                    "buyranks",
                    "buyr",
                    "brank"
                ]),

                new Commands\RandomTeleportCommand("randomtp", "Teleport you in wild", '/randomtp', ['rtp','wild']),

                new Commands\FurnaceCommand("furnace", "Furnace item in your hand", "/furnace"),

                new Commands\AddXP("addxp", "Add xp !", "/addxp [number]"),

                new Commands\SudoCommand("sudo", "Sudo a player !"),
            ]
        );

        /**
         * ITEMS CUSTOMS
         */
        ItemFactory::registerItem(new FishingRod(), true);
        Entity::registerEntity(FishingHook::class, false, ['FishingHook', 'minecraft:fishinghook']);

        ItemFactory::registerItem(new HammerItem(), true);
        Item::initCreativeItems();

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

    public static function getFishingHook(Player $player) : ?FishingHook{
        return self::$fishing[$player->getName()] ?? null;
    }

    public static function setFishingHook(?FishingHook $fish, Player $player){
        self::$fishing[$player->getName()] = $fish;
    }

    public static function registerCraftCustoms(){
        /**
         * CUSTOM CRAFTS REGISTER
         */
        /**
         * Craft du Casque en Teranium
         */
        $item = Item::get(Item::CHAINMAIL_HELMET);
        $item->setCustomName("§6Casque en Teranium");
        $helmet = new ShapedRecipe(["AAA", "A A", "   "],["A"=>Item::get(Item::RABBIT_FOOT)],[$item]);
        $helmet->registerToCraftingManager(Main::getInstance()->getServer()->getCraftingManager());

        /**
         * Craft du Plastron en Teranium
         */
        $item = Item::get(Item::CHAINMAIL_CHESTPLATE);
        $item->setCustomName("§6Plastron en Teranium");
        $chestplate = new ShapedRecipe(["A A", "AAA", "AAA"],["A"=>Item::get(Item::RABBIT_FOOT)],[$item]);
        $chestplate->registerToCraftingManager(Main::getInstance()->getServer()->getCraftingManager());

        /**
         * Craft du Leggings en Teranium
         */
        $item = Item::get(Item::CHAINMAIL_LEGGINGS);
        $item->setCustomName("§6Leggings en Teranium");
        $leggings = new ShapedRecipe(["AAA", "A A", "A A"],["A"=>Item::get(Item::RABBIT_FOOT)],[$item]);
        $leggings->registerToCraftingManager(Main::getInstance()->getServer()->getCraftingManager());

        /**
         * Craft des Bottes en Teranium
         */
        $item = Item::get(Item::CHAINMAIL_BOOTS);
        $item->setCustomName("§6Bottes en Teranium");
        $boots = new ShapedRecipe(["   ", "A A", "A A"],["A"=>Item::get(Item::RABBIT_FOOT)],[$item]);
        $boots->registerToCraftingManager(Main::getInstance()->getServer()->getCraftingManager());
        /**
         * Craft de l'épée en Teranium
         */
        $item = Item::get(Item::CHAINMAIL_BOOTS);
        $item->setCustomName("§6Bottes en Teranium");
        $sword = new ShapedRecipe([" A ", " A ", " B "],["A"=>Item::get(Item::RABBIT_FOOT),"B"=>Item::get(Item::STICK)],[$item]);
        $sword->registerToCraftingManager(Main::getInstance()->getServer()->getCraftingManager());
    }

    public static function eventsRegister(){
        Main::getInstance()->getServer()->getPluginManager()->registerEvents(Main::getInstance(),Main::getInstance());
        Main::getInstance()->getServer()->getPluginManager()->registerEvents(new Events\PlayerEvents(),Main::getInstance());
        Main::getInstance()->getServer()->getPluginManager()->registerEvents(new Events\RandomOreEvent(),Main::getInstance());
        Main::getInstance()->getServer()->getPluginManager()->registerEvents(new Events\ShowCoordsEvent(),Main::getInstance());
        Main::getInstance()->getServer()->getPluginManager()->registerEvents(new Events\FarmArmorEvent(),Main::getInstance());
        Main::getInstance()->getServer()->getPluginManager()->registerEvents(new Events\HammerEvent(),Main::getInstance());
        Main::getInstance()->getServer()->getPluginManager()->registerEvents(new Events\AnvilUIEvent(),Main::getInstance());
        Main::getInstance()->getServer()->getPluginManager()->registerEvents(new Events\DynamiteEvent(),Main::getInstance());
        Main::getInstance()->getServer()->getPluginManager()->registerEvents(new Events\BoxEvent(),Main::getInstance());
        Main::getInstance()->getServer()->getPluginManager()->registerEvents(new Events\Sticks(),Main::getInstance());
        Main::getInstance()->getServer()->getPluginManager()->registerEvents(new Events\LobbyEvents(),Main::getInstance());
    }
}