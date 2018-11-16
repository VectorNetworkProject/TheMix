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
    /* @var int $newLevel*/
    private $newLevel;

    /* @var int $oldlevel */
    private $oldLevel;

    /* @var bool $complete */
    private $complete;

    /**
     * PlayerLevelChangeEvent constructor.
     *
     * @param Player $player
     * @param int    $oldLevel
     * @param int    $newLevel
     * @param bool   $complete
     */
    public function __construct(Player $player, int $oldLevel, int $newLevel, bool $complete = false)
    {
        $this->player = $player;
        $this->newLevel = $newLevel;
        $this->oldLevel = $oldLevel;
        $this->complete = $complete;
    }

    /**
     * 新しいレベルを返します。
     *
     * @return int
     */
    public function getNewLevel(): int
    {
        return $this->newLevel;
    }

    /**
     * 古いレベルを返します。
     *
     * @return int
     */
    public function getOldLevel(): int
    {
        return $this->oldLevel;
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
