<?php

namespace Adteam\Core\Admin\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreUserAddresses
 *
 * @ORM\Table(name="core_user_addresses", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="Adteam\Core\Admin\Checkout\Repository\CoreUserAddressesRepository")
 */
class CoreUserAddresses
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
     * @ORM\Column(name="street", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="ext_number", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $extNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="int_number", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $intNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="town", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $town;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $state;

    /**
     * @var boolean
     *
     * @ORM\Column(name="main", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $main;

    /**
     * @var \Adteam\Core\Admin\Checkout\Entity\OauthUsers
     *
     * @ORM\ManyToOne(targetEntity="Adteam\Core\Admin\Checkout\Entity\OauthUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $user;


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
     * Set street
     *
     * @param string $street
     *
     * @return CoreUserAddresses
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
     * @param string $extNumber
     *
     * @return CoreUserAddresses
     */
    public function setExtNumber($extNumber)
    {
        $this->extNumber = $extNumber;

        return $this;
    }

    /**
     * Get extNumber
     *
     * @return string
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
     * @return CoreUserAddresses
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
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return CoreUserAddresses
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
     * Set reference
     *
     * @param string $reference
     *
     * @return CoreUserAddresses
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
     * Set location
     *
     * @param string $location
     *
     * @return CoreUserAddresses
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
     * Set city
     *
     * @param string $city
     *
     * @return CoreUserAddresses
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
     * Set town
     *
     * @param string $town
     *
     * @return CoreUserAddresses
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
     * Set state
     *
     * @param string $state
     *
     * @return CoreUserAddresses
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
     * Set main
     *
     * @param boolean $main
     *
     * @return CoreUserAddresses
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main
     *
     * @return boolean
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * Set user
     *
     * @param \Adteam\Core\Admin\Checkout\Entity\OauthUsers $user
     *
     * @return CoreUserAddresses
     */
    public function setUser(\Adteam\Core\Admin\Checkout\Entity\OauthUsers $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Adteam\Core\Admin\Checkout\Entity\OauthUsers
     */
    public function getUser()
    {
        return $this->user;
    }
}

