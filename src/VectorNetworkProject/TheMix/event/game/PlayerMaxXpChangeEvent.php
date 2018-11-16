<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\game;

use pocketmine\event\Cancellable;
use pocketmine\event\player\PlayerEvent;
use pocketmine\Player;

class PlayerChangeMaxXpEvent extends PlayerEvent implements Cancellable
{
    /* @var int $max */
    private $max;

    /**
     * PlayerChangeMaxXpEvent constructor.
     *
     * @param Player $player
     * @param int $max
     */
    public function __construct(Player $player, int $max)
    {
        $this->player = $player;
        $this->max = $max;
    }

    /**
     * MaxXPを返します。
     *
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }
}
