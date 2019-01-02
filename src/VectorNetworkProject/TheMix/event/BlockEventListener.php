<?php
/**
 * Copyright (c) 2018 - 2019 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event;

use pocketmine\block\Block;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\Server;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueCoreManager;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueTeamManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedCoreManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedTeamManager;
use VectorNetworkProject\TheMix\game\DefaultConfig;
use VectorNetworkProject\TheMix\game\event\game\BreakCoreEvent;
use VectorNetworkProject\TheMix\task\BlockReGeneratorTask;
use VectorNetworkProject\TheMix\TheMix;

class BlockEventListener implements Listener
{
    /** @var bool $diamond */
    private static $diamond = false;

    /**
     * @param BlockBreakEvent $event
     */
    public function onOreBreak(BlockBreakEvent $event): void
    {
        $block = $event->getBlock();
        $inventory = $event->getPlayer()->getInventory();
        if (DefaultConfig::isDev()) {
            return;
        }
        if ($block->getLevel()->getName() !== DefaultConfig::getStageLevelName() || GameEventListener::isFinish()) {
            $event->setCancelled();

            return;
        }
        if ($block->getToolType() !== $inventory->getItemInHand()->getBlockToolType()) {
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
                if (!self::isDiamond()) {
                    $event->getPlayer()->sendMessage('§cRASH TIME§fになるまでダイヤモンドは破壊出来ません。');
                    $event->setCancelled();

                    return;
                }
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

    /**
     * @param BlockBreakEvent $event
     *
     * @throws \ReflectionException
     */
    public function onBlockBreak(BlockBreakEvent $event)
    {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        if (GameEventListener::isFinish()) {
            $event->setCancelled();

            return;
        } elseif ($player->getLevel()->getName() === DefaultConfig::getStageLevelName() || Server::getInstance()->getDefaultLevel()->getName() === $player->getPlayer()->getLevel()->getName()) {
            if (!DefaultConfig::isDev()) {
                $event->setCancelled();
            }
        }
        if (RedCoreManager::isCore($block)) {
            $event->setCancelled();
            if (RedTeamManager::isJoined($player)) {
                return;
            }
            $revent = new BreakCoreEvent($player, BreakCoreEvent::RED);
            $revent->call();
            if (!$revent->isCancelled()) {
                RedCoreManager::reduceHP($revent->getDamage(), $player);
            }
        } elseif (BlueCoreManager::isCore($block)) {
            $event->setCancelled();
            if (BlueTeamManager::isJoined($player)) {
                return;
            }
            $bevent = new BreakCoreEvent($player, BreakCoreEvent::BLUE);
            $bevent->call();
            if (!$bevent->isCancelled()) {
                BlueCoreManager::reduceHP($bevent->getDamage(), $player);
            }
        }
    }

    /**
     * @param BlockPlaceEvent $event
     */
    public function onBlockPlace(BlockPlaceEvent $event)
    {
        $player = $event->getPlayer();
        if (GameEventListener::isFinish()) {
            $event->setCancelled();

            return;
        } elseif ($player->getLevel()->getName() === DefaultConfig::getStageLevelName() || Server::getInstance()->getDefaultLevel()->getName() === $player->getPlayer()->getLevel()->getName()) {
            if (!DefaultConfig::isDev()) {
                $event->setCancelled();
            }
        }
    }

    /**
     * @return bool
     */
    public static function isDiamond(): bool
    {
        return self::$diamond;
    }

    /**
     * ダイヤモンドの破壊を許可するかどうか.
     *
     * @param bool $diamond
     */
    public static function setDiamond(bool $diamond): void
    {
        self::$diamond = $diamond;
    }
}
