<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use Miste\scoreboardspe\API\{
    Scoreboard, ScoreboardDisplaySlot, ScoreboardSort, ScoreboardAction
};
use VectorNetworkProject\TheMix\task\UpdateScoreboardTask;
use VectorNetworkProject\TheMix\TheMix;

class ThePlayerJoinEvent implements Listener
{
    public function event(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        $scoreboard = new Scoreboard(TheMix::getInstance()->getServer()->getPluginManager()->getPlugin("ScoreboardsPE")->getPlugin(), "§l§7=== §6THE §aM§cI§eX §7===", ScoreboardAction::CREATE);
        $scoreboard->create(ScoreboardDisplaySlot::SIDEBAR, ScoreboardSort::DESCENDING);
        $scoreboard->addDisplay($player);
        TheMix::getInstance()->getScheduler()->scheduleRepeatingTask(new UpdateScoreboardTask($scoreboard, $player), 20);
    }
}
