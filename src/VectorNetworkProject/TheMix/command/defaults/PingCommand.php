<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\command\defaults;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;

class PingCommand extends PluginCommand
{
    /**
     * PingCommand constructor.
     *
     * @param Plugin $owner
     */
    public function __construct(Plugin $owner)
    {
        parent::__construct('ping', $owner);
        $this->setDescription('応答速度を計測します。');
        $this->setPermission('the.mix.commands.user.ping');
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
        if (!$sender instanceof Player) {
            $sender->sendMessage(TextFormat::RED.'このコマンドはプレイヤーのみ実行可能です。');

            return true;
        }
        $sender->sendMessage(TextFormat::RED.$sender->getPing().TextFormat::YELLOW.'ms');

        return true;
    }
}
