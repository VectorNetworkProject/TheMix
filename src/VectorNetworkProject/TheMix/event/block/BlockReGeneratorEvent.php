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
use VectorNetworkProject\TheMix\event\game\TheEndGameEvent;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueTeamManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedTeamManager;
use VectorNetworkProject\TheMix\game\DefaultConfig;
use VectorNetworkProject\TheMix\task\BlockReGeneratorTask;
use VectorNetworkProject\TheMix\TheMix;

class BlockReGeneratorEvent implements Listener
{
    /**
     * @param BlockBreakEvent $event
     */
    public function event(BlockBreakEvent $event): void
    {
        $block = $event->getBlock();
        $inventory = $event->getPlayer()->getInventory();
        if (DefaultConfig::isDev() || $block->getLevel()->getName() !== DefaultConfig::getStageLevelName() || TheEndGameEvent::isFinish()) {
            $event->setCancelled();

            return;
        }
        if ($block->getToolType() !== $inventory->getItemInHand()->getBlockToolType() && !DefaultConfig::isDev()) {
            $event->setCancelled();

            return;
        }
        if (RedTeamManager::getListCount() < 1 || BlueTeamManager::getListCount() < 1) {
            $event->getPlayer()->sendMessage('プレイヤーが足りないのでブロックの採掘が不可能です。');
            $event->setCancelled();

            return;
        }
        $event->setDrops([]);
        switch ($block->getId()) {
            case Block::MELON_BLOCK:
                $inventory->addItem(Item::get(Item::MELON, 0, 16));
                TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new BlockReGeneratorTask($block), 10 * 20);
                break;
            case Block::WOOD:
                $inventory->addItem(Item::get(Item::WOODEN_PLANKS, 0, 4));
                TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new BlockReGeneratorTask($block), 15 * 20);
                break;
            case Block::DIAMOND_ORE:
                $inventory->addItem(Item::get(Item::DIAMOND));
                TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new BlockReGeneratorTask($block), 60 * 20);
                break;
            case Block::EMERALD_ORE:
                $inventory->addItem(Item::get(Item::EMERALD, 0, mt_rand(1, 3)));
                TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new BlockReGeneratorTask($block), 60 * 20);
                break;
            case Block::COAL_ORE:
                $inventory->addItem(Item::get(Item::COAL));
                TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new BlockReGeneratorTask($block), 15 * 20);
                break;
            case Block::IRON_ORE:
                $inventory->addItem(Item::get(Item::IRON_INGOT));
                TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new BlockReGeneratorTask($block), 20 * 20);
                break;
            case Block::GOLD_ORE:
                $inventory->addItem(Item::get(Item::GOLD_INGOT));
                TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new BlockReGeneratorTask($block), 30 * 20);
                break;
            default:
                if ($event->getPlayer()->getLevel()->getName() === DefaultConfig::getStageLevelName() && DefaultConfig::isDev() === false) {
                    $event->setCancelled();

                    return;
                }
        }
    }
}
