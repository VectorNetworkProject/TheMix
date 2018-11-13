<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\provider;


use pocketmine\utils\Config;
use VectorNetworkProject\TheMix\lib\database\Provider;

class YAML extends Provider
{
    /* @var string $path */
    private $path;

    /* @var string $file */
    private $file;

    /**
     * JSON constructor.
     * @param string $file
     */
    public function __construct(string $file = 'config')
    {
        $this->path = self::getPath('configs', 'yaml');
        $this->file = $file . '.yml';
    }

    /**
     * @param array $table
     * @return void
     */
    public function createTable(array $table = []): void
    {
        @mkdir($this->path);
        $config = new Config($this->path . $this->file, Config::YAML, $table);
        $config->save();
    }

    /**
     * @return bool
     */
    public function hasTable(): bool
    {
        return file_exists($this->path . $this->file)
            ? true
            : false;
    }

    /**
     * @return bool
     */
    public function deleteTable(): bool
    {
        return unlink($this->path . $this->file)
            ? true
            : false;
    }

    /**
     * @param string $key
     * @param bool|mixed $data
     */
    public function set(string $key, $data): void
    {
        $config = new Config($this->path . $this->file, Config::YAML);
        $config->set($key, $data);
        $config->save();
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        $config = new Config($this->path . $this->file, Config::YAML);
        return $config->get($key);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $config = new Config($this->path . $this->file, Config::YAML);
        return $config->getAll();
    }

    /**
     * @return array
     */
    public function getKeys(): array
    {
        $config = new Config($this->path . $this->file, Config::YAML);
        return $config->getAll(true);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function exists(string $key): bool
    {
        $config = new Config($this->path . $this->file, Config::YAML);
        return $config->exists($key)
            ? true
            : false;
    }

    /**
     * @param string $key
     * @return void
     */
    public function remove(string $key): void
    {
        $config = new Config($this->path . $this->file, Config::YAML);
        $config->remove($key);
    }
}
