<?php

namespace Adteam\Core\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CorePermissions
 *
 * @ORM\Table(name="core_permissions", uniqueConstraints={@ORM\UniqueConstraint(name="permission_key", columns={"role_id", "resource_id"})}, indexes={@ORM\Index(name="core_permissions_ibfk_2", columns={"resource_id"}), @ORM\Index(name="IDX_FADC5205D60322AC", columns={"role_id"})})
 * @ORM\Entity
 */
class CorePermissions
{
    /**
     * Permission type from $permission field: 'allow'
     */
    const PERMISSION_ALLOW = 'allow';

    /**
     * Permission type from $permission field: 'deny'
     */
    const PERMISSION_DENY = 'deny';
    
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
     * @ORM\Column(name="permission", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $permission;

    /**
     * @var \Application\Entity\CoreResources
     *
     * @ORM\ManyToOne(targetEntity="Adteam\Core\Checkout\Entity\CoreResources")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $resource;

    /**
     * @var \Application\Entity\CoreRoles
     *
     * @ORM\ManyToOne(targetEntity="Adteam\Core\Checkout\Entity", inversedBy="permissions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $role;


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
     * Set permission
     *
     * @param string $permission
     *
     * @return CorePermissions
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get permission
     *
     * @return string
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Set resource
     *
     * @param \Application\Entity\CoreResources $resource
     *
     * @return CorePermissions
     */
    public function setResource(\Adteam\Core\Checkout\Entity\CoreResources $resource = null)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return \Application\Entity\CoreResources
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set role
     *
     * @param \Application\Entity\CoreRoles $role
     *
     * @return CorePermissions
     */
    public function setRole(\Adteam\Core\Checkout\Entity\CoreRoles $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Application\Entity\CoreRoles
     */
    public function getRole()
    {
        return $this->role;
    }
}

