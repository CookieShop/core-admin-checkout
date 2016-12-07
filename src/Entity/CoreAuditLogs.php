<?php

namespace Adteam\Core\Admin\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreAuditLogs
 *
 * @ORM\Table(name="core_audit_logs", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class CoreAuditLogs
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
     * @ORM\Column(name="event_type", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $eventType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_time", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $eventTime;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="object_type", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $objectType;

    /**
     * @var integer
     *
     * @ORM\Column(name="object_id", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $objectId;

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
     * Set eventType
     *
     * @param string $eventType
     *
     * @return CoreAuditLogs
     */
    public function setEventType($eventType)
    {
        $this->eventType = $eventType;

        return $this;
    }

    /**
     * Get eventType
     *
     * @return string
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * Set eventTime
     *
     * @param \DateTime $eventTime
     *
     * @return CoreAuditLogs
     */
    public function setEventTime($eventTime)
    {
        $this->eventTime = $eventTime;

        return $this;
    }

    /**
     * Get eventTime
     *
     * @return \DateTime
     */
    public function getEventTime()
    {
        return $this->eventTime;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CoreAuditLogs
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
     * Set objectType
     *
     * @param string $objectType
     *
     * @return CoreAuditLogs
     */
    public function setObjectType($objectType)
    {
        $this->objectType = $objectType;

        return $this;
    }

    /**
     * Get objectType
     *
     * @return string
     */
    public function getObjectType()
    {
        return $this->objectType;
    }

    /**
     * Set objectId
     *
     * @param integer $objectId
     *
     * @return CoreAuditLogs
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * Get objectId
     *
     * @return integer
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set user
     *
     * @param \Adteam\Core\Admin\Checkout\Entity\OauthUsers $user
     *
     * @return CoreAuditLogs
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

