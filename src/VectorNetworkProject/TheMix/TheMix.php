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
use VectorNetworkProject\TheMix\event\BlockEventListener;
use VectorNetworkProject\TheMix\event\EntityEventListener;
use VectorNetworkProject\TheMix\event\GameEventListener;
use VectorNetworkProject\TheMix\event\LevelEventListener;
use VectorNetworkProject\TheMix\event\LibraryEventListener;
use VectorNetworkProject\TheMix\event\PlayerEventListener;
use VectorNetworkProject\TheMix\game\DefaultConfig;
use VectorNetworkProject\TheMix\task\PhaseTask;

class TheMix extends PluginBase
{
    public const VERSION = 8;

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
        $this->getScheduler()->scheduleRepeatingTask(new PhaseTask(), 20);
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
        $plm->registerEvents(new BlockEventListener(), $this);
        $plm->registerEvents(new EntityEventListener(), $this);
        $plm->registerEvents(new GameEventListener(), $this);
        $plm->registerEvents(new LevelEventListener(), $this);
        $plm->registerEvents(new LibraryEventListener(), $this);
        $plm->registerEvents(new PlayerEventListener(), $this);
    }
}
