<?php

namespace Adteam\Core\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreProducts
 *
 * @ORM\Table(name="core_products", uniqueConstraints={@ORM\UniqueConstraint(name="AK_sku", columns={"sku"})})
 * @ORM\Entity
 */
class CoreProducts
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
     * @ORM\Column(name="sku", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $sku;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $fileName;

    /**
     * @var string
     *
     * @ORM\Column(name="real_price", type="decimal", precision=8, scale=2, nullable=true, unique=false)
     */
    private $realPrice;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="payload", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $payload;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $enabled;

    /**
     * @var boolean
     *
     * @ORM\Column(name="editable", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $editable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $deletedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_at", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $modifiedAt;
    
    /**
    * @ORM\ManyToMany(targetEntity="CoreProductCategories")
    * @ORM\JoinTable(name="core_products_x_categories",
    *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id", unique=true)} )
    **/
    protected $categories;

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
     * @return CoreProducts
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
     * Set title
     *
     * @param string $title
     *
     * @return CoreProducts
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
     * Set description
     *
     * @param string $description
     *
     * @return CoreProducts
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
     * @return CoreProducts
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
     * Set fileName
     *
     * @param string $fileName
     *
     * @return CoreProducts
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set realPrice
     *
     * @param string $realPrice
     *
     * @return CoreProducts
     */
    public function setRealPrice($realPrice)
    {
        $this->realPrice = $realPrice;

        return $this;
    }

    /**
     * Get realPrice
     *
     * @return string
     */
    public function getRealPrice()
    {
        return $this->realPrice;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return CoreProducts
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
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
     * @return CoreProducts
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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return CoreProducts
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set editable
     *
     * @param boolean $editable
     *
     * @return CoreProducts
     */
    public function setEditable($editable)
    {
        $this->editable = $editable;

        return $this;
    }

    /**
     * Get editable
     *
     * @return boolean
     */
    public function getEditable()
    {
        return $this->editable;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return CoreProducts
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return CoreProducts
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     *
     * @return CoreProducts
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }
}
