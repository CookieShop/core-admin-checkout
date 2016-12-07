<?php

namespace Adteam\Core\Admin\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreProductCategories
 *
 * @ORM\Table(name="core_product_categories", indexes={@ORM\Index(name="parent_id", columns={"parent_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class CoreProductCategories
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
     * @var boolean
     *
     * @ORM\Column(name="editable", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $editable;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $fileName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $sort;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $enabled;

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
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $deletedAt;

    /**
     * @var \Adteam\Core\Admin\Checkout\Entity\CoreProductCategories
     *
     * @ORM\ManyToOne(targetEntity="Adteam\Core\Admin\Checkout\Entity\CoreProductCategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $parent;

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
     * Set editable
     *
     * @param boolean $editable
     *
     * @return CoreProductCategories
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
     * Set name
     *
     * @param string $name
     *
     * @return CoreProductCategories
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     *
     * @return CoreProductCategories
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
     * Set description
     *
     * @param string $description
     *
     * @return CoreProductCategories
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
     * Set sort
     *
     * @param integer $sort
     *
     * @return CoreProductCategories
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return integer
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return CoreProductCategories
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return CoreProductCategories
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
     * @return CoreProductCategories
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

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return CoreProductCategories
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
     * Set parent
     *
     * @param \Adteam\Core\Admin\Checkout\Entity\CoreProductCategories $parent
     *
     * @return CoreProductCategories
     */
    public function setParent(\Adteam\Core\Admin\Checkout\Entity\CoreProductCategories $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Adteam\Core\Admin\Checkout\Entity\CoreProductCategories
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set user
     *
     * @param \Adteam\Core\Admin\Checkout\Entity\OauthUsers $user
     *
     * @return CoreProductCategories
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

