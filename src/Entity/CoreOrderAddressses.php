<?php

namespace Adteam\Core\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreOrderAddressses
 *
 * @ORM\Table(name="core_order_addressses", indexes={@ORM\Index(name="core_order_addressses_ibfk_1", columns={"order_id"}), @ORM\Index(name="core_order_addressses_ibfk_2", columns={"user_id"})})
 * @ORM\Entity
 */
class CoreOrderAddressses
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
     * @ORM\Column(name="street", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="ext_number", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $extNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="int_number", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="town", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $town;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $state;

    /**
     * @var \Adteam\Core\Checkout\Entity\CoreOrders
     *
     * @ORM\ManyToOne(targetEntity="Adteam\Core\Checkout\Entity\CoreOrders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="order_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $order;

    /**
     * @var \Adteam\Core\Checkout\Entity\OauthUsers
     *
     * @ORM\ManyToOne(targetEntity="Adteam\Core\Checkout\Entity\OauthUsers")
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
     * @return CoreOrderAddressses
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
     * @return CoreOrderAddressses
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
     * @return CoreOrderAddressses
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
     * @return CoreOrderAddressses
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
     * @return CoreOrderAddressses
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
     * @return CoreOrderAddressses
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
     * @return CoreOrderAddressses
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
     * @return CoreOrderAddressses
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
     * @return CoreOrderAddressses
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
     * Set order
     *
     * @param \Adteam\Core\Checkout\Entity\CoreOrders $order
     *
     * @return CoreOrderAddressses
     */
    public function setOrder(\Adteam\Core\Checkout\Entity\CoreOrders $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Adteam\Core\Checkout\Entity\CoreOrders
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set user
     *
     * @param \Adteam\Core\Checkout\Entity\OauthUsers $user
     *
     * @return CoreOrderAddressses
     */
    public function setUser(\Adteam\Core\Checkout\Entity\OauthUsers $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Adteam\Core\Checkout\Entity\OauthUsers
     */
    public function getUser()
    {
        return $this->user;
    }
}

