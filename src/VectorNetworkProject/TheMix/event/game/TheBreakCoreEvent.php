<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

/**
 * Created by PhpStorm.
 * User: InkoHX
 * Date: 2018/12/17
 * Time: 23:59.
 */

namespace VectorNetworkProject\TheMix\event\game;

use InkoHX\GoldLibrary\GoldAPI;
use InkoHX\LeveLibrary\LevelAPI;
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueTeamManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedTeamManager;
use VectorNetworkProject\TheMix\game\event\game\BreakCoreEvent;
use VectorNetworkProject\TheMix\lib\sound\LevelSounds;

class TheBreakCoreEvent implements Listener
{
    /**
     * @param BreakCoreEvent $event
     *
     * @throws \ErrorException
     */
    public function event(BreakCoreEvent $event)
    {
        $player = $event->getPlayer();
        if (RedTeamManager::getListCount() < 1 || BlueTeamManager::getListCount() < 1) {
            $player->sendMessage(TextFormat::RED.'プレイヤーが足りないのでコアを破壊する事が出来ません。');
            $event->setCancelled();

            return;
        }
        switch ($event->getTeam()) {
            case BreakCoreEvent::RED:
                Server::getInstance()->broadcastMessage("§l§cRED§rのコアが§b{$player->getName()}§rによって攻撃を受けています。");
                foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                    LevelSounds::NotePiano($player);
                    if (RedTeamManager::isJoined($player)) {
                        LevelAPI::Auto($player, 5);
                        GoldAPI::addGold($player, 5);
                    }
                }
                break;
            case BreakCoreEvent::BLUE:
                Server::getInstance()->broadcastMessage("§l§bBLUR§rのコアが§c{$player->getName()}§rによって攻撃を受けています。");
                foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                    LevelSounds::NotePiano($player);
                    if (BlueTeamManager::isJoined($player)) {
                        LevelAPI::Auto($player, 5);
                        GoldAPI::addGold($player, 5);
                    }
                }
                break;
            default:
                throw new \ErrorException('The core was destroyed by a team that does not exist.');
                break;
        }
    }
}
