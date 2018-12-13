<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game;

use VectorNetworkProject\TheMix\TheMix;

class DefaultConfig
{
    /** @var string */
    const VERSION = 'version';

    /** @var string */
    const STAGE_NAME = 'stage-world-name';

    /** @var string */
    const DEVELOP_MODE = 'dev-mode';

    /** @var string */
    const EVENT_TIME = 'event-time';

    /** @var string */
    const TIMEZONE = 'timezone';

    /** @var string */
    const BLOCK_ID = 'join-block-id';

    /** @var string */
    const RED = 'red';

    /** @var string */
    const BLUE = 'blue';

    /**
     * @return int
     */
    public static function getVersion(): int
    {
        return TheMix::getInstance()->getConfig()->get(self::VERSION);
    }

    /**
     * @return string
     */
    public static function getStageLevelName(): string
    {
        return TheMix::getInstance()->getConfig()->get(self::STAGE_NAME);
    }

    /**
     * @return bool
     */
    public static function isDev(): bool
    {
        return TheMix::getInstance()->getConfig()->get(self::DEVELOP_MODE);
    }

    /**
     * @return int
     */
    public static function getEventTime(): int
    {
        return TheMix::getInstance()->getConfig()->get(self::EVENT_TIME);
    }

    /**
     * @return string
     */
    public static function getTimezone(): string
    {
        return TheMix::getInstance()->getConfig()->get(self::TIMEZONE);
    }

    /**
     * @return int
     */
    public static function getBlockId(): int
    {
        return TheMix::getInstance()->getConfig()->get(self::BLOCK_ID);
    }

    /**
     * @return string
     */
    public static function getIp(): string
    {
        return TheMix::getInstance()->getConfig()->get('ip');
    }

    /**
     * @return int
     */
    public static function getPort(): int
    {
        return TheMix::getInstance()->getConfig()->get('port');
    }

    /**
     * @return array
     */
    public static function getRedConfig(): array
    {
        return TheMix::getInstance()->getConfig()->get(self::RED);
    }

    /**
     * @return array
     */
    public static function getBlueConfig(): array
    {
        return TheMix::getInstance()->getConfig()->get(self::BLUE);
    }
}
