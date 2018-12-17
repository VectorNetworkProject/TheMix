<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\event\game;

use pocketmine\event\Cancellable;
use pocketmine\event\player\PlayerEvent;
use pocketmine\Player;

class BreakCoreEvent extends PlayerEvent implements Cancellable
{
    public const RED = 0;
    public const BLUE = 1;

    /** @var int $team */
    private $team;
    /** @var int $damage */
    private $damage;

    public function __construct(Player $player, int $team, int $damage = 1)
    {
        $this->player = $player;
        $this->team = $team;
        $this->damage = $damage;
    }

    /**
     * @return int
     */
    public function getTeam(): int
    {
        return $this->team;
    }

    /**
     * @return int
     */
    public function getDamage(): int
    {
        return $this->damage;
    }

    /**
     * @param int $damage
     */
    public function setDamage(int $damage): void
    {
        $this->damage = $damage;
    }
}
