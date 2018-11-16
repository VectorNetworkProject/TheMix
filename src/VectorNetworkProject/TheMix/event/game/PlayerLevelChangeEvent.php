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

class PlayerLevelChangeEvent extends PlayerEvent implements Cancellable
{
    /* @var int */
    private $newlevel;

    /* @var int $oldlevel */
    private $oldlevel;

    /* @var bool $complete */
    private $complete;

    /**
     * PlayerLevelChangeEvent constructor.
     *
     * @param Player $player
     * @param int    $oldlevel
     * @param int    $newlevel
     * @param bool   $complete
     */
    public function __construct(Player $player, int $oldlevel, int $newlevel, bool $complete = false)
    {
        $this->player = $player;
        $this->newlevel = $newlevel;
        $this->oldlevel = $oldlevel;
        $this->complete = $complete;
    }

    /**
     * 新しいレベルを返します。
     *
     * @return int
     */
    public function getNewLevel(): int
    {
        return $this->newlevel;
    }

    /**
     * 古いレベルを返します。
     *
     * @return int
     */
    public function getOldLevel(): int
    {
        return $this->oldlevel;
    }

    /**
     * レベルが120かどうかを返します。
     *
     * @return bool
     */
    public function isComplete(): bool
    {
        return $this->complete;
    }
}
