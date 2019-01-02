<?php
/**
 * Copyright (c) 2018 - 2019 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\command\defaults;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use VectorNetworkProject\TheMix\command\Permissions;

class TpsCommand extends PluginCommand
{
    /**
     * TpsCommand constructor.
     *
     * @param Plugin $owner
     */
    public function __construct(Plugin $owner)
    {
        parent::__construct('tps', $owner);
        $this->setPermission(Permissions::USER.'tps');
        $this->setDescription('TicksPerSecond');
    }

    /**
     * @param CommandSender $sender
     * @param string        $commandLabel
     * @param array         $args
     *
     * @return mixed
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        $sender->sendMessage(TextFormat::GREEN.'TPS: '.Server::getInstance()->getTicksPerSecond().'/20');

        return true;
    }
}
