<?php

namespace Adteam\Core\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OauthUsers
 *
 * @ORM\Table(name="oauth_users", uniqueConstraints={@ORM\UniqueConstraint(name="AK_username", columns={"username"}), @ORM\UniqueConstraint(name="AK_email", columns={"email"})}, indexes={@ORM\Index(name="role_id", columns={"role_id"}), @ORM\Index(name="oauth_users_ibfk_2", columns={"created_by_id"})})
 * @ORM\Entity
 */
class OauthUsers
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
     * @ORM\Column(name="username", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=2000, precision=0, scale=0, nullable=true, unique=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="display_name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $displayName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $enabled;

    /**
     * @var boolean
     *
     * @ORM\Column(name="profile_fulfilled", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $profileFulfilled;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone1", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $telephone1;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone2", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $telephone2;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $mobile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", precision=0, scale=0, nullable=true, unique=false)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="job_title", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $jobTitle;

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
     * @var \Application\Entity\CoreRoles
     *
     * @ORM\ManyToOne(targetEntity="Adteam\Core\Checkout\Entity\CoreRoles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $role;

    /**
     * @var \Adteam\Core\Checkout\Entity\OauthUsers
     *
     * @ORM\ManyToOne(targetEntity="Adteam\Core\Checkout\Entity\OauthUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="created_by_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $createdBy;


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
     * Set username
     *
     * @param string $username
     *
     * @return OauthUsers
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return OauthUsers
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return OauthUsers
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return OauthUsers
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return OauthUsers
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return OauthUsers
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     *
     * @return OauthUsers
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return OauthUsers
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
     * Set profileFulfilled
     *
     * @param boolean $profileFulfilled
     *
     * @return OauthUsers
     */
    public function setProfileFulfilled($profileFulfilled)
    {
        $this->profileFulfilled = $profileFulfilled;

        return $this;
    }

    /**
     * Get profileFulfilled
     *
     * @return boolean
     */
    public function getProfileFulfilled()
    {
        return $this->profileFulfilled;
    }

    /**
     * Set telephone1
     *
     * @param string $telephone1
     *
     * @return OauthUsers
     */
    public function setTelephone1($telephone1)
    {
        $this->telephone1 = $telephone1;

        return $this;
    }

    /**
     * Get telephone1
     *
     * @return string
     */
    public function getTelephone1()
    {
        return $this->telephone1;
    }

    /**
     * Set telephone2
     *
     * @param string $telephone2
     *
     * @return OauthUsers
     */
    public function setTelephone2($telephone2)
    {
        $this->telephone2 = $telephone2;

        return $this;
    }

    /**
     * Get telephone2
     *
     * @return string
     */
    public function getTelephone2()
    {
        return $this->telephone2;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     *
     * @return OauthUsers
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return OauthUsers
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return OauthUsers
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set jobTitle
     *
     * @param string $jobTitle
     *
     * @return OauthUsers
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * Get jobTitle
     *
     * @return string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return OauthUsers
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
     * @return OauthUsers
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
     * Set role
     *
     * @param \Application\Entity\CoreRoles $role
     *
     * @return OauthUsers
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

    /**
     * Set createdBy
     *
     * @param \Application\Entity\OauthUsers $createdBy
     *
     * @return OauthUsers
     */
    public function setCreatedBy(\Adteam\Core\Checkout\Entity\OauthUsers $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \Application\Entity\OauthUsers
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
}

