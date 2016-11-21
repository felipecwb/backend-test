<?php

namespace Felipecwb\Catho\Infra;

use Doctrine\Common\Cache\CacheProvider;

class PositionFile
{
    /**
     * @var string
     */
    private $path;
    /**
     * @var CacheProvider
     */
    private $cache;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function setCache(CacheProvider $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return array
     */
    public function getContent()
    {
        if ($this->cache && $this->cache->contains('positions.file')) {
            return $this->cache->fetch('positions.file');
        }

        $data = file_get_contents($this->path);
        $data = json_decode($data);
        $data = $data->docs;

        if ($this->cache) {
            $this->cache->save('positions.file', $data, 3600);
        }

        return $data;
    }
}
