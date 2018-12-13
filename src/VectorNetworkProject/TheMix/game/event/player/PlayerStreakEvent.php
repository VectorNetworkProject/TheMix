<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\event\player;

use pocketmine\event\Cancellable;
use pocketmine\event\player\PlayerEvent;
use pocketmine\Player;

class PlayerStreakEvent extends PlayerEvent implements Cancellable
{
    /** @var int $count */
    private $count;

    /**
     * PlayerStreakEvent constructor.
     * @param Player $player
     * @param int $count
     */
    public function __construct(Player $player, int $count)
    {
        $this->player = $player;
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
}
