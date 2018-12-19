<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event;

use InkoHX\GoldLibrary\GoldAPI;
use InkoHX\LeveLibrary\LevelAPI;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueTeamManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedTeamManager;
use VectorNetworkProject\TheMix\game\DefaultConfig;
use VectorNetworkProject\TheMix\game\event\game\BreakCoreEvent;
use VectorNetworkProject\TheMix\game\event\game\GameWinEvent;
use VectorNetworkProject\TheMix\game\event\player\PlayerStreakEvent;
use VectorNetworkProject\TheMix\lib\sound\LevelSounds;
use VectorNetworkProject\TheMix\task\ResetGameTask;
use VectorNetworkProject\TheMix\TheMix;

class GameEventListener implements Listener
{
    /** @var bool $finish */
    private static $finish = false;

    /**
     * @param BreakCoreEvent $event
     *
     * @throws \ErrorException
     */
    public function onBreakCore(BreakCoreEvent $event)
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

    /**
     * @param PlayerStreakEvent $event
     */
    public function onStreak(PlayerStreakEvent $event)
    {
        $player = $event->getPlayer();
        switch ($event->getCount()) {
            case 5:
            case 10:
            case 20:
            case 30:
            case 40:
            case 50:
            case 60:
            case 70:
            case 80:
            case 90:
            case 100:
            Server::getInstance()->broadcastMessage("§l§cSTREAK! §r{$player->getName()}が{$event->getCount()}回連続でキルしました！");
                break;
        }
    }

    /**
     * @param GameWinEvent $event
     */
    public function event(GameWinEvent $event)
    {
        if (DefaultConfig::isDev()) {
            $event->setCancelled();

            return;
        }
        self::setFinish(true);
        foreach (Server::getInstance()->getOnlinePlayers() as $player) {
            if ($player->getLevel()->getName() === DefaultConfig::getStageLevelName()) {
                $player->setGamemode(Player::ADVENTURE);
                $player->setFlying(true);
                $player->getInventory()->clearAll();
            }
            if ($event->getType() === GameWinEvent::WIN_RED) {
                if (RedTeamManager::isJoined($player)) {
                    GoldAPI::addGold($player, 1000);
                }
            } else {
                if (BlueTeamManager::isJoined($player)) {
                    GoldAPI::addGold($player, 1000);
                }
            }
        }
        TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new ResetGameTask(), 30 * 20);
        Server::getInstance()->broadcastTitle('§l§f===< §6決着 §f>===', '§aWin:§l '.$event->getType() === GameWinEvent::WIN_RED ? '§cRED' : '§bBLUE', 20, 5 * 20, 20);
        Server::getInstance()->broadcastMessage('===< END GAME >===');
        Server::getInstance()->broadcastMessage('§l§eGG! TheMix v0.0.8-BETA');
        Server::getInstance()->broadcastMessage('§lDiscordに参加して遊んだ感想や改善してほしい点などを書いて下さい！');
        Server::getInstance()->broadcastMessage('§lDiscord: https://discord.gg/EF2G5dh');
        Server::getInstance()->broadcastMessage('§c30秒後プレイヤーの再接続とサーバー再起動を開始します。');
    }

    /**
     * @param bool $finish
     */
    public static function setFinish(bool $finish): void
    {
        self::$finish = $finish;
    }

    /**
     * @return bool
     */
    public static function isFinish(): bool
    {
        return self::$finish;
    }
}
