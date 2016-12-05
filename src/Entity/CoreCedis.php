<?php

namespace Adteam\Core\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreCedis
 *
 * @ORM\Table(name="core_cedis", uniqueConstraints={@ORM\UniqueConstraint(name="cedis_id", columns={"cedis_id"}), @ORM\UniqueConstraint(name="names_cedis", columns={"names_cedis"})})
 * @ORM\Entity
 */
class CoreCedis
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
     * @var integer
     *
     * @ORM\Column(name="cedis_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $cedisId;

    /**
     * @var string
     *
     * @ORM\Column(name="names_cedis", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $namesCedis;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $street;

    /**
     * @var integer
     *
     * @ORM\Column(name="ext_number", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $extNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="int_number", type="string", length=20, precision=0, scale=0, nullable=true, unique=false)
     */
    private $intNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=60, precision=0, scale=0, nullable=false, unique=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=60, precision=0, scale=0, nullable=false, unique=false)
     */
    private $state;

    /**
     * @var integer
     *
     * @ORM\Column(name="zip_code", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=18, precision=0, scale=0, nullable=false, unique=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="extra", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $extra;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $createAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $active;


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
     * Set cedisId
     *
     * @param integer $cedisId
     *
     * @return CoreCedis
     */
    public function setCedisId($cedisId)
    {
        $this->cedisId = $cedisId;

        return $this;
    }

    /**
     * Get cedisId
     *
     * @return integer
     */
    public function getCedisId()
    {
        return $this->cedisId;
    }

    /**
     * Set namesCedis
     *
     * @param string $namesCedis
     *
     * @return CoreCedis
     */
    public function setNamesCedis($namesCedis)
    {
        $this->namesCedis = $namesCedis;

        return $this;
    }

    /**
     * Get namesCedis
     *
     * @return string
     */
    public function getNamesCedis()
    {
        return $this->namesCedis;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return CoreCedis
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set extNumber
     *
     * @param integer $extNumber
     *
     * @return CoreCedis
     */
    public function setExtNumber($extNumber)
    {
        $this->extNumber = $extNumber;

        return $this;
    }

    /**
     * Get extNumber
     *
     * @return integer
     */
    public function getExtNumber()
    {
        return $this->extNumber;
    }

    /**
     * Set intNumber
     *
     * @param string $intNumber
     *
     * @return CoreCedis
     */
    public function setIntNumber($intNumber)
    {
        $this->intNumber = $intNumber;

        return $this;
    }

    /**
     * Get intNumber
     *
     * @return string
     */
    public function getIntNumber()
    {
        return $this->intNumber;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return CoreCedis
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
     * Set reference
     *
     * @param string $reference
     *
     * @return CoreCedis
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return CoreCedis
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
     * @return CoreCedis
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

    /**
     * Set zipCode
     *
     * @param integer $zipCode
     *
     * @return CoreCedis
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return integer
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return CoreCedis
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set extra
     *
     * @param string $extra
     *
     * @return CoreCedis
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;

        return $this;
    }

    /**
     * Get extra
     *
     * @return string
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return CoreCedis
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return CoreCedis
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }
}

