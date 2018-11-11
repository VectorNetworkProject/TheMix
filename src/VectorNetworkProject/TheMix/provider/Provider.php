<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\provider;


abstract class Provider
{
    public function createTable()
    {
        throw new \Error("Missing method 'createTable'");
    }

    public function deleteTable()
    {
        throw new \Error("Missing method 'deleteTable'");
    }

    public function hasTable()
    {
        throw new \Error("Missing method 'hasTable'");
    }

    public function create()
    {
        throw new \Error("Missing method 'create'");
    }

    public function delete()
    {
        throw new \Error("Missing method 'delete'");
    }

    public function has()
    {
        throw new \Error("Missing method 'has'");
    }

    public function set()
    {
        throw new \Error("Missing method 'set'");
    }

    public function remove()
    {
        throw new \Error("Missing method 'remove'");
    }

    public function get()
    {
        throw new \Error("Missing method 'get'");
    }

    public function getAll()
    {
        throw new \Error("Missing method 'getAll'");
    }

    public function getKeys()
    {
        throw new \Error("Missing method 'getKeys'");
    }
}
