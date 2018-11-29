<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use tokyo\pmmp\libform\FormApi;
use VectorNetworkProject\TheMix\command\defaults\DiscordCommand;
use VectorNetworkProject\TheMix\command\defaults\ModeratorCommand;
use VectorNetworkProject\TheMix\command\defaults\PingCommand;
use VectorNetworkProject\TheMix\command\defaults\TpsCommand;
use VectorNetworkProject\TheMix\command\Permissions;
use VectorNetworkProject\TheMix\event\block\TheBlockBreakEvent;
use VectorNetworkProject\TheMix\event\block\TheBlockPlaceEvent;
use VectorNetworkProject\TheMix\event\entity\TheEntityDamageByEntityEvent;
use VectorNetworkProject\TheMix\event\entity\TheEntityDamageEvent;
use VectorNetworkProject\TheMix\event\game\TheEndGameEvent;
use VectorNetworkProject\TheMix\event\player\ThePlayerJoinEvent;
use VectorNetworkProject\TheMix\event\player\ThePlayerLoginEvent;
use VectorNetworkProject\TheMix\event\player\ThePlayerQuitEvent;
use VectorNetworkProject\TheMix\game\DefaultConfig;

class TheMix extends PluginBase
{
    /* @var TheMix $instance */
    private static $instance = null;

    public const PLUGIN_CONFIG_VERSION = 1;

    public function onLoad()
    {
        self::$instance = $this;
        DefaultConfig::init();
        date_default_timezone_set('Asia/Tokyo');
        $this->getLogger()->notice('Loading System...');
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
        $this->getLogger()->notice(TextFormat::AQUA.'


        ███        ▄█    █▄       ▄████████        ▄▄▄▄███▄▄▄▄    ▄█  ▀████    ▐████▀
    ▀█████████▄   ███    ███     ███    ███      ▄██▀▀▀███▀▀▀██▄ ███    ███▌   ████▀
       ▀███▀▀██   ███    ███     ███    █▀       ███   ███   ███ ███▌    ███  ▐███
        ███   ▀  ▄███▄▄▄▄███▄▄  ▄███▄▄▄          ███   ███   ███ ███▌    ▀███▄███▀
        ███     ▀▀███▀▀▀▀███▀  ▀▀███▀▀▀          ███   ███   ███ ███▌    ████▀██▄
        ███       ███    ███     ███    █▄       ███   ███   ███ ███    ▐███  ▀███
        ███       ███    ███     ███    ███      ███   ███   ███ ███   ▄███     ███▄
       ▄████▀     ███    █▀      ██████████       ▀█   ███   █▀  █▀   ████       ███▄


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
        $plm->registerEvents(new TheEntityDamageByEntityEvent(), $this);
        $plm->registerEvents(new TheEndGameEvent(), $this);
    }
}
