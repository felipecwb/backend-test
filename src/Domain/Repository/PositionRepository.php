<?php

namespace Felipecwb\Catho\Domain\Repository;

use Felipecwb\Catho\Domain\Entity\Position;
use Felipecwb\Catho\Infra\PositionFile;
use Doctrine\Common\Cache\CacheProvider;

class PositionRepository
{
    /**
     * @var PositionFile
     */
    private $file;

    /**
     * @var CacheProvider
     */
    private $cache;

    public function __construct(PositionFile $file, CacheProvider $cache)
    {
        $this->cache = $cache;
        $this->file = $file;
    }

    /**
     * @param  array  $search Dados para busca
     * @return Position[]
     */
    public function find(array $search = array())
    {
        $positions = $this->getPositionsInCache();

        if (array_key_exists('title', $search)) {
            $positions = $this->searchInField($search['title'], 'title', $positions);
        }

        if (array_key_exists('description', $search)) {
            $positions = $this->searchInField($search['description'], 'description', $positions);
        }

        return $positions;
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
        }, $this->getPositionsInCache());

        $locations = array_unique($locations);
        sort($locations);

        $this->cache->save('list.locations', $locations, 3600);
        return $locations;
    }

    /**
     * @return Position[]
     */
    protected function getPositionsInCache()
    {
        if ($this->cache->contains('list.positions')) {
            return $this->cache->fetch('list.positions');
        }

        $positions = [];
        foreach ($this->file->getContent() as $position) {
            $positions[] = $this->exchange($position);
        }

        $this->cache->save('list.positions', $positions, 3600);

        return $positions;
    }

    /**
     * Brings the matched positions with search
     * @param  string $search    [description]
     * @param  string $field     [description]
     * @param  array $positions [description]
     * @return Position[]
     */
    protected function searchInField($search, $field, $positions)
    {
        if (! in_array($field, ['title', 'description'])) {
            return $positions;
        }

        $search = self::changeAccents($search);

        // match all words from $search against the data in $field
        $positions = array_filter($positions, function (Position $p) use ($search, $field) {
            $data = $field === 'title' ? $p->getTitle() : $p->getDescription();
            $data = self::changeAccents($data);

            foreach (array_filter(explode(' ', $search)) as $word) {
                if (false === stripos($data, $word)) {
                    return false;
                }
            };

            return true;
        });

        // discard key preservation from array_filter
        return array_values($positions);
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
