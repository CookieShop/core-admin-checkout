<?php

namespace Adteam\Core\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreOrderProducts
 *
 * @ORM\Table(name="core_order_products", indexes={@ORM\Index(name="order_id", columns={"order_id"}), @ORM\Index(name="core_order_products_ibfk_2", columns={"product_id"})})
 * @ORM\Entity
 */
class CoreOrderProducts
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
     * @ORM\Column(name="sku", type="string", length=60, precision=0, scale=0, nullable=false, unique=false)
     */
    private $sku;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=60, precision=0, scale=0, nullable=false, unique=false)
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(name="real_price", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $realPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="payload", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $payload;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $quantity;

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
     * @var \Adteam\Core\Checkout\Entity\CoreProducts
     *
     * @ORM\ManyToOne(targetEntity="Adteam\Core\Checkout\Entity\CoreProducts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $product;


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
     * Set sku
     *
     * @param string $sku
     *
     * @return CoreOrderProducts
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get sku
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CoreOrderProducts
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return CoreOrderProducts
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return CoreOrderProducts
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set realPrice
     *
     * @param float $realPrice
     *
     * @return CoreOrderProducts
     */
    public function setRealPrice($realPrice)
    {
        $this->realPrice = $realPrice;

        return $this;
    }

    /**
     * Get realPrice
     *
     * @return float
     */
    public function getRealPrice()
    {
        return $this->realPrice;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return CoreOrderProducts
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set payload
     *
     * @param string $payload
     *
     * @return CoreOrderProducts
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Get payload
     *
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return CoreOrderProducts
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set order
     *
     * @param \Adteam\Core\Checkout\Entity\CoreOrders $order
     *
     * @return CoreOrderProducts
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
     * Set product
     *
     * @param \Adteam\Core\Checkout\Entity\CoreProducts $product
     *
     * @return CoreOrderProducts
     */
    public function setProduct(\Adteam\Core\Checkout\Entity\CoreProducts $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Adteam\Core\Checkout\Entity\CoreProducts
     */
    public function getProduct()
    {
        return $this->product;
    }
}

