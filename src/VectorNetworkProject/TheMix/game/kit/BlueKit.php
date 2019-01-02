<?php
/**
 * Copyright (c) 2018 - 2019 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\kit;

use pocketmine\item\Armor;
use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\Color;

class BlueKit
{
    /**
     * @param Player $player
     */
    public static function sendItems(Player $player): void
    {
        $armors = [
            'leather_cap'   => Item::get(Item::LEATHER_CAP),
            'leather_tunic' => Item::get(Item::LEATHER_TUNIC),
            'leather_pants' => Item::get(Item::LEATHER_PANTS),
            'leather_boots' => Item::get(Item::LEATHER_BOOTS),
        ];
        $weapons = [
            'wooden_sword'  => Item::get(Item::WOODEN_SWORD),
            'bow'           => Item::get(Item::BOW),
            'stone_pickaxe' => Item::get(Item::STONE_PICKAXE),
            'stone_axe'     => Item::get(Item::STONE_AXE),
            'stone_shovel'  => Item::get(Item::STONE_SHOVEL),
        ];
        foreach ($armors as $armor) {
            if ($armor instanceof Durable and $armor instanceof Armor) {
                $armor->setUnbreakable(true);
                $armor->setCustomColor(new Color(0, 150, 255));
            }
        }
        foreach ($weapons as $weapon) {
            if ($weapon instanceof Durable) {
                $weapon->setUnbreakable(true);
            }
        }
        $player->getInventory()->clearAll();
        $armor = $player->getArmorInventory();
        $armor->setHelmet($armors['leather_cap']);
        $armor->setChestplate($armors['leather_tunic']);
        $armor->setLeggings($armors['leather_pants']);
        $armor->setBoots($armors['leather_boots']);
        $player->getInventory()->addItem($weapons['wooden_sword']);
        $player->getInventory()->addItem($weapons['bow']);
        $player->getInventory()->addItem($weapons['stone_pickaxe']);
        $player->getInventory()->addItem($weapons['stone_axe']);
        $player->getInventory()->addItem($weapons['stone_shovel']);
        $player->getInventory()->setItem(8, Item::get(Item::ARROW, 0, 64));
    }
}
