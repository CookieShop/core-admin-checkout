<?php

namespace Adteam\Core\Admin\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBanners
 *
 * @ORM\Table(name="core_banners")
 * @ORM\Entity
 */
class CoreBanners
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="href", type="string", length=2047, precision=0, scale=0, nullable=true, unique=false)
     */
    private $href;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $fileName;

    /**
     * @var string
     *
     * @ORM\Column(name="misc", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $misc;


    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return CoreBanners
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
     * @return CoreBanners
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
     * Set href
     *
     * @param string $href
     *
     * @return CoreBanners
     */
    public function setHref($href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * Get href
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     *
     * @return CoreBanners
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
     * Set misc
     *
     * @param string $misc
     *
     * @return CoreBanners
     */
    public function setMisc($misc)
    {
        $this->misc = $misc;

        return $this;
    }

    /**
     * Get misc
     *
     * @return string
     */
    public function getMisc()
    {
        return $this->misc;
    }
}

