<?php

namespace Felipecwb\Catho\Domain\Repository;

use Felipecwb\Catho\Domain\Entity\Position;
use Felipecwb\Catho\Infra\PositionFile;
use Doctrine\Common\Cache\CacheProvider;

class PositionRepository
{
    /**
     * @var Position[]
     */
    private $positions = array();
    /**
     * @var CacheProvider
     */
    private $cache = array();

    public function __construct(PositionFile $file, CacheProvider $cache)
    {
        $this->cache = $cache;

        if ($this->cache->contains('list.positions')) {
            $this->positions = $this->cache->fetch('list.positions');
            return;
        }

        foreach ($file->getContent() as $position) {
            $this->positions[] = $this->exchange($position);
        }

        $this->cache->save('list.positions', $this->positions, 3600);
    }

    /**
     * @param  array  $criterias Dados para busca
     * @return Position[]            [description]
     */
    public function find(array $criterias = array())
    {
        $positions = $this->positions;

        if (array_key_exists('title', $criterias)) {
            $title = self::changeAccents($criterias['title']);

            $positions = array_filter($positions, function (Position $p) use ($title) {
                $field = self::changeAccents($p->getTitle());
                foreach (explode(' ', $title) as $word) {
                    if (false === stripos($field, $word)) {
                        return false;
                    }
                };

                return true;
            });
        }

        if (array_key_exists('description', $criterias)) {
            $description = self::changeAccents($criterias['description']);

            $positions = array_filter($positions, function (Position $p) use ($description) {
                $field = self::changeAccents($p->getDescription());
                foreach (explode(' ', $description) as $word) {
                    if (false === stripos($field, $word)) {
                        return false;
                    }
                };

                return true;
            });
        }

        $ret = [];
        foreach ($positions as $position) {
            $ret[] = $position;
        }

        return $ret;
    }

    /**
     * @return array
     */
    public function findLocations()
    {
        if ($this->cache->contains('list.locations')) {
            return $this->cache->fetch('list.locations');
        }

        $locations = array_map(function (Position $position) {
            return $position->getCityEstate();
        }, $this->positions);

        $locations = array_unique($locations);
        sort($locations);

        $this->cache->save('list.locations', $locations, 3600);
        return $locations;
    }

    /**
     * @param  string $string
     * @return string
     */
    private static function changeAccents($string)
    {
        return preg_replace(
            array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),
            explode(" ","a A e E i I o O u U n N c C"),
            $string
        );
    }

    /**
     * @param  \stdClass  $position
     * @return Position
     */
    protected function exchange($position)
    {
        return (new Position())
            ->setTitle($position->title)
            ->setDescription($position->description)
            ->setSalary($position->salario)
            ->setCity($position->cidade[0])
            ->setCityEstate(substr($position->cidadeFormated[0], 0, -4));
    }
}
