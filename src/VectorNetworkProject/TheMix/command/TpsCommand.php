<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\command;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class TpsCommand extends PluginCommand
{
    public function __construct(Plugin $owner)
    {
        parent::__construct('tps', $owner);
        $this->setPermission('the.mix.command.tps');
        $this->setDescription('TicksPerSecond');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool
    {
        $sender->sendMessage(TextFormat::GREEN.'TPS: '.Server::getInstance()->getTicksPerSecond().'/20');

        return true;
    }
}
