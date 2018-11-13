<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\provider;

use pocketmine\utils\Config;
use pocketmine\utils\MainLogger;
use VectorNetworkProject\TheMix\lib\database\Provider;

class JSON extends Provider
{
    /* @var string $path */
    private $path;

    /* @var string $file */
    private $file;

    /**
     * JSON constructor.
     *
     * @param string $xuid
     * @param string $file
     */
    public function __construct(string $xuid, string $file)
    {
        $this->path = self::getPath('datas', 'json').$xuid.'/';
        $this->file = $file.'.json';
    }

    public function init(array $data = []): void
    {
        if (!$this->hasTable()) {
            $this->createTable($data);
        }
    }

    /**
     * @param array $table
     *
     * @return void
     */
    public function createTable(array $table = []): void
    {
        @mkdir($this->path, 0755, true);
        $config = new Config($this->path.$this->file, Config::JSON, $table);
        $config->save();
        MainLogger::getLogger()->debug('[PROVIDER] Create '.$this->file);
    }

    /**
     * @return bool
     */
    public function hasTable(): bool
    {
        return file_exists($this->path.$this->file)
            ? true
            : false;
    }

    /**
     * @return void
     */
    public function deleteTable(): void
    {
        unlink($this->path.$this->file);
    }

    /**
     * @param string     $key
     * @param bool|mixed $data
     */
    public function set(string $key, $data): void
    {
        $config = new Config($this->path.$this->file, Config::JSON);
        $config->set($key, $data);
        $config->save();
    }

    /**
     * @param string $key
     *
     * @return bool|mixed
     */
    public function get(string $key)
    {
        $config = new Config($this->path.$this->file, Config::JSON);

        return $config->get($key);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $config = new Config($this->path.$this->file, Config::JSON);

        return $config->getAll();
    }

    /**
     * @return array
     */
    public function getKeys(): array
    {
        $config = new Config($this->path.$this->file, Config::JSON);

        return $config->getAll(true);
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function exists(string $key): bool
    {
        $config = new Config($this->path.$this->file, Config::JSON);

        return $config->exists($key)
            ? true
            : false;
    }

    /**
     * @param string $key
     *
     * @return void
     */
    public function remove(string $key): void
    {
        $config = new Config($this->path.$this->file, Config::JSON);
        $config->remove($key);
    }
}
