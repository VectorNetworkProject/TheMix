<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp;


use pocketmine\Player;

abstract class TeamManager
{
    abstract public static function addList(Player $player): void;

    abstract public static function removeList(Player $player): void;

    abstract public static function isJoined(Player $player): bool;

    abstract public static function getList(): array;
}
