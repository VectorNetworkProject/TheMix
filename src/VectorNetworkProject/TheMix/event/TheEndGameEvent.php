<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event;


use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use VectorNetworkProject\TheMix\game\DefaultConfig;
use VectorNetworkProject\TheMix\game\event\game\GameWinEvent;
use VectorNetworkProject\TheMix\task\ResetGameTask;
use VectorNetworkProject\TheMix\TheMix;

class TheEndGameEvent implements Listener
{
    public function event(GameWinEvent $event)
    {
        TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new ResetGameTask(), 30 * 20);
        switch ($event->getType()) {
            case GameWinEvent::WIN_RED:
                Server::getInstance()->broadcastMessage('§a===<§e END §a>===');
                Server::getInstance()->broadcastMessage(TextFormat::GRAY.$event->getPlayer()->getName().'が§cREDを落とした！GG');
                Server::getInstance()->broadcastMessage(TextFormat::RED.'30秒後再起動と同時にプレイヤーをサーバーに再接続させます。');
                break;
            case GameWinEvent::WIN_BLUE:
                Server::getInstance()->broadcastMessage('§a===<§e END §a>===');
                Server::getInstance()->broadcastMessage(TextFormat::GRAY.$event->getPlayer()->getName().'が§bBLUEを落とした！GG');
                Server::getInstance()->broadcastMessage(TextFormat::RED.'30秒後再起動と同時にプレイヤーをサーバーに再接続させます。');
                break;
        }
    }
}
