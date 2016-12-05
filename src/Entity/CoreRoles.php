<?php

namespace Adteam\Core\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreRoles
 *
 * @ORM\Table(name="core_roles", indexes={@ORM\Index(name="core_roles_ibfk_1", columns={"parent_id"})})
 * @ORM\Entity
 */
class CoreRoles
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
     * @ORM\Column(name="role", type="string", length=40, precision=0, scale=0, nullable=false, unique=false)
     */
    private $role;

    /**
     * @var \Application\Entity\CoreRoles
     *
     * @ORM\ManyToOne(targetEntity="Adteam\Core\Checkout\Entity\CoreRoles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $parent;
    
    /**
     * @ORM\OneToMany(targetEntity="Adteam\Core\Checkout\Entity\CorePermissions", mappedBy="role")
     */
    private $permissions;


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
     * Set role
     *
     * @param string $role
     *
     * @return CoreRoles
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set parent
     *
     * @param \Application\Entity\CoreRoles $parent
     *
     * @return CoreRoles
     */
    public function setParent(\Adteam\Core\Checkout\Entity\CoreRoles $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Adteam\Core\Checkout\Entity\CoreRoles
     */
    public function getParent()
    {
        return $this->parent;
    }
}

