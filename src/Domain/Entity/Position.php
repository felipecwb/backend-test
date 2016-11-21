<?php

namespace Felipecwb\Catho\Domain\Entity;

use JsonSerializable;

class Position implements JsonSerializable
{
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $description;
    /**
     * @var int
     */
    private $salary;
    /**
     * @var string
     */
    private $city;
    /**
     * @var string
     */
    private $cityEstate;

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param int $salary
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
        return $this;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string $cityEstate
     */
    public function setCityEstate($cityEstate)
    {
        $this->cityEstate = $cityEstate;
        return $this;
    }

    /**
    * @return string
    */
    public function getTitle()
    {
        return $this->title;
    }

    /**
    * @return string
    */
    public function getDescription()
    {
        return $this->description;
    }

    /**
    * @return int
    */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
    * @return string
    */
    public function getCity()
    {
        return $this->city;
    }

    /**
    * @return string
    */
    public function getEstate()
    {
        return substr($this->cityEstate, -2);
    }

    /**
    * @return string
    */
    public function getCityEstate()
    {
        return $this->cityEstate;
    }

    /**
     * convert data to json_encode
     * @return mixed
     */
    public function jsonSerialize()
    {
        return [
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'salary' => $this->getSalary(),
            'city' => $this->getCity(),
            'estate' => $this->getEstate(),
            'city_estate' => $this->getCityEstate()
        ];
    }
}
