<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\block;


use pocketmine\block\Block;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\item\TieredTool;
use VectorNetworkProject\TheMix\game\DefaultConfig;
use VectorNetworkProject\TheMix\task\BlockReGeneratorTask;
use VectorNetworkProject\TheMix\TheMix;

class BlockReGeneratorEvent implements Listener
{
    public function event(BlockBreakEvent $event): void
    {
        $block = $event->getBlock();
        $inventory = $event->getPlayer()->getInventory();
        switch ($block->getId()) {
            case Block::MELON_BLOCK:
                $inventory->addItem(Item::get(Item::MELON, 0, 16));
                TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new BlockReGeneratorTask($block, Block::MELON_BLOCK), 10 * 20);
                break;
            case Block::WOOD:
                if ($block->getToolType() !== $inventory->getItemInHand()->getBlockToolType()) $event->setCancelled();
                $inventory->addItem(Item::get(Item::WOODEN_PLANKS, 0, 4));
                TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new BlockReGeneratorTask($block, Block::WOOD), 15 * 20);
                break;
            case Block::DIAMOND_ORE:
                if ($block->getToolType() !== $inventory->getItemInHand()->getBlockToolType()) $event->setCancelled();
                if (TieredTool::TIER_IRON >= $inventory->getItemInHand()->getBlockToolHarvestLevel()) $event->setCancelled();
                $inventory->addItem(Item::get(Item::DIAMOND));
                TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new BlockReGeneratorTask($block, Block::DIAMOND_ORE), 60 * 20);
                break;
            case Block::EMERALD_ORE:
                if ($block->getToolType() !== $inventory->getItemInHand()->getBlockToolType()) $event->setCancelled();
                if (TieredTool::TIER_IRON >= $inventory->getItemInHand()->getBlockToolHarvestLevel()) $event->setCancelled();
                $inventory->addItem(Item::get(Item::EMERALD, 0, mt_rand(1, 3)));
                TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new BlockReGeneratorTask($block, Block::EMERALD_ORE), 60 * 20);
                break;
            case Block::COAL_ORE:
                if ($block->getToolType() !== $inventory->getItemInHand()->getBlockToolType()) $event->setCancelled();
                if (TieredTool::TIER_WOODEN >= $inventory->getItemInHand()->getBlockToolHarvestLevel()) $event->setCancelled();
                $inventory->addItem(Item::get(Item::COAL));
                TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new BlockReGeneratorTask($block, Block::COAL_ORE), 15 * 20);
                break;
            case Block::IRON_ORE:
                if ($block->getToolType() !== $inventory->getItemInHand()->getBlockToolType()) $event->setCancelled();
                if (TieredTool::TIER_STONE >= $inventory->getItemInHand()->getBlockToolHarvestLevel()) $event->setCancelled();
                $inventory->addItem(Item::get(Item::IRON_INGOT));
                TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new BlockReGeneratorTask($block, Block::IRON_ORE), 20 * 20);
                break;
            case Block::GOLD_ORE:

                $inventory->addItem(Item::get(Item::GOLD_INGOT));
                TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new BlockReGeneratorTask($block, Block::GOLD_ORE), 30 * 20);
                break;
            default:
                if ($event->getPlayer()->getLevel()->getName() === DefaultConfig::getStageLevelName() && DefaultConfig::isDev() === false) {
                    $event->setCancelled();
                }
        }
    }
}
