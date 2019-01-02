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
use VectorNetworkProject\TheMix\command\Permissions;

class DiscordCommand extends PluginCommand
{
    /**
     * DiscordCommand constructor.
     *
     * @param Plugin $owner
     */
    public function __construct(Plugin $owner)
    {
        parent::__construct('discord', $owner);
        $this->setDescription('Discordの招待リンクを送信します。');
        $this->setPermission(Permissions::USER.'discord');
    }

    /**
     * @param CommandSender $sender
     * @param string        $commandLabel
     * @param array         $args
     *
     * @return bool|mixed
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        $sender->sendMessage('§9Discord: https://discord.gg/EF2G5dh');

        return true;
    }
}
