<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 */

namespace VectorNetworkProject\TheMix;


use pocketmine\plugin\PluginBase;

class TheMix extends PluginBase
{
    public function onLoad()
    {
        $this->getLogger()->notice("Loading System...");
    }

    public function onEnable()
    {
        $this->getLogger()->notice("Loaded System!!");
    }

    public function onDisable()
    {
        $this->getLogger()->notice("Unload System...");
    }
}
