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

class PlayerXpChangeEvent extends PlayerEvent implements Cancellable
{
    /* @var int $xp */
    private $xp;

    /**
     * PlayerXpChangeEvent constructor.
     *
     * @param Player $player
     * @param int    $xp
     */
    public function __construct(Player $player, int $xp)
    {
        $this->player = $player;
        $this->xp = $xp;
    }

    /**
     * 入手したXPを返します。
     *
     * @return int
     */
    public function getXp(): int
    {
        return $this->xp;
    }
}
