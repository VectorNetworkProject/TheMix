<?php
/**
 * Copyright (c) 2018 - 2019 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\lib\sound;

use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\Player;

class LevelSounds
{
    /**
     * @param Player $player
     *
     * @return void
     */
    public static function LevelUp(Player $player): void
    {
        $packet = new LevelSoundEventPacket();
        $packet->position = $player->asVector3();
        $packet->sound = LevelSoundEventPacket::SOUND_LEVELUP;
        $packet->extraData = 0x10000000;
        $player->sendDataPacket($packet);
    }

    /**
     * @param Player $player
     *
     * @return void
     */
    public static function Anvil(Player $player): void
    {
        $packet = new LevelSoundEventPacket();
        $packet->position = $player->asVector3();
        $packet->sound = LevelSoundEventPacket::SOUND_RANDOM_ANVIL_USE;
        $player->sendDataPacket($packet);
    }

    /**
     * @param Player $player
     *
     * @return void
     */
    public static function Travle(Player $player): void
    {
        $packet = new LevelSoundEventPacket();
        $packet->position = $player->asVector3();
        $packet->sound = LevelSoundEventPacket::SOUND_PORTAL_TRAVEL;
        $player->sendDataPacket($packet);
    }

    /**
     * @param Player $player
     *
     * @return void
     */
    public static function EndPortalSpawn(Player $player): void
    {
        $packet = new LevelSoundEventPacket();
        $packet->position = $player->asVector3();
        $packet->sound = LevelSoundEventPacket::SOUND_BLOCK_END_PORTAL_SPAWN;
        $player->sendDataPacket($packet);
    }

    /**
     * @param Player $player
     *
     * @return void
     */
    public static function Portal(Player $player): void
    {
        $packet = new LevelSoundEventPacket();
        $packet->position = $player->asVector3();
        $packet->sound = LevelSoundEventPacket::SOUND_BLOCK_END_PORTAL_SPAWN;
        $player->sendDataPacket($packet);
    }

    /**
     * @param Player $player
     *
     * @return void
     */
    public static function Thunder(Player $player): void
    {
        $packet = new LevelSoundEventPacket();
        $packet->position = $player->asVector3();
        $packet->sound = LevelSoundEventPacket::SOUND_ITEM_TRIDENT_THUNDER;
        $player->sendDataPacket($packet);
    }

    /**
     * @param Player $player
     *
     * @return void
     */
    public static function Remedy(Player $player): void
    {
        $packet = new LevelSoundEventPacket();
        $packet->position = $player->asVector3();
        $packet->sound = LevelSoundEventPacket::SOUND_REMEDY;
        $player->sendDataPacket($packet);
    }

    /**
     * @param Player $player
     *
     * @return void
     */
    public static function Launch(Player $player): void
    {
        $packet = new LevelSoundEventPacket();
        $packet->position = $player->asVector3();
        $packet->sound = LevelSoundEventPacket::SOUND_LAUNCH;
        $player->sendDataPacket($packet);
    }

    /**
     * @param Player $player
     *
     * @return void
     */
    public static function Blast(Player $player): void
    {
        $packet = new LevelSoundEventPacket();
        $packet->position = $player->asVector3();
        $packet->sound = LevelSoundEventPacket::SOUND_BLAST;
        $player->sendDataPacket($packet);
    }

    /**
     * @param Player $player
     *
     * @return void
     */
    public static function LargeBlast(Player $player): void
    {
        $packet = new LevelSoundEventPacket();
        $packet->position = $player->asVector3();
        $packet->sound = LevelSoundEventPacket::SOUND_LARGE_BLAST;
        $player->sendDataPacket($packet);
    }

    /**
     * @param Player $player
     *
     * @return void
     */
    public static function Twinklt(Player $player): void
    {
        $packet = new LevelSoundEventPacket();
        $packet->position = $player->asVector3();
        $packet->sound = LevelSoundEventPacket::SOUND_TWINKLE;
        $player->sendDataPacket($packet);
    }

    /**
     * @param Player $player
     */
    public static function NotePiano(Player $player): void
    {
        $packet = new LevelSoundEventPacket();
        $packet->position = $player->asVector3();
        $packet->sound = LevelSoundEventPacket::SOUND_NOTE;
        $player->sendDataPacket($packet);
    }
}
