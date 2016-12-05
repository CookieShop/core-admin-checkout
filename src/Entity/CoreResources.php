<?php

namespace Adteam\Core\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreResources
 *
 * @ORM\Table(name="core_resources", uniqueConstraints={@ORM\UniqueConstraint(name="resource", columns={"resource", "methodhttp"})}, indexes={@ORM\Index(name="core_resources_ibfk_1", columns={"parent_id"})})
 * @ORM\Entity
 */
class CoreResources
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
     * @ORM\Column(name="alias", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="resource", type="string", length=125, precision=0, scale=0, nullable=false, unique=false)
     */
    private $resource;

    /**
     * @var string
     *
     * @ORM\Column(name="methodhttp", type="string", length=10, precision=0, scale=0, nullable=false, unique=false)
     */
    private $methodhttp;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $description;

    /**
     * @var \Application\Entity\CoreResources
     *
     * @ORM\ManyToOne(targetEntity="Adteam\Core\Checkout\Entity\CoreResources")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $parent;


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
     * Set alias
     *
     * @param string $alias
     *
     * @return CoreResources
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set resource
     *
     * @param string $resource
     *
     * @return CoreResources
     */
    public function setResource($resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return string
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set methodhttp
     *
     * @param string $methodhttp
     *
     * @return CoreResources
     */
    public function setMethodhttp($methodhttp)
    {
        $this->methodhttp = $methodhttp;

        return $this;
    }

    /**
     * Get methodhttp
     *
     * @return string
     */
    public function getMethodhttp()
    {
        return $this->methodhttp;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CoreResources
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
     * Set parent
     *
     * @param \Application\Entity\CoreResources $parent
     *
     * @return CoreResources
     */
    public function setParent(\Adteam\Core\Checkout\Entity\CoreResources $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Application\Entity\CoreResources
     */
    public function getParent()
    {
        return $this->parent;
    }
}

