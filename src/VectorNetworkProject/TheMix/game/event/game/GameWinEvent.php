<?php
/**
 * Copyright (c) 2018 - 2019 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\event\game;

use pocketmine\event\Cancellable;
use pocketmine\event\player\PlayerEvent;
use pocketmine\Player;

class GameWinEvent extends PlayerEvent implements Cancellable
{
    /** @var int */
    public const WIN_RED = 0;

    /** @var int */
    public const WIN_BLUE = 1;

    /** @var int $type */
    private $type;

    /**
     * GameWinEvent constructor.
     *
     * @param int    $type
     * @param Player $player
     */
    public function __construct(int $type, Player $player)
    {
        $this->type = $type;
        $this->player = $player;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }
}
