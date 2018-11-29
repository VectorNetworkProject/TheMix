<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\game;


use pocketmine\event\Listener;
use pocketmine\Server;
use VectorNetworkProject\TheMix\game\DefaultConfig;
use VectorNetworkProject\TheMix\game\event\game\GameWinEvent;
use VectorNetworkProject\TheMix\task\ResetGameTask;
use VectorNetworkProject\TheMix\TheMix;

class TheEndGameEvent implements Listener
{
    public function event(GameWinEvent $event)
    {
        if (DefaultConfig::isDev()) {
            $event->setCancelled();
            return;
        }
        TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new ResetGameTask(), 30 * 20);
        Server::getInstance()->broadcastTitle('§l§f===< §6決着 §f>===', '§aWin:§l ' . $event->getType() === GameWinEvent::WIN_RED ? '§cRED' : '§bBLUE', 20, 5 * 20, 20);
        Server::getInstance()->broadcastMessage('===< END GAME >===');
        Server::getInstance()->broadcastMessage('§l§eGG!');
        Server::getInstance()->broadcastMessage('§lDiscordに参加して遊んだ感想や思った事を書いて下さい！');
        Server::getInstance()->broadcastMessage('§lDiscord: https://discord.gg/EF2G5dh');
        Server::getInstance()->broadcastMessage('§c30秒後プレイヤーの再接続とサーバー再起動を開始します。');
    }
}
