<?php

namespace Adteam\Core\Admin\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PmrRules
 *
 * @ORM\Table(name="pmr_rules", uniqueConstraints={@ORM\UniqueConstraint(name="mes_anio", columns={"mes", "anio", "user_id"})}, indexes={@ORM\Index(name="pmr_rules_ibfk_1", columns={"user_id"})})
 * @ORM\Entity
 */
class PmrRules
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
     * @ORM\Column(name="mes", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $mes;

    /**
     * @var integer
     *
     * @ORM\Column(name="anio", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $anio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $createdAt;

    /**
     * @var float
     *
     * @ORM\Column(name="ventas", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $ventas;

    /**
     * @var float
     *
     * @ORM\Column(name="cuota", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $cuota;

    /**
     * @var float
     *
     * @ORM\Column(name="puntos", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $puntos;

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
     * Set mes
     *
     * @param integer $mes
     *
     * @return PmrRules
     */
    public function setMes($mes)
    {
        $this->mes = $mes;

        return $this;
    }

    /**
     * Get mes
     *
     * @return integer
     */
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * Set anio
     *
     * @param integer $anio
     *
     * @return PmrRules
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;

        return $this;
    }

    /**
     * Get anio
     *
     * @return integer
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PmrRules
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
     * Set ventas
     *
     * @param float $ventas
     *
     * @return PmrRules
     */
    public function setVentas($ventas)
    {
        $this->ventas = $ventas;

        return $this;
    }

    /**
     * Get ventas
     *
     * @return float
     */
    public function getVentas()
    {
        return $this->ventas;
    }

    /**
     * Set cuota
     *
     * @param float $cuota
     *
     * @return PmrRules
     */
    public function setCuota($cuota)
    {
        $this->cuota = $cuota;

        return $this;
    }

    /**
     * Get cuota
     *
     * @return float
     */
    public function getCuota()
    {
        return $this->cuota;
    }

    /**
     * Set puntos
     *
     * @param float $puntos
     *
     * @return PmrRules
     */
    public function setPuntos($puntos)
    {
        $this->puntos = $puntos;

        return $this;
    }

    /**
     * Get puntos
     *
     * @return float
     */
    public function getPuntos()
    {
        return $this->puntos;
    }

    /**
     * Set user
     *
     * @param \Adteam\Core\Admin\Checkout\Entity\OauthUsers $user
     *
     * @return PmrRules
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

