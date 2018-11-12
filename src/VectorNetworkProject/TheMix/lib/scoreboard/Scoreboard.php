<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\lib\scoreboard;


use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;
use pocketmine\Player;

class Scoreboard
{
    /* @var array $scoreboards */
    private static $scoreboards = [];

    /**
     * @param Player $player
     */
    public static function addScoreboard(Player $player): void
    {
        $packet = new SetDisplayObjectivePacket();
        $packet->displayName = "§l§6The §aM§ci§ex§7";
        $packet->displaySlot = "sidebar";
        $packet->objectiveName = "objective";
        $packet->criteriaName = "dummy";
        $packet->sortOrder = 0;
        $player->sendDataPacket($packet);
        self::$scoreboards[$player->getXuid()] = "objective";
    }

    /**
     * @param Player $player
     * @return bool
     */
    public static function hasScoreboard(Player $player): bool
    {
        return (isset(self::$scoreboards[$player->getName()]))
            ? true
            : false;
    }

    /**
     * @param Player $player
     * @param int $line
     * @param string $text
     */
    public static function setLine(Player $player, int $line, string $text): void
    {
        if (!isset(self::$scoreboards[$player->getName()])) return;
        if ($line < 1 || $line > 15) return;
        $entry = new ScorePacketEntry();
        $entry->objectiveName = "objective";
        $entry->type = ScorePacketEntry::TYPE_FAKE_PLAYER;
        $entry->customName = $text;
        $entry->score = $line;
        $entry->scoreboardId = $line;
        $score = new SetScorePacket();
        $score->type = SetScorePacket::TYPE_CHANGE;
        $score->entries[] = $entry;
        $player->sendDataPacket($score);
    }

    /**
     * @param Player $player
     */
    public static function deleteScoreboard(Player $player): void
    {
        $packet = new RemoveObjectivePacket();
        $packet->objectiveName = "objective";
        $player->sendDataPacket($packet);
        if (isset(self::$scoreboards[($player->getName())])) unset(self::$scoreboards[$player->getName()]);
    }
}
