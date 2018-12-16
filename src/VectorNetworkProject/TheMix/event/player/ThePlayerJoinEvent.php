<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\player;

use Miste\scoreboardspe\API\Scoreboard;
use Miste\scoreboardspe\API\ScoreboardAction;
use Miste\scoreboardspe\API\ScoreboardDisplaySlot;
use Miste\scoreboardspe\API\ScoreboardSort;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Server;
use VectorNetworkProject\TheMix\task\UpdateScoreboardTask;
use VectorNetworkProject\TheMix\TheMix;

class ThePlayerJoinEvent implements Listener
{
    /**
     * @param PlayerJoinEvent $event
     */
    public function event(PlayerJoinEvent $event)
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
}
