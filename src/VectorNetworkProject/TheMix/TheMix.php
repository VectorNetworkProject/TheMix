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
use VectorNetworkProject\TheMix\command\PingCommand;
use VectorNetworkProject\TheMix\command\TpsCommand;
use VectorNetworkProject\TheMix\event\ThePlayerJoinEvent;
use VectorNetworkProject\TheMix\event\ThePlayerLoginEvent;
use VectorNetworkProject\TheMix\event\ThePlayerQuitEvent;

class TheMix extends PluginBase
{
    /* @var TheMix $instance */
    private static $instance = null;

    public function onLoad()
    {
        self::$instance = $this;
        $this->getLogger()->notice("Loading System...");
    }

    public function onEnable()
    {
        $this->registerCommands();
        $this->registerEvents();
        $this->getLogger()->notice(TextFormat::AQUA . '


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
        $this->getLogger()->notice("Unload System...");
    }

    /**
     * @return TheMix
     */
    public static function getInstance(): TheMix
    {
        return self::$instance;
    }

    private function registerCommands(): void
    {
        $commands = [
            new PingCommand($this),
            new TpsCommand($this)
        ];
        $this->getServer()->getCommandMap()->registerAll($this->getName(), $commands);
    }

    private function registerEvents(): void
    {
        $plm = $this->getServer()->getPluginManager();
        $plm->registerEvents(new ThePlayerLoginEvent(), $this);
        $plm->registerEvents(new ThePlayerJoinEvent(), $this);
        $plm->registerEvents(new ThePlayerQuitEvent(), $this);
    }
}
