<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\task;


use pocketmine\block\Block;
use pocketmine\scheduler\Task;

class BlockReGeneratorTask extends Task
{
    /** @var Block $block */
    private $block;

    /** @var int $id */
    private $id;

    public function __construct(Block $block, int $id)
    {
        $this->block = $block;
        $this->id = $id;
    }
    
    public function onRun(int $currentTick)
    {
        $this->getBlock()->getLevel()->setBlock($this->getBlock()->asVector3(), Block::get($this->id));
    }

    /**
     * @return Block
     */
    public function getBlock(): Block
    {
        return $this->block;
    }
}
