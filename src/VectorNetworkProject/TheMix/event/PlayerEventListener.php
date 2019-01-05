<?php
/**
 * Copyright (c) 2018 - 2019 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event;

use Miste\scoreboardspe\API\Scoreboard;
use Miste\scoreboardspe\API\ScoreboardAction;
use Miste\scoreboardspe\API\ScoreboardDisplaySlot;
use Miste\scoreboardspe\API\ScoreboardSort;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Player;
use pocketmine\Server;
use VectorNetworkProject\TheMix\game\bounty\Bounty;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueTeamManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedTeamManager;
use VectorNetworkProject\TheMix\game\corepvp\TeamManager;
use VectorNetworkProject\TheMix\game\DefaultConfig;
use VectorNetworkProject\TheMix\game\event\player\PlayerBountyEvent;
use VectorNetworkProject\TheMix\game\event\player\PlayerStreakEvent;
use VectorNetworkProject\TheMix\game\streak\Streak;
use VectorNetworkProject\TheMix\task\UpdateScoreboardTask;
use VectorNetworkProject\TheMix\TheMix;

class PlayerEventListener implements Listener
{
    /**
     * @param PlayerLoginEvent $event
     */
    public function onLogin(PlayerLoginEvent $event)
    {
        $player = $event->getPlayer();
        Bounty::init($player);
        Streak::init($player);
    }

    /**
     * @param PlayerJoinEvent $event
     */
    public function onJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        $player->teleport(Server::getInstance()->getDefaultLevel()->getSpawnLocation());
        $player->addEffect(new EffectInstance(Effect::getEffect(Effect::NIGHT_VISION), 99999999 * 20, 11, false));
        $event->setJoinMessage('§7[§a参加§7] §e'.$player->getName().'が参加しました。');
        $scoreboard = new Scoreboard(TheMix::getInstance()->getServer()->getPluginManager()->getPlugin('ScoreboardsPE')->getPlugin(), '§l§7=== §6THE §aM§cI§eX §7===', ScoreboardAction::CREATE);
        $scoreboard->create(ScoreboardDisplaySlot::SIDEBAR, ScoreboardSort::DESCENDING);
        $scoreboard->addDisplay($player);
        TheMix::getInstance()->getScheduler()->scheduleRepeatingTask(new UpdateScoreboardTask($scoreboard, $player), 20);
    }

    /**
     * @param PlayerInteractEvent $event
     */
    public function onInteract(PlayerInteractEvent $event)
    {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        if ($block->getId() === DefaultConfig::getBlockId()) {
            if (DefaultConfig::isDev()) {
                return;
            }
            TeamManager::JoinTeam($player);
            $player->setGamemode(Player::SURVIVAL);
        }
    }

    /**
     * @param PlayerStreakEvent $event
     */
    public function onStreak(PlayerStreakEvent $event)
    {
        $player = $event->getPlayer();
        $streakTable = [5, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
        foreach ($streakTable as $value) {
            if ($value === $event->getCount()) {
                Server::getInstance()->broadcastMessage("§l§cSTREAK! §r{$player->getName()}が{$event->getCount()}回連続でキルしました！");
            }
        }
    }

    /**
     * @param PlayerBountyEvent $event
     */
    public function onBounty(PlayerBountyEvent $event)
    {
        $player = $event->getPlayer();
        switch ($event->getType()) {
            case PlayerBountyEvent::ENABLE_BOUNTY:
                Server::getInstance()->broadcastMessage("§l§6BOUNTY! §r{$player->getName()}に§6{$event->getGold()}g§rの懸賞金が掛けられた。");
                break;
            case PlayerBountyEvent::PLUS_GOLD:
                Server::getInstance()->broadcastMessage("§l§6BOUNTY! §r{$player->getName()}の懸賞金が§6{$event->getGold()}g§rプラスされた！");
                break;
        }
    }

    /**
     * @param PlayerQuitEvent $event
     */
    public function onQuit(PlayerQuitEvent $event)
    {
        $player = $event->getPlayer();
        $event->setQuitMessage('§7[§c退出§7] §e'.$player->getName().'が退出しました。');
        RedTeamManager::removeList($player);
        BlueTeamManager::removeList($player);
        Streak::unsetStreak($player);
    }
}
