<?php

namespace Adteam\Core\Admin\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreSendemail
 *
 * @ORM\Table(name="core_sendemail")
 * @ORM\Entity
 */
class CoreSendemail
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
     * @ORM\Column(name="template", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $template;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateAdded;

    /**
     * @var string
     *
     * @ORM\Column(name="from", type="string", length=125, precision=0, scale=0, nullable=false, unique=false)
     */
    private $from;

    /**
     * @var string
     *
     * @ORM\Column(name="to", type="string", length=125, precision=0, scale=0, nullable=false, unique=false)
     */
    private $to;

    /**
     * @var string
     *
     * @ORM\Column(name="cc", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $cc;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", precision=0, scale=0, nullable=true, unique=false)
     */
    private $status;


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
     * Set template
     *
     * @param string $template
     *
     * @return CoreSendemail
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return CoreSendemail
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set from
     *
     * @param string $from
     *
     * @return CoreSendemail
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set to
     *
     * @param string $to
     *
     * @return CoreSendemail
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set cc
     *
     * @param string $cc
     *
     * @return CoreSendemail
     */
    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * Get cc
     *
     * @return string
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return CoreSendemail
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return CoreSendemail
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}

