<?php
/**
 * Copyright (c) 2018 - 2019 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\event\player;

use pocketmine\event\Cancellable;
use pocketmine\event\Event;
use pocketmine\Player;

class PlayerBountyLostEvent extends Event implements Cancellable
{
    public const TYPE_SUICIDE = 0;
    public const TYPE_KILLED = 1;

    /** @var Player $Killed */
    private $killed;

    /* @var Player $killer */
    private $killer = null;

    /* @var int $gold */
    private $gold;

    /* @var int $type */
    private $type = self::TYPE_SUICIDE;

    /**
     * PlayerBountyLostEvent constructor.
     *
     * @param Player      $killed
     * @param int         $gold
     * @param Player|null $killer
     * @param int         $type
     */
    public function __construct(Player $killed, int $gold, Player $killer = null, int $type = self::TYPE_SUICIDE)
    {
        $this->killed = $killed;
        $this->killer = $killer;
        $this->gold = $gold;
        $this->type = $type;
    }

    /**
     * @return Player
     */
    public function getKilled(): Player
    {
        return $this->killed;
    }

    /**
     * @return Player|null
     */
    public function getKiller(): ?Player
    {
        return $this->killer;
    }

    /**
     * @return int
     */
    public function getGold(): int
    {
        return $this->gold;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }
}
