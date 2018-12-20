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
use VectorNetworkProject\TheMix\game\corepvp\PhaseManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedTeamManager;
use VectorNetworkProject\TheMix\game\DefaultConfig;
use VectorNetworkProject\TheMix\game\event\game\BreakCoreEvent;
use VectorNetworkProject\TheMix\game\event\game\GameWinEvent;
use VectorNetworkProject\TheMix\game\event\game\PhaseTimeUpdateEvent;
use VectorNetworkProject\TheMix\game\event\game\PhaseUpdateEvent;
use VectorNetworkProject\TheMix\game\event\player\PlayerStreakEvent;
use VectorNetworkProject\TheMix\lib\sound\LevelSounds;
use VectorNetworkProject\TheMix\task\ResetGameTask;
use VectorNetworkProject\TheMix\TheMix;

class GameEventListener implements Listener
{
    /** @var bool $finish */
    private static $finish = false;

    /** @var bool $break */
    private $break = false;

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
                if (!$this->isBreak()) {
                    $event->setCancelled();
                    $event->getPlayer()->sendMessage('§6WAR TIME §fになるまでコアは破壊出来ません。HAHAHA');

                    return;
                }
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
                if (!$this->isBreak()) {
                    $event->setCancelled();
                    $event->getPlayer()->sendMessage('§6WAR TIME §fになるまでコアは破壊出来ません。HAHAHA');

                    return;
                }
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
    public function onGameWin(GameWinEvent $event)
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
        Server::getInstance()->broadcastMessage('§l§eGG! TheMix v0.0.9-BETA');
        Server::getInstance()->broadcastMessage('§lDiscordに参加して遊んだ感想や改善してほしい点などを書いて下さい！');
        Server::getInstance()->broadcastMessage('§lDiscord: https://discord.gg/EF2G5dh');
        Server::getInstance()->broadcastMessage('§c30秒後ゲームをリセットします。');
    }

    /**
     * @param PhaseTimeUpdateEvent $event
     *
     * @throws \ReflectionException
     */
    public function onPhaseTimeUpdate(PhaseTimeUpdateEvent $event)
    {
        if (RedTeamManager::getListCount() < 1 || BlueTeamManager::getListCount() < 1 || PhaseManager::MAX_PHASE === $event->getPhase() || self::isFinish()) {
            Server::getInstance()->broadcastPopup("§l§cTIME: {$event->getTime()} : Phase: {$event->getPhase()}");
            $event->setCancelled();

            return;
        } elseif ($event->getTime() === 0) {
            PhaseManager::addPhase();
        }
        Server::getInstance()->broadcastPopup("§l{$event->getTime()} : Phase: {$event->getPhase()}");
    }

    /**
     * @param PhaseUpdateEvent $event
     */
    public function onPhaseUpdate(PhaseUpdateEvent $event)
    {
        if (RedTeamManager::getListCount() < 1 || BlueTeamManager::getListCount()) {
            $event->setCancelled();

            return;
        }
        switch ($event->getPhase()) {
            case 2:
                $this->setBreak(true);
                Server::getInstance()->broadcastTitle('§l§6WAR TIME', 'コアの破壊が可能になりました。', 20, 100, 20);
                break;
            case 3:
                BlockEventListener::setDiamond(true);
                Server::getInstance()->broadcastTitle('§l§cRUSH TIME', '攻め時だ！ダイヤを確保し敵陣へ乗り込め！', 20, 100, 20);
                break;
        }
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

    /**
     * @return bool
     */
    private function isBreak(): bool
    {
        return $this->break;
    }

    /**
     * @param bool $break
     */
    private function setBreak(bool $break): void
    {
        $this->break = $break;
    }
}
