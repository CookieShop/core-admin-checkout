<?php

namespace Adteam\Core\Admin\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZipCodes
 *
 * @ORM\Table(name="zip_codes", indexes={@ORM\Index(name="zip_code", columns={"zip_code"})})
 * @ORM\Entity
 */
class ZipCodes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=8, precision=0, scale=0, nullable=false, unique=false)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=25, precision=0, scale=0, nullable=false, unique=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="town", type="string", length=30, precision=0, scale=0, nullable=false, unique=false)
     */
    private $town;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=35, precision=0, scale=0, nullable=false, unique=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=30, precision=0, scale=0, nullable=false, unique=false)
     */
    private $state;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return ZipCodes
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return ZipCodes
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return ZipCodes
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return ZipCodes
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return ZipCodes
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return ZipCodes
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }
}

