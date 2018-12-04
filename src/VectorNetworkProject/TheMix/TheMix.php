<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix;

use InkoHX\GoldLibrary\GoldAPI;
use InkoHX\LeveLibrary\LevelAPI;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use tokyo\pmmp\libform\FormApi;
use VectorNetworkProject\TheMix\command\defaults\DiscordCommand;
use VectorNetworkProject\TheMix\command\defaults\ModeratorCommand;
use VectorNetworkProject\TheMix\command\defaults\PingCommand;
use VectorNetworkProject\TheMix\command\defaults\TpsCommand;
use VectorNetworkProject\TheMix\command\Permissions;
use VectorNetworkProject\TheMix\event\block\BlockReGeneratorEvent;
use VectorNetworkProject\TheMix\event\block\TheBlockBreakEvent;
use VectorNetworkProject\TheMix\event\block\TheBlockPlaceEvent;
use VectorNetworkProject\TheMix\event\entity\TheEntityDamageEvent;
use VectorNetworkProject\TheMix\event\game\TheEndGameEvent;
use VectorNetworkProject\TheMix\event\game\ThePlayerStreakEvent;
use VectorNetworkProject\TheMix\event\gold\ThePlayerAddGoldEvent;
use VectorNetworkProject\TheMix\event\level\TheItemSpawnEvent;
use VectorNetworkProject\TheMix\event\level\TheLevelUpEvent;
use VectorNetworkProject\TheMix\event\level\ThePlayerAddXpEvent;
use VectorNetworkProject\TheMix\event\player\ThePlayerInteractEvent;
use VectorNetworkProject\TheMix\event\player\ThePlayerJoinEvent;
use VectorNetworkProject\TheMix\event\player\ThePlayerLoginEvent;
use VectorNetworkProject\TheMix\event\player\ThePlayerQuitEvent;
use VectorNetworkProject\TheMix\game\DefaultConfig;

class TheMix extends PluginBase
{
    public const VERSION = 6;

    /* @var TheMix $instance */
    private static $instance = null;

    public function onLoad()
    {
        $this->getLogger()->notice('Loading System...');
        self::$instance = $this;
        $this->saveDefaultConfig();
        DefaultConfig::getVersion() === self::VERSION
            ? $this->getLogger()->info('Loaded Config')
            : $this->getLogger()->alert('Please update config.yml');
        LevelAPI::init();
        GoldAPI::init();
        date_default_timezone_set(DefaultConfig::getTimezone());
    }

    public function onEnable()
    {
        Permissions::registerPermissions();
        FormApi::register($this);
        $this->registerCommands();
        $this->registerEvents();
        $this->getServer()->loadLevel(DefaultConfig::getStageLevelName())
            ? $this->getLogger()->notice('Loaded stage.')
            : $this->getServer()->generateLevel(DefaultConfig::getStageLevelName());
        $this->getLogger()->notice(TextFormat::RED.'
        
        
        ▄▄▄█████▓ ██░ ██ ▓█████     ███▄ ▄███▓ ██▓▒██   ██▒
        ▓  ██▒ ▓▒▓██░ ██▒▓█   ▀    ▓██▒▀█▀ ██▒▓██▒▒▒ █ █ ▒░
        ▒ ▓██░ ▒░▒██▀▀██░▒███      ▓██    ▓██░▒██▒░░  █   ░
        ░ ▓██▓ ░ ░▓█ ░██ ▒▓█  ▄    ▒██    ▒██ ░██░ ░ █ █ ▒ 
          ▒██▒ ░ ░▓█▒░██▓░▒████▒   ▒██▒   ░██▒░██░▒██▒ ▒██▒
        ▒ ░░    ▒ ░░▒░▒░░ ▒░ ░   ░ ▒░   ░  ░░▓  ▒▒ ░ ░▓ ░
        ░     ▒ ░▒░ ░ ░ ░  ░   ░  ░      ░ ▒ ░░░   ░▒ ░
        ░       ░  ░░ ░   ░      ░      ░    ▒ ░ ░    ░  
                ░  ░  ░   ░  ░          ░    ░   ░    ░  
                                                   
    §7Copyright (c) 2018 VectorNetworkProject. All rights reserved.
        ');
    }

    public function onDisable()
    {
        $this->getLogger()->notice('Unload System...');
    }

    /**
     * @return TheMix
     */
    public static function getInstance(): self
    {
        return self::$instance;
    }

    private function registerCommands(): void
    {
        $commands = [
            new PingCommand($this),
            new TpsCommand($this),
            new ModeratorCommand($this),
            new DiscordCommand($this),
        ];
        $this->getServer()->getCommandMap()->registerAll($this->getName(), $commands);
    }

    private function registerEvents(): void
    {
        $plm = $this->getServer()->getPluginManager();
        $plm->registerEvents(new ThePlayerLoginEvent(), $this);
        $plm->registerEvents(new ThePlayerJoinEvent(), $this);
        $plm->registerEvents(new ThePlayerQuitEvent(), $this);
        $plm->registerEvents(new TheBlockBreakEvent(), $this);
        $plm->registerEvents(new TheBlockPlaceEvent(), $this);
        $plm->registerEvents(new TheEntityDamageEvent(), $this);
        $plm->registerEvents(new TheEndGameEvent(), $this);
        $plm->registerEvents(new ThePlayerStreakEvent(), $this);
        $plm->registerEvents(new TheLevelUpEvent(), $this);
        $plm->registerEvents(new ThePlayerAddGoldEvent(), $this);
        $plm->registerEvents(new ThePlayerAddXpEvent(), $this);
        $plm->registerEvents(new BlockReGeneratorEvent(), $this);
        $plm->registerEvents(new ThePlayerInteractEvent(), $this);
        $plm->registerEvents(new TheItemSpawnEvent(), $this);
    }
}
