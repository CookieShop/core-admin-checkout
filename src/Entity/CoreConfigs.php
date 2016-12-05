<?php

namespace Adteam\Core\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreConfigs
 *
 * @ORM\Table(name="core_configs")
 * @ORM\Entity(repositoryClass="Adteam\Core\Checkout\Repository\CoreConfigsRepository")
 */
class CoreConfigs
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
     * @ORM\Column(name="`key`", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $key;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $value;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visibility", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $visibility;


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
     * Set key
     *
     * @param string $key
     *
     * @return CoreConfigs
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return CoreConfigs
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set visibility
     *
     * @param boolean $visibility
     *
     * @return CoreConfigs
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * Get visibility
     *
     * @return boolean
     */
    public function getVisibility()
    {
        return $this->visibility;
    }
}

