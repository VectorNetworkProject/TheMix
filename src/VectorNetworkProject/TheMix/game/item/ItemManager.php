<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\item;


use pocketmine\item\Item;
use pocketmine\Player;

class ItemManager
{
    public static function DropItem(Player $player)
    {
        $contents = $player->getInventory()->getContents();
        foreach ($contents as $slot => $item) {
            switch ($item->getId()) {
                case Item::STONE_AXE:
                case Item::STONE_PICKAXE:
                case Item::STONE_SHOVEL:
                case Item::WOODEN_SWORD:
                case Item::LEATHER_CAP:
                case Item::LEATHER_CHESTPLATE:
                case Item::LEATHER_LEGGINGS:
                case Item::LEATHER_BOOTS:
                case Item::BOW:
                    unset($contents[$slot]);
                    break;
            }
        }
        foreach ($contents as $item) {
            $player->getLevel()->dropItem($player->asVector3(), $item);
        }
    }
}
